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
            $table->integer('batch_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('student_id')->unsigned();
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
