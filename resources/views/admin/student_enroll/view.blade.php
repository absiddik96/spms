@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Student Enroll</h3>
                </div>

                <div class="panel-body">
                    {{-- some change need
                    must be set form action
                    --}}



                    {{ csrf_field() }}
                    @include('includes.errors')
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Season</label>
                            <div class="col-sm-6">
                                <select id="exam_season" class="form-control on_chng" name="exam_season">
                                    <option value="">choose</option>
                                    @foreach ($exam_seasons as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_month.' '.$es->exam_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Semester</label>
                            <div class="col-sm-6">
                                <select id="semester" name="semester_id" class="form-control select on_chng">
                                    <option value="">Select Semester</option>
                                    @if ($semesteres)
                                        @foreach ($semesteres as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div id="unhide" hidden="" class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Student List</h3><input type="checkbox" id="select_all"/>
                    </div>
                    <div class="panel-body">
                        <div id="show_data"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-danger" value="All Unroll" onclick="unrolls()">
                            <input type="submit" class="btn btn-danger" value="Unroll" id="btn_" >
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#select_all').on('click', function () {
                if (this.checked) {
                    $('.checkbox').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox').each(function () {
                        this.checked = false;
                    });
                }
            });

            $('.checkbox').on('click', function () {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.on_chng').on('change', function () {

                var semester_id = $('#semester').val();
                var exam_season_id = $('#exam_season').val();
                if (semester_id == '') {
                    $('#unhide').prop('hidden', true);
                } else {
                    $('#unhide').prop('hidden', false);
                    $.ajax({
                        url: "{{ route('student-enrolls.get_data') }}",
                        type: "get",
                        data: {'semester_id': semester_id,'exam_season_id': exam_season_id},
                        dataType: "json",
                        success: function (data) {
                            $('#show_data').html(data);
                        },
                        error: function () {
                            $('#show_data').html("No data found");
                        }
                    });
                }
            });
        });
    </script>

    <script>
        function unroll(elmnt, enroll_id) {
            var semester_id = $('#semester').val();
            var exam_season_id = $('#exam_season').val();

            $.ajax({
                url: "{{ route('student-enrolls.unroll') }}",
                type: "get",
                data: {'enroll_id': enroll_id , 'semester_id': semester_id,'exam_season_id': exam_season_id},
                dataType: "json",
                success: function (data) {
                    $('#unhide').prop('hidden', false);
                    $('#show_data').html(data);
                },
                error: function () {
                    $('#show_data').html("No data found");
                }
            });
        }
    </script>

    <script>
        function unrolls() {

            var semester_id = $('#semester').val();
            var exam_season_id = $('#exam_season').val();

            var enroll_id = $("input[name='student_id[]']")
                .map(function(){return $(this).val();}).get();
            $.ajax({
                url: "{{ route('student-enrolls.unroll') }}",
                type: "get",
                data: {'enroll_id': enroll_id , 'semester_id': semester_id,'exam_season_id': exam_season_id},
                dataType: "json",
                success: function (data) {
                    $('#unhide').prop('hidden', false);
                    $('#show_data').html(data);
                },
                error: function () {
                    $('#show_data').html("No data found");
                }
            });
        }
    </script>

    <script type="text/javascript">
        $("#btn_").on('click', function () {
            var enroll_id = "";
            var ischecked = "";
            $(":checkbox").each(function () {
                var ischecked = $(this).is(":checked");
                if (ischecked && $(this).val() != 'on') {
                    enroll_id += $(this).val()+ ",";
                }
            });
            if(enroll_id)
            {
                var semester_id = $('#semester').val();
                var exam_season_id = $('#exam_season').val();

                $.ajax({
                    url: "{{ route('student-enrolls.unroll') }}",
                    type: "get",
                    data: {'enroll_id': enroll_id , 'semester_id': semester_id,'exam_season_id': exam_season_id},
                    dataType: "json",
                    success: function (data) {
                        $('#unhide').prop('hidden', false);
                        $('#show_data').html(data);
                    },
                    error: function () {
                        $('#show_data').html("No data found");
                    }
                });
            }
        });
    </script>

@endsection
