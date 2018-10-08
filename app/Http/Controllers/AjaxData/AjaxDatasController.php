<?php

namespace App\Http\Controllers\AjaxData;

use Auth;
use Illuminate\Http\Request;
use App\Models\Admin\CourseEnroll;
use App\Models\SuperAdmin\ExamRoom;
use App\Models\SuperAdmin\ExamDate;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamShiftTime;

class AjaxDatasController extends Controller
{
    public function examDatesByExamSeason(Request $request)
    {
        $data = []; $i=0;
        $exam_dates = ExamDate::where('exam_season_id',$request->exam_season_id)->get();
        foreach ($exam_dates as $date) {
            $data[$i++] = [
                'id' => $date->id,
                'date' => $date->getExamDate()
            ];
        }

        return $data;

    }

    public function examRoomsByExamSeason(Request $request)
    {
        $data = []; $i=0;
        $exam_rooms = ExamRoom::where('exam_season_id',$request->exam_season_id)->get();
        foreach ($exam_rooms as $room) {
            $data[$i++] = [
                'id' => $room->id,
                'room' => $room->getName().' --- '.$room->room_number
            ];
        }

        return $data;

    }

    public function examShifttimeByExamSeason(Request $request)
    {
        $data = []; $i=0;
        $exam_shift_times = ExamShiftTime::where('exam_season_id',$request->exam_season_id)->get();
        foreach ($exam_shift_times as $shift_time) {
            $data[$i++] = [
                'id' => $shift_time->id,
                'shift_time' => $shift_time->getShift().' --- '.$shift_time->getStartTime()
            ];
        }

        return $data;

    }

    public function examCoursesByExamSeasonSemester(Request $request)
    {
        $data = []; $i=0;
        $exam_course_enrolls = CourseEnroll::where('exam_season_id',$request->exam_season_id)
                                        ->where('semester_id',$request->semester_id)
                                        ->where('department_id',Auth::user()->department_id)
                                        ->get();
        foreach ($exam_course_enrolls as $course_enroll) {
            $data[$i++] = [
                'id' => $course_enroll->id,
                'course' => $course_enroll->course->name.' --- '.$course_enroll->course->code
            ];
        }

        return $data;

    }

}
