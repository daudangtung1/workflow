const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy("resources/js/common.js", "public/js");

//adminlte
mix.css(
    "node_modules/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
    "public/css"
).copy("node_modules/popper.js/dist/popper.js.map", "public/js");

//timepicker
mix.copy(
        "node_modules/admin-lte/plugins/moment/moment.min.js",
        "public/js/datepicker"
    )
    .copy(
        "node_modules/admin-lte/plugins/moment/moment.min.js.map",
        "public/js/datepicker"
    )
    .copy(
        "node_modules/admin-lte/plugins/moment/locale/ja.js",
        "public/js/datepicker"
    )
    .copy(
        "node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
        "public/js/datepicker"
    )
    .copy(
        "node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
        "public/css/datepicker"
    );
//daterangerpicker
mix.copy(
    "node_modules/daterangepicker/daterangepicker.js",
    "public/js/daterangepicker"
).copy(
    "node_modules/daterangepicker/daterangepicker.css",
    "public/css/daterangepicker"
);
//select2
mix.copy("node_modules/select2/dist/js/select2.min.js", "public/js/select2")
    .copy("node_modules/select2/dist/css/select2.min.css", "public/css/select2");

//datatable
mix.copy("node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js", "public/js/datatables")
    .copy("node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js", "public/js/datatables")
    .copy("node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css", "public/css/datatables")
    .copy("node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js", "public/js/datatables")
    .copy("node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js", "public/js/datatables")
    .copy("node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css", "public/css/datatables")
    /////
    .copy("node_modules/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js", "public/js/datatables");

//mix custom style
mix.sass("resources/sass/approver/overtime.scss", "public/css/approver/");
mix.sass("resources/sass/approver/parttime.scss", "public/css/approver/");