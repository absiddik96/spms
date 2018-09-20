@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Create Exam Date</h2>
            </div>

            <div class="panel-body">
                {{-- some change need
                must be set form action
                --}}

                <form class="form-horizontal" action="{{ route('exam-date.store') }}" method="post" enctype="multipart/form-data">
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
                        <label class="col-sm-3 control-label">Exam Date </label>
                        <div class="col-sm-6">
                            <input type="text" hidden class="datepicker" name="" value="">
                            <input autocomplete="off" name="exam_date" type="text" id="dp-3" class="form-control" value="{{ old('exam_date')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
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
