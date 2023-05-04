$(document).ready(function() {
    $('.flatpickr-hour').attr("max", 2);

    $('.flatpickr-hour').on('keyup', function() {
        limitText(this, 2)
    });

    function limitText(field, maxChar) {
        var ref = $(field),
            val = ref.val();
        if (val.length >= maxChar) {
            ref.val(function() {
                return val.substr(0, maxChar);
            });
        }
    }
});