@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>List of Exam Room</h2>
            </div>
            <div class="panel-body">
                <div class="col-md-5">
                    <ul class="list-group">
                        <li class="list-group-item  bg-info"><h3 style="color: white; padding-top:11px">List of Exam Season</h3></li>
                        @foreach ($exam_seasons as $exam_season)
                            @if ($exam_season->exam_rooms()->count())
                                <a href="{{ route('super-admin.exam-room.list',$exam_season->id) }}"><li class="list-group-item bg-primary">
                                    {{ $exam_season->exam_month.' '.$exam_season->exam_year }}
                                </li></a>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
