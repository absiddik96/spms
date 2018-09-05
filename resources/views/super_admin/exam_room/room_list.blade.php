@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>List of Exam Room : {{ $exam_season->exam_month.' '.$exam_season->exam_year }}</h2>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                      <th>Serial</th>
                      <th>Block Name</th>
                      <th>Room Number</th>
                      <th>Number Of Bench</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @php
                       $i=1;
                        @endphp
                      @if ($rooms)
                        @foreach ($rooms as $room)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $room->getName() }}</td>
                          <td>{{ $room->room_number }}</td>
                          <td>{{ $room->number_of_bench }}</td>
                          <td>
                              <form action="{{ route('exam-room.destroy', $room->id) }}" method="post">
                                  {{ csrf_field() }} {{ method_field('delete') }}

                                  <a class="btn btn-primary" href="{{route('exam-room.edit', $room->id)}}"><span class="fa fa-edit"> Edit</span></a>

                                  {{-- some change need
                                  data-target 1 changed by databse id
                                  and then id of the next line changed by the same database id
                                  and must be set form action
                                  --}}

                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $room->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                  <!-- -------------------- delete Pop Up --------------------------- -->
                                  <div class="modal fade" id="{{ $room->id }}" role="dialog">
                                      @include('includes.delete')
                                  </div>
                              </form>
                          </td>
                          @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
