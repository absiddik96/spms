<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const ACTIVE_STUDENT = 1;
    const DEACTIVE_STUDENT = 0;
    const PRESENT_STUDENT = true;
    const EX_STUDENT = false;
    const DEFAULT_PASSWORD = 'gb123456';

    protected $fillable = ['user_id','name', 'email','department_id', 'password', 'batch_id', 'class_roll', 'exam_roll', 'reg_no', 'is_active', 'is_present'];

    public function batch()
    {
        return $this->belongsTo('App\Models\Admin\Batch');
    }

    public function isActive()
    {
        return $this->is_active == self::ACTIVE_STUDENT;
    }

}
