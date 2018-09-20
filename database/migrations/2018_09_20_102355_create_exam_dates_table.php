<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_season_id')->unsigned();
            $table->foreign('exam_season_id')->references('id')->on('exam_seasons')->onDelete('cascade');
            $table->date('exam_date');
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
        Schema::dropIfExists('exam_dates');
    }
}
