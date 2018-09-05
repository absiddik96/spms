<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    const BLOCK_NAME = [1=>'A', 2=>'B',3=>'C'];

    protected $fillable = ['exam_season_id','block','room_number','number_of_bench'];

    //........ get block names
    public function getName()
    {
        if (in_array($this->block, array_keys(self::BLOCK_NAME))) {
            return self::BLOCK_NAME[$this->block];
        }else {
            return "not found";
        }
    }
}
