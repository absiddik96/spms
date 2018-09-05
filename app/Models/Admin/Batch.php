<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['department_id','batch_number', 'session'];
}
