@extends('layouts.student')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Profile</h3>
            </div>
            <div class="panel-body">
                <table class="table no-border">
                    <tr>
                        <td width="130px">Name</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->name }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Email</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->email }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Batch</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->batch->batch_number }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Class Roll</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->class_roll }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Exam Roll</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->exam_roll }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Registration No</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->reg_no }}</td>
                    </tr>
                    <tr>
                        <td width="130px">Department</td>
                        <td width="3px">:</td>
                        <td>{{ $profile->department->dept }}</td>
                    </tr>
                </table>
            </div>

            <div class="panel-footer">
                <a href="{!! route('student.change-password') !!}" class="pull-right btn btn-primary">Change Password</a>
            </div>
        </div>
    </div>
@endsection
