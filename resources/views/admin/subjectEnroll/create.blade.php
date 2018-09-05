@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Subject Enroll</h3>
            </div>

            <div class="panel-body">

                {{Form::open(['route'=>'subject-enroll.store','method'=>'post','class'=>'form-horizontal'])}}
                    @include('includes.errors')


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester</label>
                        <div class="col-sm-6">
                            {{Form::select('semester',[''=>'Choose']+$semesters,null,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Subject</label>
                        <div class="col-sm-6">
                            {{Form::select('subject',[''=>'Choose']+$subjects,null,['class'=>'form-control'])}}
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
