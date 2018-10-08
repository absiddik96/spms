<?php

namespace App\Http\Controllers\Admin\CourseEnroll;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Models\Admin\Course;
use App\Models\Admin\Semester;
use App\Models\Admin\UserRole;
use App\Models\Admin\CourseEnroll;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;

class CourseEnrollController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.courseEnroll.index')
        ->with('exam_seasons', ExamSeason::all())
        ->with('semesters', Semester::pluck('semester','id')->all());
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $teacher_role = UserRole::where('department_id',Auth::user()->department_id)->where('name','teacher')->first();
        if (!$teacher_role) {
            Session::flash('info','Teacher role not found');
            return redirect()->back();
        }
        return view('admin.courseEnroll.create')
        ->with('exam_seasons', ExamSeason::all())
        ->with('semesters', Semester::where('department_id',Auth::user()->department_id)->orderBy('semester')->pluck('semester','id')->all())
        ->with('courses', Course::where('department_id',Auth::user()->department_id)->orderBy('name')->pluck('name','id')->all())
        ->with('teachers', User::where('role_id',$teacher_role->id)->orderBy('name')->get());
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'semester' => 'required|numeric',
            'course' => 'required|numeric',
            'teacher' => 'required|numeric',
        ]);

        $course_enroll = new CourseEnroll();
        $course_enroll->supervisor_id = Auth::user()->user_id;
        $course_enroll->department_id = Auth::user()->department_id;
        $course_enroll->semester_id = $request->semester;
        $course_enroll->exam_season_id = $request->exam_season;
        $course_enroll->course_id = $request->course;
        $course_enroll->teacher_id = $request->teacher;

        if ($course_enroll->save()) {
            Session::flash('success','Course enroll successfull');
        }

        return redirect()->back();
    }


    public function getBySemester(Request $request)
    {
        $this->validate($request,[
            'exam_season' => 'required|numeric',
            'semester' => 'required|numeric',
        ]);

        $subEnrolls = CourseEnroll::where('semester_id',$request->semester)->get();

         return view('admin.courseEnroll.index')
         ->with('exam_seasons', ExamSeason::all())
         ->with('semesters', Semester::pluck('semester','id')->all())
         ->with('subEnrolls', $subEnrolls);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Admin\CourseEnroll  CourseEnroll
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request)
    {
        $this->validate($request,[
            'exam_season' => 'required|numeric',
            'semester_id' => 'required|numeric',
        ],[
            'semester_id.required' => 'The semester field is required.',
        ]);

        $subEnrolls = CourseEnroll::where('exam_season_id',$request->exam_season)->where('semester_id',$request->semester_id)->get();

         return view('admin.courseEnroll.index')
         ->with('exam_seasons', ExamSeason::all())
         ->with('semesters', Semester::pluck('semester','id')->all())
         ->with('subEnrolls', $subEnrolls);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Admin\CourseEnroll  CourseEnroll
    * @return \Illuminate\Http\Response
    */
    public function edit(CourseEnroll $course_enroll)
    {
        $teacher_role = UserRole::where('department_id',Auth::user()->department_id)->where('name','teacher')->first();
        if (!$teacher_role) {
            Session::flash('info','Teacher role not found');
            return redirect()->back();
        }
        return view('admin.courseEnroll.edit')
        ->with('subEnroll', $course_enroll)
        ->with('exam_seasons', ExamSeason::all())
        ->with('semesters', Semester::where('department_id',Auth::user()->department_id)->pluck('semester','id')->all())
        ->with('courses', Course::where('department_id',Auth::user()->department_id)->pluck('name','id')->all())
        ->with('teachers', $teacher_role->users);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Admin\CourseEnroll  CourseEnroll
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, CourseEnroll $course_enroll)
    {
        $this->validate($request,[
            'semester' => 'required|numeric',
            'course' => 'required|numeric',
            'teacher' => 'required|numeric',
        ]);

        $course_enroll->supervisor_id = Auth::user()->user_id;
        $course_enroll->semester_id = $request->semester;
        $course_enroll->course_id = $request->course;
        $course_enroll->teacher_id = $request->teacher;

        if ($course_enroll->save()) {
            Session::flash('success','Course enroll update successfull');
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Admin\CourseEnroll  CourseEnroll
    * @return \Illuminate\Http\Response
    */
    public function destroy(CourseEnroll $course_enroll)
    {
        if ($course_enroll->delete()) {
            Session::flash('success','Course enroll delete successfull');
        }

        return redirect()->back();
    }
}
