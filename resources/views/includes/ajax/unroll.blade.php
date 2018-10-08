<script>
    function unroll(elmnt, enroll_id) {
        var semester_id = $('#semester').val();
        var exam_season_id = $('#exam_season').val();

        $.ajax({
            url: "{{ route('student-room-enrolls.unroll') }}",
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
            url: "{{ route('student-room-enrolls.unroll') }}",
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
                url: "{{ route('student-room-enrolls.unroll') }}",
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
