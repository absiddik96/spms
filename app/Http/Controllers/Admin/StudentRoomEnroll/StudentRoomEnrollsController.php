<?php

namespace App\Http\Controllers\Admin\StudentRoomEnroll;

use Auth;
use Session;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Models\Admin\Semester;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;
use App\Models\Admin\StudentRoomEnroll;
use App\Models\StudentEnroll\StudentEnroll;


class StudentRoomEnrollsController extends Controller
{
    public function index(Request $request)
	{
        $semester_id = $request['semester_id'];
		$exam_season_id = $request['exam_season_id'];
		if ($semester_id == null) {
			return redirect()->route('student-room-enroll.create');
		}

        $student_enroll = StudentEnroll::where('semester_id', $semester_id)->where('exam_season_id', $exam_season_id)->where('department_id', Auth::user()->department_id)->get();

		// $students = Student::select('students.id', 'students.semester_id', 'students.reg_no', 'students.exam_roll', 'students.name', 'students.email')
		// ->leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')->whereNull('student_enrolls.student_id')->where('students.semester_id', $semester_id)->get();


		$jsonData = '';
		if(!empty($student_enroll))
		{
			foreach ($student_enroll as $student) {
				$jsonData .= '
				<div style="padding-bottom: 10px;" class="col-md-3">
				<div class="col-md-1">
				<input name="student_id[]" type="checkbox" class="checkbox pull-left" value="' . $student->student->id . '"/>
				</div>
				<div class="col-md-6">
				' . $student->student->name . '<br>
				' . $student->student->exam_roll . '<br>
				' . $student->student->reg_no . '<br>
				</div>
				</div>';
			}
		}
		else{
			$jsonData .= "No data found";
		}

		return json_encode($jsonData);
	}





	public function create()
	{
		return view('admin.student_room_enroll.create')
		->with('exam_seasons', ExamSeason::all())
		->with('batches', Batch::where('department_id',Auth::user()->department_id)->get())
		->with('semesteres', Semester::where('department_id',Auth::user()->department_id)->get());
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'exam_season'          => 'required|numeric',
			'exam_date'            => 'required|numeric',
			'exam_shift_time'      => 'required|numeric',
			'exam_room'            => 'required|numeric',
            'semester_id'          => 'required|numeric',
			'exam_course'          => 'required|numeric',
			'student_id'           => 'required',
		]);

		$input = $request->all();
		$student_id = $request->input('student_id');

		for ($i = 0; $i < count($student_id); $i++) {
			$data[$i]['supervisor_id'] = Auth::user()->user_id;
            $data[$i]['department_id'] = Auth::user()->department_id;

			$data[$i]['exam_season_id'] = $input['exam_season'];
			$data[$i]['exam_date_id'] = $input['exam_date'];
			$data[$i]['exam_shift_time_id'] = $input['exam_shift_time'];
			$data[$i]['exam_room_id'] = $input['exam_room'];
			$data[$i]['semester_id'] = $input['semester_id'];
			$data[$i]['course_enroll_id'] = $input['exam_course'];

			$data[$i]['student_id'] = $student_id[$i];
		}

		if (StudentRoomEnroll::insert($data)) {
			Session::flash('success', 'Student Room Enroll create successfull');
		} else {
			Session::flash('fail', 'Student Room Enroll create failed');
		}

		return redirect()->back();
	}

	public function enrolls_show()
	{
		return view('admin.student_room_enroll.view')
		->with('exam_seasons', ExamSeason::all())
		->with('semesteres', Semester::all());
	}

	public function student_unroll(Request $request)
	{
        $where_clause = [
            'department_id'=>Auth::user()->department_id
        ];
        if ($exam_season_id = $request->input('exam_season_id')) {
            $where_clause +=['exam_season_id'=>$exam_season_id];
        }
        if ($exam_date_id = $request->input('exam_date_id')) {
            $where_clause +=['exam_date_id'=>$exam_date_id];
        }
        if ($exam_shift_time_id = $request->input('exam_shift_time_id')) {
            $where_clause +=['exam_shift_time_id'=>$exam_shift_time_id];
        }
        if ($exam_room_id = $request->input('exam_room_id')) {
            $where_clause +=['exam_room_id'=>$exam_room_id];
        }
        if ($semester_id = $request->input('semester_id')) {
            $where_clause +=['semester_id'=>$semester_id];
        }
        if ($exam_course_id = $request->input('exam_course_id')) {
            $where_clause +=['course_enroll_id'=>$exam_course_id];
        }

        $ids				   = $request->input('enroll_id');

		//		if () {
		//			Session::flash('success','Student unroll successfull');
		//		}else {
		//			Session::flash('fail','Student unroll failed');
		//		}

		if (count($ids)>1)
		{
			StudentRoomEnroll::destroy($ids);
			$jsonData .= "No data found";
		}else{
			$id = explode(",", $ids);
			if(count($id)>1){
				StudentRoomEnroll::destroy($id);
			}else{
				$unroll = StudentRoomEnroll::find($ids);
				$unroll->delete();
			}
		}

		if ($exam_season_id == null) {
			return redirect()->route('student-room-enroll.create');
		}

		$jsonData = $this->get_jeson_data($where_clause);
		return json_encode($jsonData);
	}





	public function get_data_by_json_where_semester_id(Request $request)
	{
        $where_clause = [
            'department_id'=>Auth::user()->department_id
        ];
        if ($exam_season_id = $request->input('exam_season_id')) {
            $where_clause +=['exam_season_id'=>$exam_season_id];
        }
        if ($exam_date_id = $request->input('exam_date_id')) {
            $where_clause +=['exam_date_id'=>$exam_date_id];
        }
        if ($exam_shift_time_id = $request->input('exam_shift_time_id')) {
            $where_clause +=['exam_shift_time_id'=>$exam_shift_time_id];
        }
        if ($exam_room_id = $request->input('exam_room_id')) {
            $where_clause +=['exam_room_id'=>$exam_room_id];
        }
        if ($semester_id = $request->input('semester_id')) {
            $where_clause +=['semester_id'=>$semester_id];
        }
        if ($exam_course_id = $request->input('exam_course_id')) {
            $where_clause +=['course_enroll_id'=>$exam_course_id];
        }

		if ($exam_season_id == null) {
			return redirect()->route('student-room-enroll.create');
		}

		$jsonData = $this->get_jeson_data($where_clause);
		return json_encode($jsonData);

	}






	public function get_jeson_data($where_clause)
	{
		$student_room_enrolls = StudentRoomEnroll::where($where_clause)->get();

		$jsonData = '';
		if ($student_room_enrolls)
		{
            foreach ($student_room_enrolls as $student_room_enroll) {
				$jsonData .=
                '
                    <tr>
                        <td><input name="student_id[]" type="checkbox" class="checkbox pull-left" value="' . $student_room_enroll->id . '"/></td>
                        <td>'.$student_room_enroll->student->exam_roll.'</td>
                        <td>'.$student_room_enroll->student->name.'</td>
                        <td>'.$student_room_enroll->semester->semester.'</td>
                        <td>'.$student_room_enroll->courseEnroll->course->name.' --- '.$student_room_enroll->courseEnroll->course->code.'</td>
                        <td>'.$student_room_enroll->examRoom->getName().' --- '.$student_room_enroll->examRoom->room_number.'</td>
                        <td>'.$student_room_enroll->ExamShiftTime->getShift().' --- '.$student_room_enroll->ExamShiftTime->getStartTime().'</td>
                        <td>'.$student_room_enroll->examDate->getExamDate().'</td>
                        <td><input type="button" class="btn-danger" value="Unroll" onclick="unroll(this, '. $student_room_enroll->id .')"></td>
                    </tr>
                ';
			}
		}
		else{
			$jsonData .= "No data found";
		}
		return $jsonData;
	}
}
