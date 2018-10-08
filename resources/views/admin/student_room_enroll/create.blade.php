
@extends('layouts.admin')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('student-room-enroll.store') }}" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Create Student Room Enroll</h3>
                    </div>

                    <div class="panel-body">
                        {{-- some change need
                        must be set form action
                        --}}


                        {{ csrf_field() }}

                        @include('includes.errors')

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Season</label>
                            <div class="col-sm-6">
                                <select id="exam_season" class="form-control season_semester" name="exam_season">
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
                                <select id="exam_date" name="exam_date" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Shift & Time</label>
                            <div class="col-sm-6">
                                <select id="exam_shift_time" name="exam_shift_time" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Room</label>
                            <div class="col-sm-6">
                                <select id="exam_room" name="exam_room" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Semester</label>
                            <div class="col-sm-6">
                                <select id="semester_id" name="semester_id" class="form-control select season_semester">
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
                                <select id="exam_course" name="exam_course" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="unhide" hidden="" class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Student List</h3><input type="checkbox" id="select_all" />
                    </div>
                    <div class="panel-body">
                        <div id="show_data"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <input class="btn btn-success" type="submit" value="Save">
                            <input class="btn btn-danger" type="reset" value="Reset">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('includes.ajax.checked_all')
    @include('includes.ajax.exam_date_on_exam_season')
    @include('includes.ajax.exam_room_on_exam_season')
    @include('includes.ajax.exam_shift_time_on_exam_season')
    @include('includes.ajax.exam_course_on_exam_season_semester')
    @include('includes.ajax.enroll_student_on_exam_season_semester')
@endsection
