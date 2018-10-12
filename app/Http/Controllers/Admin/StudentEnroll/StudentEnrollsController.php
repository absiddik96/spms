<?php

namespace App\Http\Controllers\Admin\StudentEnroll;

use Auth;
use Session;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Models\Admin\Semester;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;
use App\Models\StudentEnroll\StudentEnroll;

class StudentEnrollsController extends Controller
{
	public function index(Request $request)
	{
		$batch_id = $request['batch_id'];
		if ($batch_id == null) {
			return redirect()->route('student-enroll.create');
		}
		$students = Student::select('students.id', 'students.batch_id', 'students.reg_no', 'students.exam_roll', 'students.name', 'students.email')->where('students.department_id',Auth::user()->department_id)
		->orderBy('students.exam_roll')
		->leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')->whereNull('student_enrolls.student_id')->where('students.batch_id', $batch_id)->get();

		$jsonData = '';
		if(!empty($students))
		{
			foreach ($students as $student) {
				$jsonData .= '
				<div style="padding-bottom: 10px;" class="col-md-3">
				<div class="col-md-1">
				<input name="student_id[]" type="checkbox" class="checkbox pull-left" value="' . $student->id . '"/>
				</div>
				<div class="col-md-6">
				' . $student->name . '<br>
				' . $student->exam_roll . '<br>
				' . $student->reg_no . '<br>
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
		return view('admin.student_enroll.create')
		->with('exam_seasons', ExamSeason::all())
		->with('batches', Batch::where('department_id',Auth::user()->department_id)->get())
		->with('semesteres', Semester::where('department_id',Auth::user()->department_id)->get());
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'batch_id' => 'required|numeric',
			'semester_id' => 'required|numeric',
			'student_id' => 'required',
			'exam_season' => 'required',
		]);

		$input = $request->all();
		$student_id = $request->input('student_id');

		for ($i = 0; $i < count($student_id); $i++) {
			$data[$i]['supervisor_id'] = Auth::user()->user_id;
			$data[$i]['batch_id'] = $input['batch_id'];
			$data[$i]['semester_id'] = $input['semester_id'];
			$data[$i]['exam_season_id'] = $input['exam_season'];
			$data[$i]['department_id'] = Auth::user()->department_id;
			$data[$i]['student_id'] = $student_id[$i];
		}

		if (StudentEnroll::insert($data)) {
			Session::flash('success', 'Student Enroll create successfull');
		} else {
			Session::flash('fail', 'Student Enroll create failed');
		}

		return redirect()->back();
	}

	public function enrolls_show()
	{
		return view('admin.student_enroll.view')
		->with('exam_seasons', ExamSeason::all())
		->with('semesteres', Semester::all());
	}

	public function student_unroll(Request $request)
	{
		$ids				   = $request->input('enroll_id');
		$semester_id = $request->input('semester_id');
		$exam_season_id = $request->input('exam_season_id');

		//		if () {
		//			Session::flash('success','Student unroll successfull');
		//		}else {
		//			Session::flash('fail','Student unroll failed');
		//		}

		if (count($ids)>1)
		{
			StudentEnroll::destroy($ids);
			$jsonData .= "No data found";
		}else{
			$id = explode(",", $ids);
			if(count($id)>1){
				StudentEnroll::destroy($id);
			}else{
				$unroll = StudentEnroll::find($ids);
				$unroll->delete();
			}
		}

		if ($semester_id == null) {
			return redirect()->route('student-enroll.create');
		}

		$jsonData = $this->get_jeson_data($semester_id,$exam_season_id);
		return json_encode($jsonData);
	}





	public function get_data_by_json_where_semester_id(Request $request)
	{
		$semester_id = $request->input('semester_id');
		$exam_season_id = $request->input('exam_season_id');
		if ($semester_id == null) {
			return redirect()->route('student-enroll.create');
		}

		$jsonData = $this->get_jeson_data($semester_id,$exam_season_id);
		return json_encode($jsonData);

	}






	public function get_jeson_data( $semester_id = "",$exam_season_id = "")
	{
		$student_enrolls = StudentEnroll::where('semester_id', $semester_id)
		->where('exam_season_id', $exam_season_id)
		->where('department_id', Auth::user()->department_id)
		->get();

		$jsonData = '';
		if ($student_enrolls)
		{
			foreach ($student_enrolls as $student_enroll) {
				$jsonData .= '
				<div style="padding-bottom: 10px;" class="col-md-3">
				<div class="col-md-1">
				<input name="student_id[]" type="checkbox" class="checkbox pull-left" value="' . $student_enroll->id . '"/>
				</div>
				<div class="col-md-6">
				' . $student_enroll->student->name . '<br>
				' . $student_enroll->student->exam_roll . '<br>
				' . $student_enroll->student->reg_no . '<br>
				<input type="button" class="btn-danger" value="Unroll" onclick="unroll(this, '. $student_enroll->id .')">\'<br>
				</div>
				</div>';
			}
		}
		else{
			$jsonData .= "No data found";
		}
		return $jsonData;
	}
}
