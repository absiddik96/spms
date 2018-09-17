@extends('layouts.admin')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('student.index') }}">List of Student</a></li>
        <li class="active">{{ $student->name }}</li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Update Student</h3>
                </div>

                <div class="panel-body">
                    {{-- some change need
                    must be set form action
                    --}}

                    <form class="form-horizontal" action="{{ route('student.update',$student->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('put') }}
                        @include('includes.errors')

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control" value='{{ $student->name }}'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Batch</label>
                            <div class="col-sm-6">
                                <select name="batch_id" class="form-control">
                                    <option value="{{ $student->batch_id }}">{{$student->batch->batch_number}}</option>
                                    <option value="">Select Batch</option>
                                    @if ($batches)
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->batch_number }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Class Roll</label>
                            <div class="col-sm-6">
                                <input type="text" name="class_roll" class="form-control" value='{{ $student->class_roll }}'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Roll</label>
                            <div class="col-sm-6">
                                <input type="text" name="exam_roll" class="form-control" value='{{ $student->exam_roll }}'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Registration No</label>
                            <div class="col-sm-6">
                                <input type="text" name="reg_no" class="form-control" value='{{ $student->reg_no }}'>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <hr>
                                <label for="">Student Loing Credentials</label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control" value='{{ $student->email }}'>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select name="is_active" class="form-control select">
                                    <option value="{{$student->is_active}}">{{ $student->isActive()?'Active':'Deactive' }}</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
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
