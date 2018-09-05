@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-left" style="margin-right: 10px;">
                    {{Form::open(['route'=>'subject-enroll.show','method'=>'get'])}}
                        <input type="hidden" name="semester_id" value="{{ $subEnroll->semester_id }}">
                        <input class="btn btn-xs btn-default" type="submit" value="<< Back">
                    </form>
                </div>
                <h3>Edit Subject Enroll</h3>
            </div>

            <div class="panel-body">

                {{Form::model($subEnroll,['route'=>['subject-enroll.update',$subEnroll->id],'method'=>'put','class'=>'form-horizontal'])}}
                    @include('includes.errors')


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester</label>
                        <div class="col-sm-6">
                            {{Form::select('semester',[''=>'Choose']+$semesters,$subEnroll->semester_id,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Subject</label>
                        <div class="col-sm-6">
                            {{Form::select('subject',[''=>'Choose']+$subjects,$subEnroll->subject_id,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Teacher</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="teacher">
                                <option value="{{ $subEnroll->teacher_id }}">{{ $subEnroll->teacher->name }} [{{ $subEnroll->teacher->email }}]</option>
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

                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
