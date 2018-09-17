<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supervisor_id',15)->index();
            $table->integer('semester_id')->unsigned()->index();
            $table->integer('exam_season_id')->unsigned()->index();
            $table->integer('department_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->string('teacher_id',15)->index();
            $table->timestamps();

            $table->foreign('supervisor_id')->references('user_id')->on('users');
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->foreign('exam_season_id')->references('id')->on('exam_seasons');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('teacher_id')->references('user_id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_enrolls');
    }
}
