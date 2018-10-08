<script type="text/javascript">
    $(document).ready(function () {
        $('.on_chng').on('change', function () {

            var exam_season_id = $('#exam_season').val();
            var exam_date_id = $('#exam_date').val();
            var exam_shift_time_id = $('#exam_shift_time').val();
            var exam_room_id = $('#exam_room').val();
            var semester_id = $('#semester_id').val();
            var exam_course_id = $('#exam_course').val();

            if (exam_season_id == '') {
                $('#unhide').prop('hidden', true);
            } else {
                $('#unhide').prop('hidden', false);
                $.ajax({
                    url: "{{ route('student-room-enrolls.get_data') }}",
                    type: "get",
                    data: {
                        'exam_season_id': exam_season_id,
                        'exam_date_id': exam_date_id,
                        'exam_shift_time_id': exam_shift_time_id,
                        'exam_room_id': exam_room_id,
                        'semester_id': semester_id,
                        'exam_course_id': exam_course_id,
                    },
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
