@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>List of Batch</h3>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <th>#</th>
                            <th>Batch</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp

                            @if ($batches)
                                @foreach ($batches as $batch)
                                    <tr>
                                        <td width="10%">{{ $i++ }}</td>
                                        <td width="80%">
                                            <a href="{!! route('student.list',$batch->id) !!}">{{ $batch->batch_number }}</a>
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
