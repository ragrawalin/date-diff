$(document).ready(function() {
    // you may need to change this code if you are not using Bootstrap Datepicker
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#form_fromDate').datepicker()
        .on('changeDate', function (e){
            $('#form_toDate').datepicker('setStartDate', e.date);
        });

    $('#form_toDate').datepicker()
        .on('changeDate', function (e){
            $('#form_fromDate').datepicker('setEndDate', e.date);
        });
});