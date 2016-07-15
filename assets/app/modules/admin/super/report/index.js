$(function () {
    $('#createAt').change(function () {

        window.location.href = '/admin/report?date=' + $(this).val();
    });

    $('.datespan').text($('#createAt').find('option:selected').text());
});