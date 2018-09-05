<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_season_id')->unsigned();
            $table->tinyInteger('block');
            $table->integer('room_number');
            $table->integer('number_of_bench');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_rooms');
    }
}
