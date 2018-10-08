<script type="text/javascript">
$(document).ready(function () {
    $('.season_semester').on('change', function () {
        var semester_id = $('#semester_id').val();
        var exam_season_id = $('#exam_season').val();
        
        $.ajax({
            url: "{{ route('ajax.exam.courses.season.semester') }}",
            type: "get",
            data: {'semester_id': semester_id,'exam_season_id': exam_season_id},
            dataType: "json",
            success: function (data) {
                $('#exam_course').html('<option value="">Choose</option>');
                $.each(data, function(key, value) {
                    $('#exam_course')
                    .append($("<option></option>")
                    .attr("value",value.id)
                    .text(value.course));
                });
            }
        });
    });
});
</script>
