<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status', 20)->default('Queued');
            $table->unsignedMediumInteger('progress')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('grinder_id')->nullable();
            $table->string('product_name', 20);
            $table->unsignedMediumInteger('amount');
            $table->unsignedMediumInteger('price_each');
            $table->boolean('priority')->default(false);
            $table->unsignedTinyInteger('discount')->nullable();
            $table->unsignedBigInteger('storage_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('grinder_id')->references('id')->on('users');
            $table->foreign('storage_id')->references('id')->on('storages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
