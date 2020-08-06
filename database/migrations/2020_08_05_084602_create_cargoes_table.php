<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedMediumInteger('price');
            $table->unsignedMediumInteger('limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargoes');
    }
}
