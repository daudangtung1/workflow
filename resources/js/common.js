$(function () {
    //Timepicker
    $(".input-time").datetimepicker({
        useCurrent: false,
        format: "LT",
        locale: "ja",
    });

    $(".input-date").datetimepicker({
        useCurrent: false,
        format: "YYYY-MM-DD",
        locale: "ja",
    });
});
