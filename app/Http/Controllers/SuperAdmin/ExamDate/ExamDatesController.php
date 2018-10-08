<?php

namespace App\Http\Controllers\SuperAdmin\ExamDate;

use Session;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\ExamDate;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;

class ExamDatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eds = '';
        $exam_season ='';
        if ($request->exam_season) {
            $eds = ExamDate::where('exam_season_id', $request->exam_season)->orderBy('exam_date')->get();
            $exam_season = ExamSeason::find($request->exam_season);
        }
        return view('super_admin.exam_date.index')
        ->with('eds', $eds)
        ->with('exam_season', $exam_season)
        ->with('exam_seasons',ExamSeason::orderBy('exam_year','desc')->get());
    }

    public function getExamDate(Request $request)
    {
        $exam_season_id = $request->exam_season_id;
        return json_encode(ExamDate::where('exam_season_id', $exam_season_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.exam_date.create')
        ->with('exam_seasons',ExamSeason::orderBy('exam_year','desc')->get());
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
            'exam_date' => 'required|date_format:"d-m-Y"',
        ],[
            'exam_date.date_format' => 'The exam date field must be a valid date format.',
        ]);

        $ed = new ExamDate;
        $ed->exam_season_id = $request->exam_season;
        $ed->exam_date = date('y-m-d',strtotime($request->exam_date));

        if ($ed->save()) {
            $request->session()->flash('success', 'Exam Date created successfully');
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
        return view('super_admin.exam_date.edit')
        ->with('ed', ExamDate::find($id))
        ->with('exam_seasons',ExamSeason::orderBy('exam_year','desc')->get());
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
            'exam_date' => 'required|date_format:"d-m-Y"',
        ],[
            'exam_date.date_format' => 'The exam date field must be a valid date format.',
        ]);

        $ed = ExamDate::find($id);
        $ed->exam_season_id = $request->exam_season;
        $ed->exam_date = date('y-m-d',strtotime($request->exam_date));

        if ($ed->save()) {
            $request->session()->flash('success', 'Exam Date updated successfully');
        }

        return redirect()->route('exam-date.index',['exam_season'=>$ed->exam_season_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ed = ExamDate::find($id);
        if ($ed->delete()) {
            Session::flash('success', 'Exam Date deleted successfully');
        }

        return redirect()->route('exam-date.index',['exam_season'=>$ed->exam_season_id]);
    }
}
