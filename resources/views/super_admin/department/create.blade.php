@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Create Department Name</h2>
            </div>

            <div class="panel-body">
                {{-- some change need
                must be set form action
                --}}

                <form class="form-horizontal" action="{{ route('department.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('includes.errors');


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-6">
                            <input type="text" name="dept" value="{{ old('dept')}}"  placeholder="Add here" class="form-control">
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
