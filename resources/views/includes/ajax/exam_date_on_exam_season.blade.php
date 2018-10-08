<script type="text/javascript">
$('#exam_season').on('change', function () {
    var exam_season_id = $(this).val();
    $.ajax({
        url: "{{ route('ajax.exam.dates.season') }}",
        type: "get",
        data: {'exam_season_id': exam_season_id},
        dataType: "json",
        success: function (data) {
            $('#exam_date').html('<option value="">Choose</option>');
            $.each(data, function(key, value) {
                $('#exam_date')
                .append($("<option></option>")
                .attr("value",value.id)
                .text(value.date));
            });
        }
    });
});
</script>
