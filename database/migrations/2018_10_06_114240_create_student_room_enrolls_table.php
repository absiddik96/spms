<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRoomEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_room_enrolls', function (Blueprint $table) {
            $table->increments('id');

            $table->string('supervisor_id',15)->index();
            $table->foreign('supervisor_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->integer('exam_season_id')->unsigned()->index();
            $table->foreign('exam_season_id')->references('id')->on('exam_seasons')->onDelete('cascade');

            $table->integer('exam_date_id')->unsigned()->index();
            $table->foreign('exam_date_id')->references('id')->on('exam_dates')->onDelete('cascade');

            $table->integer('exam_shift_time_id')->unsigned()->index();
            $table->foreign('exam_shift_time_id')->references('id')->on('exam_shift_times')->onDelete('cascade');

            $table->integer('exam_room_id')->unsigned()->index();
            $table->foreign('exam_room_id')->references('id')->on('exam_rooms')->onDelete('cascade');

            $table->integer('semester_id')->unsigned()->index();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->integer('course_enroll_id')->unsigned()->index();
            $table->foreign('course_enroll_id')->references('id')->on('course_enrolls')->onDelete('cascade');

            $table->integer('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

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
        Schema::dropIfExists('student_room_enrolls');
    }
}
