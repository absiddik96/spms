<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TeacherRoomEnroll extends Model
{
    public function examRoom()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamRoom');
    }

    public function examDates()
    {
        return $this->hasMany('App\Models\SuperAdmin\ExamDate','exam_season_id','exam_season_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User','teacher_id','user_id');
    }

    public function examShiftTime()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamShiftTime');
    }
}
