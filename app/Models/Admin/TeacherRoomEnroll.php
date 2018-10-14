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

    public function examDate()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamDate');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User','teacher_id','user_id');
    }

    public function invigilator()
    {
        return $this->belongsTo('App\User','teacher_id','user_id');
    }

    public function examShiftTime()
    {
        return $this->belongsTo('App\Models\SuperAdmin\ExamShiftTime');
    }

    /**
     * Get the invigilators for the model.
     */
    public function invigilators()
    {
        return $this->hasMany('App\Models\Admin\TeacherRoomEnroll','exam_date_id','exam_date_id')
                        ->where('exam_shift_time_id', $this->exam_shift_time_id)
                        ->where('exam_room_id', $this->exam_room_id)
                        ->with('invigilator');
    }
}
