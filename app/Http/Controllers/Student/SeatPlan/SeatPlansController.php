<?php

namespace App\Http\Controllers\Student\SeatPlan;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Admin\StudentRoomEnroll as SRE;

class SeatPlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function examSeason()
    {
        $exam_seasons = SRE::select('student_id','exam_season_id','exam_month','exam_year')
                    ->where('student_id',Auth::user()->id)
                    ->join('exam_seasons', 'student_room_enrolls.exam_season_id', '=', 'exam_seasons.id')
                    ->groupBy('exam_month','exam_year')
                    ->orderBy('exam_year','desc')
                    ->get();

        return view('student.seat_plan.exam_season')
                ->with('exam_seasons', $exam_seasons);
    }

    public function seatPlan($exam_season_id)
    {
        $seat_plans = SRE::where('student_id',Auth::user()->id)
                            ->where('student_room_enrolls.department_id',Auth::user()->department_id)
                            ->where('student_room_enrolls.exam_season_id',$exam_season_id)
                            ->join('exam_dates', 'student_room_enrolls.exam_date_id', '=', 'exam_dates.id')
                            ->orderBy('exam_date')
                            ->get();

        return view('student.seat_plan.seat_plan')
                ->with('seat_plans', $seat_plans);
    }
}
