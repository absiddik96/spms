@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>List of Exam Shift & Time</h2>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                      <th>Serial</th>
                      <th>Exam Season</th>
                      <th>Exam Shift</th>
                      <th>Exam Start Time</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @php
                       $i=1;
                        @endphp
                      @if ($ests)
                        @foreach ($ests as $est)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $est->examSeason->exam_month.' '.$est->examSeason->exam_year }}</td>
                          <td>{{ $est->getShift() }}</td>
                          <td>{{ $est->getStartTime() }}</td>

                            <td>
                                <form action="{{ route('shift-time.destroy', $est->id) }}" method="post">
                                    {{ csrf_field() }} {{ method_field('delete') }}

                                    <a class="btn btn-primary" href="{{route('shift-time.edit', $est->id)}}"><span class="fa fa-edit"> Edit</span></a>


                                    {{-- some change need
                                            data-target 1 changed by databse id
                                            and then id of the next line changed by the same database id
                                            and must be set form action
                                    --}}

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $est->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                    <!-- -------------------- delete Pop Up --------------------------- -->
                                    <div class="modal fade" id="{{ $est->id }}" role="dialog">
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
