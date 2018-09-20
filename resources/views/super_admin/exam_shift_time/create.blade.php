@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Create Exam Shift & Time</h2>
            </div>

            <div class="panel-body">
                {{-- some change need
                must be set form action
                --}}

                <form class="form-horizontal" action="{{ route('shift-time.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('includes.errors');

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Season</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="exam_season">
                                <option value="">Choose</option>
                                @if ($exam_seasons)
                                    @foreach ($exam_seasons as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_month.' '.$es->exam_year }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Shift</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="shift">
                                <option value="">Choose</option>
                                @if ($shifts)
                                    @foreach ($shifts as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Start Time </label>
                        <div class="col-sm-6">
                            <input type="time" name="time" value="{{ old('time')}}"  placeholder="Add here" class="form-control">
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

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
