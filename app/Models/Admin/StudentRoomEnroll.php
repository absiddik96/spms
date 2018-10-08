<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class StudentRoomEnroll extends Model
{
    public function examSeason()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamSeason');
    }

    public function examDate()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamDate');
    }

    public function examShiftTime()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamShiftTime');
    }

    public function examRoom()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamRoom');
    }

    public function semester()
    {
        return $this->belongsTo('App\Models\Admin\Semester');
    }

    public function courseEnroll()
    {
        return $this->belongsTo('App\Models\Admin\CourseEnroll');
    }

    public function student()
    {
    	return $this->belongsTo('App\Models\Admin\Student');
    }

}
