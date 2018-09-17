<?php

namespace App\Http\Controllers\Admin\Student;

use Auth;
use Image;
use Session;
use App\Models\Admin\Batch;
use App\Models\Admin\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.student.index')
                ->with('students', Student::where('department_id',Auth::user()->department_id)->get());
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.student.create')
        ->with('batches', Batch::where('department_id',Auth::user()->department_id)->get())
        ->with('default_password', Student::DEFAULT_PASSWORD);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StudentCreateRequest $request)
    {
        $input = $request->all();

        $input['name']       = ucwords($request->name);
        $input['password']   = bcrypt($request->password);
        $input['department_id']   = Auth::user()->department_id;
        $input['user_id']    = Auth::user()->user_id;
        $input['is_present'] = Student::PRESENT_STUDENT;

        if (Student::create($input)) {
            Session::flash('success', 'Student create successfull');
        } else {
            Session::flash('fail', 'Student create failed');
        }

        return redirect()->back();
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Student $student)
    {
        return view('admin.student.edit')
                ->with('student', $student)
                ->with('batches', Batch::where('department_id',Auth::user()->department_id)->get());
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        //.......validation only for email and registration no update
        $this->validate($request,[
            'reg_no' => 'required|unique:students,reg_no,'.$student->id,
            'email' => 'required|email|unique:students,email,'.$student->id,
        ]);

        $input = $request->all();

        //..........manipulate password
        if ($request->password) {
            $pass = $request->password;
            if (strlen($pass) < 6) {
                Session::flash('info','Password length at least 6.');
                return redirect()->back();
            }
            $input['password'] = bcrypt($request->password);
        }else{
            $input['password'] = $student->password;
        }

        if ($student->update($input)) {
            Session::flash('success', 'Student update successfull');
        } else {
            Session::flash('fail', 'Student update failed');
        }
        return redirect()->route('student.index');

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Student $student)
    {
        if ($student->delete()) {
            Session::flash('success', 'Student delete successfull');
        } else {
            Session::flash('fail', 'Student delete failed');
        }
        return redirect()->back();
    }
}
