<script>
    function unroll(elmnt, enroll_id) {
        var exam_season_id = $('#exam_season').val();
        var exam_date_id = $('#exam_date').val();
        var exam_shift_time_id = $('#exam_shift_time').val();
        var exam_room_id = $('#exam_room').val();
        var semester_id = $('#semester_id').val();
        var exam_course_id = $('#exam_course').val();

        $.ajax({
            url: "{{ route('student-room-enrolls.unroll') }}",
            type: "get",
            data: {
                'enroll_id': enroll_id ,
                'exam_season_id': exam_season_id,
                'exam_date_id': exam_date_id,
                'exam_shift_time_id': exam_shift_time_id,
                'exam_room_id': exam_room_id,
                'semester_id': semester_id,
                'exam_course_id': exam_course_id,
            },
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

        var exam_season_id = $('#exam_season').val();
        var exam_date_id = $('#exam_date').val();
        var exam_shift_time_id = $('#exam_shift_time').val();
        var exam_room_id = $('#exam_room').val();
        var semester_id = $('#semester_id').val();
        var exam_course_id = $('#exam_course').val();

        var enroll_id = $("input[name='student_id[]']")
            .map(function(){return $(this).val();}).get();
        $.ajax({
            url: "{{ route('student-room-enrolls.unroll') }}",
            type: "get",
            data: {
                'enroll_id': enroll_id ,
                'exam_season_id': exam_season_id,
                'exam_date_id': exam_date_id,
                'exam_shift_time_id': exam_shift_time_id,
                'exam_room_id': exam_room_id,
                'semester_id': semester_id,
                'exam_course_id': exam_course_id,
            },
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
            var exam_season_id = $('#exam_season').val();
            var exam_date_id = $('#exam_date').val();
            var exam_shift_time_id = $('#exam_shift_time').val();
            var exam_room_id = $('#exam_room').val();
            var semester_id = $('#semester_id').val();
            var exam_course_id = $('#exam_course').val();

            $.ajax({
                url: "{{ route('student-room-enrolls.unroll') }}",
                type: "get",
                data: {
                    'enroll_id': enroll_id ,
                    'exam_season_id': exam_season_id,
                    'exam_date_id': exam_date_id,
                    'exam_shift_time_id': exam_shift_time_id,
                    'exam_room_id': exam_room_id,
                    'semester_id': semester_id,
                    'exam_course_id': exam_course_id,
                },
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
