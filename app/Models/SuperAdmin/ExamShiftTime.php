<?php
namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class ExamShiftTime extends Model
{
    const SHIFT = [1=>'Morning Shift', 2=>'Evening Shift'];

    /**
     * Get the ExamSeason that owns the model.
     */
    public function examSeason()
    {
        return $this->belongsTo(ExamSeason::class);
    }

    //........ get shift
    public function getShift()
    {
        if (in_array($this->exam_shift, array_keys(self::SHIFT))) {
            return self::SHIFT[$this->exam_shift];
        }else {
            return false;
        }
    }

    public function getStartTime()
    {
        return date("g:i A", strtotime($this->exam_start_time));
    }
}
