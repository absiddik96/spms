<?php

namespace App\Http\Controllers\Admin\TeacherRoomEnroll;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Models\Admin\UserRole;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;
use App\Models\Admin\TeacherRoomEnroll as TRE;

class TeacherRoomEnrollsController extends Controller
{
    public function index()
    {
        $exam_seasons = TRE::select('exam_season_id','exam_month','exam_year')
                    ->where('department_id',Auth::user()->department_id)
                    ->join('exam_seasons', 'teacher_room_enrolls.exam_season_id', '=', 'exam_seasons.id')
                    ->groupBy('exam_month','exam_year')
                    ->orderBy('exam_year','desc')
                    ->with('examDates')
                    ->get();

        return view('admin.teacher_room_enroll.exam_season')
                ->with('exam_seasons', $exam_seasons);
    }

    public function create()
	{
        $teacher_role = UserRole::where('department_id',Auth::user()->department_id)->where('name','teacher')->first();
        if (!$teacher_role) {
            Session::flash('info','Teacher role not found');
            return redirect()->back();
        }
		return view('admin.teacher_room_enroll.create')
		->with('exam_seasons', ExamSeason::all())
        ->with('teachers', User::where('department_id',Auth::user()->department_id)->orderBy('name')->where('role_id',$teacher_role->id)->get());
	}

    public function store(Request $request)
	{
        $this->validate($request, [
            'exam_season'     => 'required|numeric',
            'exam_date'       => 'required|numeric',
            'exam_shift_time' => 'required|numeric',
            'exam_room'       => 'required|numeric',
            'teacher'         => 'required|numeric',
        ]);

        $tre = new TRE;

        $tre->supervisor_id      = Auth::user()->user_id;
        $tre->department_id      = Auth::user()->department_id;

        $tre->exam_season_id     = $request->exam_season;
        $tre->exam_date_id       = $request->exam_date;
        $tre->exam_shift_time_id = $request->exam_shift_time;
        $tre->exam_room_id       = $request->exam_room;
        $tre->teacher_id         = $request->teacher;

        if ($request->is_chief) {
            $tre->is_chief = $request->is_chief;
        }

		if ($tre->save()) {
			Session::flash('success', 'Teacher Room Enroll create successfull');
		} else {
			Session::flash('fail', 'Teacher Room Enroll create failed');
		}

		return redirect()->back();
	}

    public function showTeachers($exam_season_id,$date_id)
	{
        $teachers = TRE::where('department_id',Auth::user()->department_id)
                            ->where('exam_date_id',$date_id)
                            ->where('exam_season_id',$exam_season_id)
                            ->get();
                            
        if (!$teachers->count()) {
            Session::flash('info', 'No teachers found in this date');
            return redirect()->back();
        }

		return view('admin.teacher_room_enroll.show_teachers')
                ->with('teachers', $teachers);
	}

    public function isChief($id)
	{
        $tre = TRE::find($id);

        if ($tre->is_chief) {
            $tre->is_chief = false;
            Session::flash('success', 'This teacher has been removed from the chief');
        }else {
            $tre->is_chief = true;
            Session::flash('success', 'This teacher has been appointed in chief');
        }

        $tre->save();

        return redirect()->back();
	}

    public function destroy($id)
    {
        $tre = TRE::find($id);
        if ($tre->delete()) {
            Session::flash('success', 'Teacher Room Enroll deleted successfull');
        }

        return redirect()->back();
    }























}
