@extends('layouts.super_admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Create User</h2>
                </div>

                <div class="panel-body">
                    {{-- some change need
                    must be set form action
                    --}}

                    {{Form::open(['route'=>'user.store','method'=>'post','class'=>'form-horizontal'])}}
                        @include('includes.errors')

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                {{Form::text('name',null,['class'=>'form-control'])}}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                {{Form::text('email',null,['class'=>'form-control'])}}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                {{Form::password('password',['class'=>'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                                {{Form::password('password_confirmation',['class'=>'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Department</label>
                            <div class="col-sm-6">
                                {{Form::select('department',['' => 'Choose']+$roles,null,['class'=>'form-control','id'=>'dept'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_super_admin', 1, null, ['id'=>'super_admin']) !!} Is Super Admin
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{Form::submit('Save',['class'=>'btn btn-success'])}}
                                    <input class="btn btn-danger" type="reset" value="Reset">
                                </div>
                            </div>
                        </div>

                    {{Form::close()}}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#super_admin').change(function(){
            if($(this). prop("checked") == true){
                $('#dept').prop('disabled',true);
            }
            if($(this). prop("checked") == false){
                $('#dept').prop('disabled',false);
            }
        });
        $(document).ready(function(){
            if($('#super_admin').is(':checked')){
                $('#dept').prop('disabled',true);
            }
        });
    </script>
@endsection
