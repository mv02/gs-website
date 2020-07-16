<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->timestamp('timestamp');
            $table->boolean('priority');
            $table->string('status')->default('Queued');
            $table->unsignedMediumInteger('progress')->default(0);
            $table->foreignId('customer_id');
            $table->foreignId('worker_id')->nullable();
            $table->string('product_name');
            $table->unsignedMediumInteger('price_each');
            $table->unsignedMediumInteger('amount');
            $table->unsignedTinyInteger('discount')->nullable();
            $table->foreignId('storage_id');
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
