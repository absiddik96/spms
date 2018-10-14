@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Exam Season</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam Season</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($exam_seasons)
                                @php
                                    $i=1
                                @endphp
                                @foreach ($exam_seasons as $exam_season)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $exam_season->exam_month.' '.$exam_season->exam_year }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="collapse" data-target="#dates{{ $exam_season->exam_season_id }}" aria-expanded="true"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0; border:0" colspan="3">
                                            <div id="dates{{ $exam_season->exam_season_id }}" class="collapse" aria-expanded="false" style="">
                                                <table style="margin:0" class="table">
                                                    @if ($exam_season->examDates)
                                                        @foreach ($exam_season->examDates as $date)
                                                            <tr>
                                                                <td width="4%">Date</td>
                                                                <td width="1%">:</td>
                                                                <td width="94%">
                                                                    <a href="{!! route('teacher-room-enrolls.show',['exam_season_id'=>$exam_season->exam_season_id,'date_id'=>$date->id]) !!}">{{ $date->getExamDate() }}</a>
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
    </div>
@endsection
