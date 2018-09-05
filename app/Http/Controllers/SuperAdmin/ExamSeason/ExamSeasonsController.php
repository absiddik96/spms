<?php
namespace App\Http\Controllers\SuperAdmin\ExamSeason;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\ExamSeason;
use App\Http\Controllers\Controller;

class ExamSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.exam_season.index')
                ->with('exam_seasons', ExamSeason::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.exam_season.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'exam_month' => 'required',
            'exam_year' => 'required|numeric',
        ]);

        $exam_season = new ExamSeason();

        $exam_season->supervisor_id = Auth::user()->user_id;
        $exam_season->exam_month = $request->exam_month;
        $exam_season->exam_year = $request->exam_year;
        $exam_season->slug = str_slug($request->exam_month.' '.$request->exam_year);

        if ($exam_season->save()) {
            Session::flash('success','Exam Season create successfull');
        }else {
            Session::flash('fail','Exam Season create failed');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamSeason $exam_season)
    {
        return view('super_admin.exam_season.edit')
                ->with('exam_season', $exam_season);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ExamSeason $exam_season)
    {
        $this->validate($request, [
            'exam_month' => 'required',
            'exam_year' => 'required|numeric',
        ]);

        $exam_season->supervisor_id = Auth::user()->user_id;
        $exam_season->exam_month = $request->exam_month;
        $exam_season->exam_year = $request->exam_year;
        $exam_season->slug = str_slug($request->exam_month.' '.$request->exam_year);

        if ($exam_season->save()) {
            Session::flash('success','Exam Season create successfull');
        }else {
            Session::flash('fail','Exam Season create failed');
        }
        return redirect()->route('exam-season.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamSeason $exam_season)
    {
        if ($exam_season->delete()) {
            Session::flash('success','Exam Season delete successfull');
        }

        return redirect()->back();
    }
}
