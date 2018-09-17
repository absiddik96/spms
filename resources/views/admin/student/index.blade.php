@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>List of Student</h3>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Batch</th>
                            <th>Reg No</th>
                            <th>Class Roll</th>
                            <th>Exam Roll</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp

                            @if ($students)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->batch->batch_number}}</td>
                                        <td>{{ $student->reg_no}}</td>
                                        <td>{{ $student->class_roll}}</td>
                                        <td>{{ $student->exam_roll}}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <form action="{{ route('student.destroy', $student->id) }}" method="post">
                                                {{ csrf_field() }} {{ method_field('delete') }}
                                                <a class="btn btn-primary" href="{{ route('student.edit', $student->id) }}"><span class="fa fa-edit"> Edit</span></a>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $student->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                                <!-- -------------------- delete Pop Up --------------------------- -->
                                                <div class="modal fade" id="{{ $student->id }}" role="dialog">
                                                    @include('includes.delete')
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
