<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\Student;

class CreateStudentsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',15)->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('batch_id');
            $table->integer('department_id')->unsigned();
            $table->integer('class_roll')->index();
            $table->integer('exam_roll')->index();
            $table->string('reg_no')->index();
            $table->tinyinteger('gender');
            $table->string('phone');
            $table->string('blood_group');
            $table->string('image')->nullable();
            $table->string('guardian');
            $table->string('guardian_contact');
            $table->boolean('is_present')->default(Student::PRESENT_STUDENT);
            $table->boolean('is_active')->default(Student::DEACTIVE_STUDENT);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
