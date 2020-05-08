//
// --------------------------------------------------------------------------------
//
$("#email").change(function () {
    // cek email
    var email = $(this).val();
    checkInputAjax("email", email);
});
//
// --------------------------------------------------------------------------------
//
$("#username").change(function () {
    // cek username
    var username = $(this).val();
    checkInputAjax("username", username);
});
//
// --------------------------------------------------------------------------------
//
function checkInputAjax(field, value) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: routecheck,
        data: {
            field: field,
            value: value,
        },
        success: function (res) {
            if (res.errors) {
                var id = "#" + field;
                $(id).addClass(" invalid ");
                $(id).attr("data-toggle", "popover");
                $(id).attr("data-placement", "right");
                $(id).attr("title", "Error!");
                $(id).attr("data-content", res.errors);
                $(id).popover("show");
            } else {
                var id = "#" + field;
                $(id).removeClass(" invalid ");
                $(id).attr("data-toggle", "");
                $(id).attr("data-placement", "");
                $(id).attr("title", "");
                $(id).attr("data-content", "");
                $(id).popover("hide");
            }
        },
    });
}
//
// --------------------------------------------------------------------------------
//
