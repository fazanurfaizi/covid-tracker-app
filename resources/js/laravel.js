import $ from "jquery";
import "select2";
import swal from "sweetalert";

$(document).ready(function() {
    $(".select2").select2();
    $(".select2-tags").select2({
        width: "resolve"
    });
    $("#alert-success")
        .fadeTo(2000, 300)
        .slideUp(500, function() {
            $("#alert-success").slideUp(500);
        });
});
