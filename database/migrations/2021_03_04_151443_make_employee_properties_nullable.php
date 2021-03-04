<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEmployeePropertiesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->unsignedBigInteger('tycoon_id')->nullable()->change();
            $table->boolean('trainee')->nullable()->default(null)->change();
            $table->boolean('management')->nullable()->default(null)->change();
            $table->boolean('active')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->unsignedBigInteger('tycoon_id')->nullable(false)->change();
            $table->boolean('trainee')->nullable(false)->default(true)->change();
            $table->boolean('management')->nullable(false)->default(false)->change();
            $table->boolean('active')->nullable(false)->default(true)->change();
        });
    }
}
