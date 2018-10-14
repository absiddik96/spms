
@extends('layouts.admin')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('teacher-room-enroll.store') }}" method="post" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Create Teacher Room Enroll</h3>
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
                            <label class="col-sm-3 control-label">Teacher</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="teacher">
                                    <option value="">Choose</option>
                                    @if ($teachers)
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->user_id }}">{{ $teacher->name }} [{{ $teacher->email }}]</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div style="padding-top:10px" class="col-sm-6">
                                <input type="checkbox" name="is_chief" value="1"> Is Chief
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    <input class="btn btn-success" type="submit" value="Save">
                                    <input class="btn btn-danger" type="reset" value="Reset">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('includes.ajax.exam_date_on_exam_season')
    @include('includes.ajax.exam_room_on_exam_season')
    @include('includes.ajax.exam_shift_time_on_exam_season')
@endsection
