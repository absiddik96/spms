@extends('layouts.user')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <img width="80px" src="{!! asset('images/logo/gb_logo.png') !!}" alt="">
                    <h3>Gono Bishwabidyalay</h3>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Date</th>
                            <th>Room</th>
                            <th>Shift</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($invigilating_areas->count())
                            @php
                                $i=1
                            @endphp
                            @foreach ($invigilating_areas as $ia)
                                <tr>
                                    <td width="5%">{{ $i++ }}</td>
                                    <td width="20%">{{ $ia->examDate->getExamDate() }}</td>
                                    <td width="20%">{{ $ia->examRoom->getName().' - '.$ia->examRoom->room_number }}</td>
                                    <td width="20%">{{ $ia->examShiftTime->getShift() }}</td>
                                    <td width="20%">{{ $ia->examShiftTime->getStartTime() }}</td>
                                    <td width="15%">
                                        <button type="button" class="btn btn-xs btn-info" data-toggle="collapse" data-target="#dates{{ $ia->id }}" aria-expanded="true"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0; border:0" colspan="6">
                                        <div id="dates{{ $ia->id }}" class="collapse" aria-expanded="false" style="">
                                            <table style="margin:0" class="table">
                                                @if ($ia->invigilators)
                                                    @foreach ($ia->invigilators as $invigilator)
                                                        <tr>
                                                            <td width="4%">Date</td>
                                                            <td width="1%">:</td>
                                                            <td width="94%">
                                                                {{ $invigilator->invigilator->name }} {{ $invigilator->is_chief?'( Chief )':'' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
