<?php

namespace App\Http\Controllers\Teacher\InvigilatingArea;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Admin\TeacherRoomEnroll as TRE;

class InvigilatingAreasController extends Controller
{
    public function examSeason()
    {
        $exam_seasons = TRE::select('teacher_id','exam_season_id','exam_month','exam_year')
                    ->where('teacher_id',Auth::user()->user_id)
                    ->join('exam_seasons', 'teacher_room_enrolls.exam_season_id', '=', 'exam_seasons.id')
                    ->groupBy('exam_month','exam_year')
                    ->orderBy('exam_year','desc')
                    ->get();

        return view('teacher.invigilating_area.exam_season')
                ->with('exam_seasons', $exam_seasons);
    }

    public function invigilatingArea($exam_season_id)
    {
        $invigilating_areas = TRE::select('teacher_room_enrolls.id','exam_date_id','exam_shift_time_id','exam_room_id','is_chief')
        ->where('teacher_id',Auth::user()->user_id)
        ->where('teacher_room_enrolls.department_id',Auth::user()->department_id)
        ->where('teacher_room_enrolls.exam_season_id',$exam_season_id)
        ->join('exam_dates', 'teacher_room_enrolls.exam_date_id', '=', 'exam_dates.id')
        ->orderBy('exam_date')
        ->get();


        return view('teacher.invigilating_area.invigilating_area')
                ->with('invigilating_areas', $invigilating_areas);
    }
}
