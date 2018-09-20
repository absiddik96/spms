@extends('layouts.super_admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>List of Exam Date</h2>
                </div>
                <div class="panel-body">
                    <form class="" action="{{ route('exam-date.index') }}" method="get">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Exam Season</label>
                                <div class="col-sm-4">
                                    <select required id="exam_season" class="form-control" name="exam_season">
                                        <option value="">Choose</option>
                                        @if ($exam_seasons)
                                            @foreach ($exam_seasons as $es)
                                                <option value="{{ $es->id }}">{{ $es->exam_month.' '.$es->exam_year }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input class="btn btn-primary" type="submit" name="" value="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <th>Serial</th>
                            <th>Exam Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @if ($eds)
                                @foreach ($eds as $ed)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ed->getExamDate() }}</td>
                                        <td>
                                            <form action="{{ route('exam-date.destroy', $ed->id) }}" method="post">
                                                {{ csrf_field() }} {{ method_field('delete') }}

                                                <a class="btn btn-primary" href="{{route('exam-date.edit', $ed->id)}}"><span class="fa fa-edit"> Edit</span></a>


                                                {{-- some change need
                                                data-target 1 changed by databse id
                                                and then id of the next line changed by the same database id
                                                and must be set form action
                                                --}}

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $ed->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                                <!-- -------------------- delete Pop Up --------------------------- -->
                                                <div class="modal fade" id="{{ $ed->id }}" role="dialog">
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
