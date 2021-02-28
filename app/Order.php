<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    public $fillable = [
        'status',
        'progress',
        'customer_id',
        'grinder_id',
        'product_name',
        'amount',
        'price_each',
        'priority',
        'discount',
        'storage_id',
        'created_at',
        'completed_at',
        'delivered_at'
    ];

    function customer() {
        return $this->belongsTo('App\User', 'customer_id');
    }

    function grinder() {
        return $this->belongsTo('App\User', 'grinder_id');
    }

    function storage() {
        return $this->belongsTo('App\Storage');
    }

    function getTotalPriceAttribute() {
        $totalPrice = $this->amount * ($this->price_each + $this->storage->fee);
        if ($this->priority) $totalPrice *= 1.25;
        if ($this->discount) $totalPrice -= $totalPrice * $this->discount / 100;
        return $totalPrice;
    }

    function getAmountStringAttribute() {
        return number_format($this->amount, 0, '.', ',');
    }

    function getPriceEachStringAttribute() {
        return '$' . number_format($this->price_each, 0, '.', ',');
    }

    function getTotalPriceStringAttribute() {
        return '$' . number_format($this->total_price, 0, '.', ',');
    }

    function getDiscountStringAttribute() {
        return "-{$this->discount}%";
    }

    function getProgressStringAttribute() {
        return number_format($this->progress, 0, '.', ',');
    }

    function getProgressPercentageAttribute() {
        return floor($this->progress / $this->amount * 100);
    }

    function getEmbedAttribute() {
        $title = '\🚛 Order ' . $this->id;
        if ($this->status == 'Completed') $color = 5025616;
        else $color = $this->priority ? 16750592 : 240116;
        $fields = [
            ['name' => 'Order Information', 'value' =>  "**{$this->amount_string}x** {$this->product_name} @ {$this->storage->name}"],
            ['name' => 'Total Price', 'value' => "{$this->total_price_string} ({$this->discount_string})"],
            ['name' => 'Customer', 'value' => "**{$this->customer->name}** ({$this->customer->tycoon_id}) <@{$this->customer->discord_id}>"]
        ];

        switch ($this->status) {
            case 'Queued':
                $description = 'Press \✅ to assign this order to yourself.';
                $timestamp = $this->created_at;
                $footer = ['text' => $this->id];
                break;

            case 'In Progress':
                $description = "\🕑 **In Progress** - <@{$this->grinder->discord_id}>";
                $timestamp = $this->created_at;
                $footer = ['text' => 'Placed at:'];
                array_unshift($fields, ['name' => 'Progress', 'value' => "{$this->progress_string} / {$this->amount_string} ({$this->progress_percentage}%)"]);
                break;

            case 'Completed':
                $description = "\✅ **Awaiting Collection** - Please contact <@{$this->grinder->discord_id}>!";
                $timestamp = $this->completed_at;
                $footer = ['text' => 'Completed at:'];
                break;
        }

        return [
            'title' => $title,
            'description' => $description,
            'timestamp' => $timestamp,
            'color' => $color,
            'footer' => $footer,
            'fields' => $fields
        ];
    }
}
