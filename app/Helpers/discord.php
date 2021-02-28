<?php

use Illuminate\Support\Facades\Http;
use App\Order;

if (!function_exists('orderLog')) {
    function orderLog($orderID, $message) {
        Http::post(env('DISCORD_ORDER_LOG_WEBHOOK'), [
            'content' => '`[' . now()->toDateTimeString() . "]` `[#${orderID}]` ${message}"
        ]);
    }
}

if (!function_exists('orderChannelID')) {
    function orderChannelID($orderID) {
        // get all channels in the guild
        $channels = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->get('https://discord.com/api/guilds/' . env('DISCORD_GUILD') . '/channels')->json();

        // find channel of the order and fetch its ID
        foreach ($channels as $channel) {
            if ($channel['name'] == 'order-' . $orderID) return $channel['id'];
        }

        return null;
    }
}

if (!function_exists('orderMessageID')) {
    function orderMessageID($channelID) {
        // get all messages in the channel
        $messages = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->get('https://discord.com/api/channels/' . $channelID . '/messages')->json();

        // find the order embed message and fetch its ID
        foreach ($messages as $message) {
            if (count($message['embeds']) == 1) return $message['id'];
        }

        return null;
    }
}

if (!function_exists('orderPlaced')) {
    function orderPlaced($orderID) {
        $order = Order::findOrFail($orderID);

        // send embed in the queued orders channel
        Http::post(env('DISCORD_QUEUED_WEBHOOK'), [
            'embeds' => [$order->embed]
        ]);
    }
}

if (!function_exists('orderAssigned')) {
    function orderAssigned($orderID) {
        $order = Order::findOrFail($orderID);

        // create a channel under In Progress category and fetch its ID
        $orderChannelID = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->post('https://discord.com/api/guilds/' . env('DISCORD_GUILD') . '/channels', [
            'name' => 'order-' . $order->id,
            'parent_id' => env('DISCORD_IN_PROGRESS_CATEGORY'),
            'permission_overwrites' => [
                ['id' => env('DISCORD_GUILD'), 'type' => 0, 'deny' => 1024],
                ['id' => $order->customer->discord_id, 'type' => 1, 'allow' => 1024],
                ['id' => $order->grinder->discord_id, 'type' => 1, 'allow' => 1024],
                ['id' => env('DISCORD_MANAGEMENT_ROLE'), 'type' => 0, 'allow' => 1024],
            ]
        ])->json()['id'];

        // send embed in the created channel
        Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->post('https://discord.com/api/channels/' . $orderChannelID . '/messages', [
            'embed' => $order->embed
        ]);

        orderLog($orderID, 'Grinder assigned.');
    }
}

if (!function_exists('orderUpdated')) {
    function orderUpdated($orderID) {
        $order = Order::findOrFail($orderID);

        $orderChannelID = orderChannelID($orderID);
        $orderMessageID = orderMessageID($orderChannelID);

        // edit the order message, replace the embed
        Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->patch('https://discord.com/api/channels/' . $orderChannelID . '/messages/' . $orderMessageID, [
            'embed' => $order->embed
        ]);
    }
}

if (!function_exists('orderCompleted')) {
    function orderCompleted($orderID) {
        $order = Order::findOrFail($orderID);

        $orderChannelID = orderChannelID($orderID);
        $orderMessageID = orderMessageID($orderChannelID);

        // move the order channel under the Completed category
        Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->patch('https://discord.com/api/channels/' . $orderChannelID, [
            'parent_id' => env('DISCORD_COMPLETED_CATEGORY')
        ]);

        // edit the order message, replace the embed
        Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->patch('https://discord.com/api/channels/' . $orderChannelID . '/messages/' . $orderMessageID, [
            'content' => "<@{$order->customer->discord_id}>",
            'embed' => $order->embed
        ]);
    }
}

if (!function_exists('orderDelivered')) {
    function orderDelivered($orderID) {
        $orderChannelID = orderChannelID($orderID);

        Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ])->delete('https://discord.com/api/channels/' . $orderChannelID);
    }
}