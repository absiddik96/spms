@extends('layouts.student')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Exam Season</h3>
            </div>
            <div class="panel-body">
                <table class="table no-border">
                    @if ($exam_seasons->count())
                        @php
                            $i=1
                        @endphp
                        @foreach ($exam_seasons as $exam_season)
                            <tr>
                                <td width="1px">{{ $i++ }}</td>
                                <td>
                                    <a href="{!! route('student.seat.plan',$exam_season->exam_season_id) !!}">{{ $exam_season->exam_month.' '.$exam_season->exam_year }}</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
