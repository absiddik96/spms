@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Course Enroll</h3>
            </div>

            <div class="panel-body">

                {{Form::open(['route'=>'course-enroll.store','method'=>'post','class'=>'form-horizontal'])}}
                    @include('includes.errors')


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Exam Season</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="exam_season">
                                <option value="">choose</option>
                                @foreach ($exam_seasons as $es)
                                    <option value="{{ $es->id }}">{{ $es->exam_month.' '.$es->exam_year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester</label>
                        <div class="col-sm-6">
                            {{Form::select('semester',[''=>'Choose']+$semesters,null,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Course</label>
                        <div class="col-sm-6">
                            {{Form::select('course',[''=>'Choose']+$courses,null,['class'=>'form-control'])}}
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
