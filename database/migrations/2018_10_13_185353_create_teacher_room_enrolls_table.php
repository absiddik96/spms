<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherRoomEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_room_enrolls', function (Blueprint $table) {
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

            $table->string('teacher_id',15)->index();
            $table->foreign('teacher_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->boolean('is_chief')->default(false);

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
        Schema::dropIfExists('teacher_room_enrolls');
    }
}
