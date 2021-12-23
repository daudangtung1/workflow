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
    $("body .modal-backdrop").remove();
    $("body")
        .prepend(`<div class="modal-loading fade " data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 48px">
                    <span class="fa fa-spinner fa-spin fa-3x"></span>
                </div>
            </div>
        </div>`);

    $(".modal-loading").modal("show");
}

function unLoading() {
    $(".modal-loading").modal("hide");
    $("body .modal-loading").remove();
    $("body .modal-backdrop").remove();
}

$(document).on("click", ".sidebar-toggle", function() {
    if (
        $("body").hasClass("sidebar-collapse") &&
        $("body").hasClass("sidebar-open")
    ) {
        $("body").removeClass("sidebar-collapse");
    }
});

//clock
function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    //Add a zero in front of numbers<10
    hr = checkRealTime(hr);
    min = checkRealTime(min);
    sec = checkRealTime(sec);
    document.getElementById("clockReal").innerHTML = hr + " : " + min;
    // document.getElementById("clockReal").innerHTML = hr + " : " + min + " : " + sec;

    var months = [
        "01",
        "02",
        "03",
        "04",
        "05",
        "06",
        "07",
        "08",
        "09",
        "10",
        "11",
        "12",
    ];
    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date =
        curYear +
        "/" +
        checkRealTime(curMonth) +
        "/" +
        checkRealTime(curDay) +
        "(月)";
    document.getElementById("dateReal").innerHTML = date;

    var time = setTimeout(function() {
        startTime();
    }, 30000);
}

function checkRealTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
startTime();

$(window).resize(function() {
    if ($(window).width() > 1100) {
        $("body").removeClass("sidebar-collapse");
    } else {
        $("body").addClass("sidebar-collapse");
    }

    if ($(window).width() < 991) {
        console.log($(window).width());
        $('.role-name').removeClass('menu-is-opening');
        $('.role-name').removeClass('menu-open');
        $('.role-name ul').css('display', 'none');

    }
});
$(window).on("orientationchange", function() {
    setTimeout(() => {
        if ($(window).width() > 1024) {
            $("body").removeClass("sidebar-collapse");
        } else {
            $("body").addClass("sidebar-collapse");
        }
    }, 500);
});
$(window).resize();
$(document).on("click", "#sidebar-overlay", function() {
    if ($("body").hasClass("sidebar-open")) {
        $("body").removeClass("sidebar-open");
        $("body").addClass("sidebar-collapse sidebar-closed");
    }
});

function makeDangerAlert(message, id) {
    $(`#${id}`).html("");
    $(`#${id}`)
        .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>${message}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`);
}