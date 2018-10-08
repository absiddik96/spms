@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Student Room Enroll</h3>
                </div>

                <div class="panel-body">
                    {{-- some change need
                    must be set form action
                    --}}



                    {{ csrf_field() }}
                    @include('includes.errors')
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Season</label>
                            <div class="col-sm-6">
                                <select id="exam_season" class="form-control on_chng season_semester" name="exam_season">
                                    <option value="">choose</option>
                                    @foreach ($exam_seasons as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_month.' '.$es->exam_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Date</label>
                            <div class="col-sm-6">
                                <select id="exam_date" name="exam_date" class="form-control on_chng">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Shift & Time</label>
                            <div class="col-sm-6">
                                <select id="exam_shift_time" name="exam_shift_time" class="form-control on_chng">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Room</label>
                            <div class="col-sm-6">
                                <select id="exam_room" name="exam_room" class="form-control on_chng">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Semester</label>
                            <div class="col-sm-6">
                                <select id="semester_id" name="semester_id" class="form-control on_chng select season_semester">
                                    <option value="">Select Semester</option>
                                    @if ($semesteres)
                                        @foreach ($semesteres as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Course</label>
                            <div class="col-sm-6">
                                <select id="exam_course" name="exam_course" class="form-control on_chng">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div id="unhide" hidden="" class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Student List</h3>
                </div>
                <div class="panel-body">
                    {{-- <div id="show_data"></div> --}}
                    <table class="table table-bordered">
                        <thead>
                            <th><input type="checkbox" id="select_all"/></th>
                            <th>Exam Roll</th>
                            <th>Name</th>
                            <th>Semester</th>
                            <th>Course</th>
                            <th>Exam Room</th>
                            <th>Exam Shift & Time</th>
                            <th>Exam Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="show_data">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-danger" value="All Unroll" onclick="unrolls()">
                        <input type="submit" class="btn btn-danger" value="Unroll" id="btn_" >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('includes.ajax.checked_all')
    @include('includes.ajax.student_room_unroll')
    @include('includes.ajax.exam_date_on_exam_season')
    @include('includes.ajax.exam_room_on_exam_season')
    @include('includes.ajax.room_enroll_student_on_all')
    @include('includes.ajax.exam_shift_time_on_exam_season')
    @include('includes.ajax.exam_course_on_exam_season_semester')
@endsection
