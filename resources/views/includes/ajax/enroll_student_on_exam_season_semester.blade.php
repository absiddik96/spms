<script type="text/javascript">
$(document).ready(function () {
    $('.season_semester').on('change', function () {
        var semester_id = $('#semester_id').val();
        var exam_season_id = $('#exam_season').val();
        if (semester_id == '') {
            $('#unhide').prop('hidden', true);
        } else {
            $('#unhide').prop('hidden', false);
            $.ajax({
                url: "{{ route('student-room-enroll.index') }}",
                type: "get",
                data: {'semester_id': semester_id,'exam_season_id': exam_season_id},
                dataType: "json",
                success: function (data) {
                    $('#show_data').html(data);
                    // alert(data)
                },
                error: function () {
                    $('#show_data').html("no data found");
                }
            });
        }
    });
});
</script>
