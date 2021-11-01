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
            $table->float('CityInTemp');
            $table->float('CityOutTemp');
            $table->float('FloorInTemp');
            $table->float('FloorOutTemp');

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
