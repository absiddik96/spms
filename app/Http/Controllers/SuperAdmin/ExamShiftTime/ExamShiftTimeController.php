<?php

namespace App\Http\Controllers\SuperAdmin\ExamShiftTime;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;
use App\Models\SuperAdmin\ExamShiftTime;

class ExamShiftTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.exam_shift_time.index')
        ->with('ests', ExamShiftTime::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.exam_shift_time.create')
        ->with('exam_seasons',ExamSeason::orderBy('exam_year','desc')->get())
        ->with('shifts',ExamShiftTime::SHIFT);
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
            'exam_season' => 'required',
            'shift' => 'required',
            'time' => 'required|date_format:H:i',
        ],[
            'time.date_format' => 'The time field must be a valid time format.',
        ]);

        $est = new ExamShiftTime;
        $est->exam_season_id = $request->exam_season;
        $est->exam_shift = $request->shift;
        $est->exam_start_time = $request->time;

        if ($est->save()) {
            $request->session()->flash('success', 'Exam Shift & time created successfully');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('super_admin.exam_shift_time.edit')
        ->with('est', ExamShiftTime::find($id))
        ->with('exam_seasons',ExamSeason::orderBy('exam_year','desc')->get())
        ->with('shifts',ExamShiftTime::SHIFT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'exam_season' => 'required',
            'shift' => 'required',
            'time' => 'required|date_format:H:i',
        ],[
            'time.date_format' => 'The time field must be a valid time format.',
        ]);

        $est = ExamShiftTime::find($id);
        $est->exam_season_id = $request->exam_season;
        $est->exam_shift = $request->shift;
        $est->exam_start_time = $request->time;

        if ($est->save()) {
            $request->session()->flash('success', 'Exam Shift & time updated successfully');
        }

        return redirect()->route('shift-time.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $est = ExamShiftTime::find($id);
        if ($est->delete()) {
            Session::flash('success', 'Exam Shift & time deleted successfully');
        }

        return redirect()->route('shift-time.index');
    }
}
