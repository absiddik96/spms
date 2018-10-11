@extends('layouts.student')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <img width="80px" src="{!! asset('images/logo/gb_logo.png') !!}" alt="">
                    <h3>Gono Bishwabidyalay</h3>
                </div>
                <br>
                <table class="table no-border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Date</th>
                            <th>Course</th>
                            <th>Shift</th>
                            <th>Time</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($seat_plans->count())
                            @php
                                $i=1
                            @endphp
                            @foreach ($seat_plans as $seat_plan)
                                <tr>
                                    <td width="1px">{{ $i++ }}</td>
                                    <td width="10%">{{ $seat_plan->examDate->getExamDate() }}</td>
                                    <td width="50%">{{ $seat_plan->courseEnroll->course->name.' --- '.$seat_plan->courseEnroll->course->code }}</td>
                                    <td width="15%">{{ $seat_plan->examShiftTime->getShift() }}</td>
                                    <td width="10%">{{ $seat_plan->examShiftTime->getStartTime() }}</td>
                                    <td width="10%">{{ $seat_plan->examRoom->getName().' - '.$seat_plan->examRoom->room_number }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
