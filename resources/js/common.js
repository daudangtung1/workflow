$(function () {
    //Timepicker
    $(".input-time").datetimepicker({
        format: "LT",
        locale: "ja",
    });

    $(".input-date").datetimepicker({
        format: "YYYY-MM-DD",
        locale: "ja",
    });
});
