<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamShiftTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_shift_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_season_id')->unsigned();
            $table->foreign('exam_season_id')->references('id')->on('exam_seasons')->onDelete('cascade');
            $table->integer('exam_shift')->unsigned();
            $table->time('exam_start_time');
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
        Schema::dropIfExists('exam_shift_times');
    }
}
