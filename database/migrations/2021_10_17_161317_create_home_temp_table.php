<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HomeTemp', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float("T1");
            $table->float("H1");
            $table->float("T2");
            $table->float("H2");
            $table->float("T_pola_1");
            $table->float("PPM");



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HomeTemp');
    }
}
