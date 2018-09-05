<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class ExamSeason extends Model
{
    public function getExamSeasonAttribute($value = '')
    {
    	return ucwords($value);
    }

    public function exam_rooms()
    {
        return $this->hasMany('App\Models\SuperAdmin\ExamRoom');
    }
}
