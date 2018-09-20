<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class ExamDate extends Model
{
    /**
     * Get the ExamSeason that owns the model.
     */
    public function examSeason()
    {
        return $this->belongsTo(ExamSeason::class);
    }

    public function getExamDate()
    {
        return date('d-m-Y',strtotime($this->exam_date));
    }
}
