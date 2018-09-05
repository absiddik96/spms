<?php

namespace App\Http\Controllers\Admin\SubjectEnroll;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Semester;
use App\Models\Admin\UserRole;
use App\Models\Admin\SubjectEnroll;
use App\Http\Controllers\Controller;

class SubjectEnrollController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.subjectEnroll.index')
        ->with('semesters', Semester::pluck('semester','id')->all());
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $teacher_role = UserRole::where('name','teacher')->first();
        return view('admin.subjectEnroll.create')
        ->with('semesters', Semester::pluck('semester','id')->all())
        ->with('subjects', Subject::pluck('name','id')->all())
        ->with('teachers', $teacher_role->users);
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
            'subject' => 'required|numeric',
            'teacher' => 'required|numeric',
        ]);

        $s_enroll = new SubjectEnroll();
        $s_enroll->supervisor_id = Auth::user()->user_id;
        $s_enroll->semester_id = $request->semester;
        $s_enroll->subject_id = $request->subject;
        $s_enroll->teacher_id = $request->teacher;

        if ($s_enroll->save()) {
            Session::flash('success','Subject enroll successfull');
        }

        return redirect()->back();
    }


    public function getBySemester(Request $request)
    {
        $this->validate($request,[
            'semester' => 'required|numeric',
        ]);

        $subEnrolls = SubjectEnroll::where('semester_id',$request->semester)->get();

         return view('admin.subjectEnroll.index')
         ->with('semesters', Semester::pluck('semester','id')->all())
         ->with('subEnrolls', $subEnrolls);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Admin\SubjectEnroll  $subjectEnroll
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request)
    {
        $this->validate($request,[
            'semester_id' => 'required|numeric',
        ],[
            'semester_id.required' => 'The semester field is required.',
        ]);

        $subEnrolls = SubjectEnroll::where('semester_id',$request->semester_id)->get();

         return view('admin.subjectEnroll.index')
         ->with('semesters', Semester::pluck('semester','id')->all())
         ->with('subEnrolls', $subEnrolls);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Admin\SubjectEnroll  $subjectEnroll
    * @return \Illuminate\Http\Response
    */
    public function edit(SubjectEnroll $subjectEnroll)
    {
        $teacher_role = UserRole::where('name','teacher')->first();
        return view('admin.subjectEnroll.edit')
        ->with('subEnroll', $subjectEnroll)
        ->with('semesters', Semester::pluck('semester','id')->all())
        ->with('subjects', Subject::pluck('name','id')->all())
        ->with('teachers', $teacher_role->users);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Admin\SubjectEnroll  $subjectEnroll
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, SubjectEnroll $subjectEnroll)
    {
        $this->validate($request,[
            'semester' => 'required|numeric',
            'subject' => 'required|numeric',
            'teacher' => 'required|numeric',
        ]);

        $s_enroll = $subjectEnroll;
        $s_enroll->supervisor_id = Auth::user()->user_id;
        $s_enroll->semester_id = $request->semester;
        $s_enroll->subject_id = $request->subject;
        $s_enroll->teacher_id = $request->teacher;

        if ($s_enroll->save()) {
            Session::flash('success','Subject enroll update successfull');
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Admin\SubjectEnroll  $subjectEnroll
    * @return \Illuminate\Http\Response
    */
    public function destroy(SubjectEnroll $subjectEnroll)
    {
        if ($subjectEnroll->delete()) {
            Session::flash('success','Subject enroll delete successfull');
        }

        return redirect()->back();
    }
}
