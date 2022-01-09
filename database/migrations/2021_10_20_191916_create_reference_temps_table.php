<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_temps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('CityInTemp')->nullable();
            $table->float('CityOutTemp')->nullable();
            $table->float('FloorInTemp')->nullable();
            $table->float('FloorOutTemp')->nullable();
            $table->float('OutDoorTemp')->nullable();
            $table->tinyInteger('termoHead_1');
            $table->tinyInteger('termoHead_2');
            $table->tinyInteger('termoHead_3');
            $table->tinyInteger('termoHead_4');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_temps');
    }
}
