@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Create Room Details</h2>
            </div>

            <div class="panel-body">
                {{-- some change need
                must be set form action
                --}}

                <form class="form-horizontal" action="{{ route('exam-room.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('includes.errors');

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Season</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="exam_season_id">
                                <option value="">Choose</option>
                                @if ($exam_seasons->count())
                                    @foreach ($exam_seasons as $exam_season)
                                        <option value="{{ $exam_season->id }}">{{ $exam_season->exam_month.' '.$exam_season->exam_year }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Block</label>
                        <div class="col-sm-6">
                            {{Form::select('block',[''=>'Choose']+$block,null,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Room Number</label>
                        <div class="col-sm-6">
                            <input type="number" name="room_number" value="{{ old('room_number')}}"  placeholder="Room Number" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Number of Bench </label>
                        <div class="col-sm-6">
                            <input type="number" name="number_of_bench" value="{{ old('number_of_bench')}}"  placeholder="Number Of Bench" class="form-control">
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
