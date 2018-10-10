@extends('layouts.student')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Change Password</h3>
            </div>
            <div class="panel-body">
                {{Form::open(['route'=>'student.change-password.submit','method'=>'post','class'=>'form-horizontal'])}}
                    @include('includes.errors')
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('old_password', ['class'=>'form-control','required'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('password', ['class'=>'form-control','required'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-6">
                            {!! Form::password('password_confirmation', ['class'=>'form-control','required'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            {!! Form::submit('Submit', ['class'=>'pull-right btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
