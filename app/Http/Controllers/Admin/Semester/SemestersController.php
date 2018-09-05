<?php

namespace App\Http\Controllers\Admin\Semester;

use Auth;
use App\Models\Admin\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.semester.index')
                ->with('semesters',Semester::where('department_id',Auth::user()->department_id)->get());
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
            'semester' => 'required|min:0|max:150|unique:semesters',
        ]);

        $semester = new Semester();
        $semester->semester = strtolower($request->semester);
        $semester->department_id = Auth::user()->department_id;

        if ($semester->save()) {
            Session::flash('success', 'Semester create successfull.');
        }

        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Semester  $Semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        return view('admin.semester.edit')
                ->with('semester',$semester);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Semester  $Semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        $this->validate($request,[
            'semester' => 'required|min:0|max:150|unique:semesters,semester,'.$semester->id,
        ]);

        $semester->semester = strtolower($request->semester);

        if ($semester->save()) {
            Session::flash('success', 'Semester update successfull.');
        }

        return redirect()->route('semester.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Semester  $Semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        if ($semester->delete()) {
            Session::flash('success', 'Semester delete successfull.');
        }

        return redirect()->route('semester.index');
    }
}
