@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Subject Enroll Info</h3>
            </div>

            <div class="panel-body">

                {{Form::open(['route'=>'subject-enroll.show','method'=>'get','class'=>'form-horizontal'])}}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester</label>
                        <div class="col-sm-4">
                            {{Form::select('semester_id',[''=>'Choose']+$semesters,null,['class'=>'form-control'])}}
                        </div>
                        <div class="col-sm-3">
                            <input class="btn btn-success" type="submit" value="Get Info">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>All Subjet</h3>
            </div>

            <div class="panel-body">

                @if (isset($subEnrolls) && count($subEnrolls))
                    <table class="table table-border">
                        <thead>
                            <th>Subject</th>
                            <th>Subject Code</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($subEnrolls as $enroll)
                                <tr>
                                    <td>{{ $enroll->subject->name }}</td>
                                    <td>{{ $enroll->subject->code }}</td>
                                    <td>
                                        <p><b>{{ $enroll->teacher->name }}</b></p>
                                        <p style="margin:0">{{ $enroll->teacher->email }}</p>
                                    </td>
                                    <td>
                                            {{Form::open(['route'=>['subject-enroll.destroy',$enroll->id],'method'=>'delete'])}}
                                            <a class="btn btn-xs btn-primary" href="{{route('subject-enroll.edit', $enroll->id)}}"><span class="fa fa-edit"> Edit</span></a>
                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{ $enroll->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                            <!--  delete Pop Up  -->
                                            <div class="modal fade" id="{{ $enroll->id }}" role="dialog">
                                                @include('includes.delete')
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No Subject found!</p>
                @endif

            </div>
        </div>
    </div>


</div>
@endsection
