<?php

namespace App\Models\StudentEnroll;

use Illuminate\Database\Eloquent\Model;

class StudentEnroll extends Model
{
    protected $fillable = ['supervisor_id','batch_id','semester_id','student_id'];

    function student()
    {
    	return $this->belongsTo('App\Models\Admin\Student');
    }
}
