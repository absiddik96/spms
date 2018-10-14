<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CourseEnroll extends Model
{
    protected $fillable = ['supervisor_id','semester_id','course_id','teacher_id'];

    public function course()
    {
        return $this->belongsTo('App\Models\Admin\Course');
    }
    
    public function teacher()
    {
        return $this->belongsTo('App\User','teacher_id','user_id');
    }

    /**
     * Get the ExamSeason that owns the model.
     */
    public function examSeason()
    {
        return $this->belongsTo(ExamSeason::class);
    }
}
