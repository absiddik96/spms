<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrolls', function (Blueprint $table) {
            $table->increments('id');

            $table->string('supervisor_id',15);
            $table->foreign('supervisor_id')->references('user_id')->on('users');

            $table->integer('batch_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches');

            $table->integer('exam_season_id')->unsigned()->index();
            $table->foreign('exam_season_id')->references('id')->on('exam_seasons');

            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

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
        Schema::dropIfExists('student_enrolls');
    }
}
