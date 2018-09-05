@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Update Exam Season</h2>
            </div>

            <div class="panel-body">
                {{-- some change need
                must be set form action
                --}}

                <form class="form-horizontal" action="{{ route('exam-season.update', $exam_season->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('put')}}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Month</label>
                        <div class="col-sm-6">
                            <select name="exam_month" class="form-control">
                                <option {{ $exam_season->exam_month == 'Janaury'? 'selected' : '' }} value='Janaury'>Janaury</option>
                                <option {{ $exam_season->exam_month == 'February'? 'selected' : '' }} value='February'>February</option>
                                <option {{ $exam_season->exam_month == 'March'? 'selected' : '' }} value='March'>March</option>
                                <option {{ $exam_season->exam_month == 'April'? 'selected' : '' }} value='April'>April</option>
                                <option {{ $exam_season->exam_month == 'May'? 'selected' : '' }} value='May'>May</option>
                                <option {{ $exam_season->exam_month == 'June'? 'selected' : '' }} value='June'>June</option>
                                <option {{ $exam_season->exam_month == 'July'? 'selected' : '' }} value='July'>July</option>
                                <option {{ $exam_season->exam_month == 'August'? 'selected' : '' }} value='August'>August</option>
                                <option {{ $exam_season->exam_month == 'September'? 'selected' : '' }} value='September'>September</option>
                                <option {{ $exam_season->exam_month == 'October'? 'selected' : '' }} value='October'>October</option>
                                <option {{ $exam_season->exam_month == 'November'? 'selected' : '' }} value='November'>November</option>
                                <option {{ $exam_season->exam_month == 'December'? 'selected' : '' }} value='December'>December</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Year</label>
                        <div class="col-sm-6">
                            <input type="text" pattern="\d*" maxlength="4" name="exam_year" class="form-control" value="{{ $exam_season->exam_year }}">
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                <input class="btn btn-success" type="submit" value="Update">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
