@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>List of Department</h2>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                      <th>Serial</th>
                      <th>Department Name</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @php
                       $i=1;
                        @endphp
                      @if ($departments)
                        @foreach ($departments as $department)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $department->dept }}</td>

                            <td>
                                <form action="{{ route('department.destroy', $department->id) }}" method="post">
                                    {{ csrf_field() }} {{ method_field('delete') }}

                                    <a class="btn btn-primary" href="{{route('department.edit', $department->id)}}"><span class="fa fa-edit"> Edit</span></a>


                                    {{-- some change need
                                            data-target 1 changed by databse id
                                            and then id of the next line changed by the same database id
                                            and must be set form action
                                    --}}

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $department->id }}"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                                    <!-- -------------------- delete Pop Up --------------------------- -->
                                    <div class="modal fade" id="{{ $department->id }}" role="dialog">
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
