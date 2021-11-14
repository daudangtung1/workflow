const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/common.js", "public/js")
    .sass("resources/sass/app.scss", "public/css");

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
