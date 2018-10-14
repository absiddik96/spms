@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Teachers Room Enroll</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher</th>
                                <th>Exam Room</th>
                                <th>Exam Shift & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($teachers)
                                @php
                                    $i=1
                                @endphp
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $teacher->teacher->name }} {{ $teacher->is_chief?'( Chief )':'' }}</td>
                                        <td>{{ $teacher->examRoom->getName().' --- '.$teacher->examRoom->room_number }}</td>
                                        <td>{{ $teacher->examShiftTime->getStartTime() .' ( '. $teacher->examShiftTime->getShift() .' ) ' }}</td>
                                        <td>
                                            <form action="{{ route('teacher-room-enroll.destroy', $teacher->id) }}" method="post">
                                                {{ csrf_field() }} {{ method_field('delete') }}

                                                @if ($teacher->is_chief)
                                                    <a class="btn btn-sm btn-warning" href="{{ route('teacher-room-enrolls.is-hief', $teacher->id) }}">Remove from Chief</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary" href="{{ route('teacher-room-enrolls.is-hief', $teacher->id) }}">Make Chief</a>
                                                @endif

                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#{{ $teacher->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                                <!-- -------------------- delete Pop Up --------------------------- -->
                                                <div class="modal fade" id="{{ $teacher->id }}" role="dialog">
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
