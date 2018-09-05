<?php

namespace App\Http\Controllers\SuperAdmin\ExamRoom;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ExamSeason;
use App\Models\SuperAdmin\ExamRoom as Room;

class ExamRoomsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('super_admin.exam_room.index')
        ->with('exam_seasons', ExamSeason::orderBy('created_at', 'desc')->get());
    }

    public function room_list($exam_season)
    {
        return view('super_admin.exam_room.room_list')
        ->with('rooms', Room::where('exam_season_id',$exam_season)->get())
        ->with('exam_season', ExamSeason::find($exam_season));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('super_admin.exam_room.create')
        ->with('exam_seasons', ExamSeason::all())
        ->with('block', Room::BLOCK_NAME);
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
            'exam_season_id' => 'required',
            'block' => 'required',
            'room_number' => 'required',
            'number_of_bench' => 'required',
        ]);

        $input = $request->all();

        if (Room::create($input)) {
            Session::flash('success','Room deatails create successfull.');
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
        return view('super_admin.exam_room.edit')
        ->with('room', Room::find($id))
        ->with('exam_seasons', ExamSeason::all())
        ->with('block', Room::BLOCK_NAME);
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
            'exam_season_id' => 'required',
            'block' => 'required',
            'room_number' => 'required',
            'number_of_bench' => 'required',
        ]);

        $room = Room::find($id);
        $input = $request->all();

        if ($room->update($input)) {
            Session::flash('success','Room deatails update successfull.');
        }
        return redirect()->route('super-admin.exam-room.list', $request->exam_season_id);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $room = Room::find($id);

        if ($room->delete()) {
            Session::flash('success','Category is deleted succesfully');

        }else {
            Session::flash('fail', 'Category is not deleted');
        }
        return redirect()->back();
    }
}
