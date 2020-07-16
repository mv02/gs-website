<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('discord_id');
            $table->unsignedMediumInteger('tycoon_id');
            $table->integer('rank');
            $table->boolean('trainee')->default(true);
            $table->dateTime('joined_at')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedTinyInteger('trailer');
            $table->string('faction')->nullable();
            $table->string('email');
            $table->unsignedTinyInteger('management_rank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
