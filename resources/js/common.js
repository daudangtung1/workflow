$(function() {
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

//loading
function loading() {
    $('body').prepend(`<div class="modal-loading fade " data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 48px">
                    <span class="fa fa-spinner fa-spin fa-3x"></span>
                </div>
            </div>
        </div>`);

    $('.modal-loading').modal('show');
}

function unLoading() {
    $('.modal-loading').modal('hide');
    setTimeout(() => {
        $('body .modal-loading').remove();
    }, 500);
}