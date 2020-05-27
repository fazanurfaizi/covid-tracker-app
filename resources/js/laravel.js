import $ from "jquery";
import "select2";
import "bootstrap";
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

var laravel = {
    initialize: function() {
        this.methodLinks = $("a[data-method]");
        this.token = $("a[data-token]");
        this.registerEvents();
    },

    registerEvents: function() {
        var id = $(this).data("id");
        this.methodLinks.on("click", this.handleMethod);
    },

    handleMethod: function(e) {
        var method = $(this).data("method").toUpperCase();
        var form;
        var name = $(this).data("name");
        var confirm = $(this).data("confirm").split("|");
        var message = $(this).data("message");
        var button = $(this).data("button").split("|");
        var callback = $(this).data("callback").split("|");
        var canceled = $(this).data("canceled");

        if ($.inArray(method, ["PUT", "DELETE"]) === -1) {
            return;
        }

        form = laravel.createForm($(this));
        laravel.verifyConfirm(
            form,
            name,
            confirm[0],
            confirm[1],
            message,
            button[0],
            button[1],
            callback[0],
            callback[1],
            canceled
        );

        e.preventDefault();
    },

    verifyConfirm: function(
        form,
        name,
        title,
        text,
        message,
        yes,
        cancel,
        successCallback,
        cancelesuccessCallback,
        canceled
    ) {
        swal({
            title: `${title}`,
            text: `${text} ${name}`,
            icon: "warning",
            buttons: [cancel, yes],
            dangerMode: true
        }).then(function(confirm) {
            if (confirm) {
                swal({
                    title: successCallback,
                    text: `${message} ${name}`,
                    icon: "success",
                    timer: 2000
                }).then(function() {
                    form.submit();
                });
            } else {
                swal(canceled, `${cancelesuccessCallback} ${name}`, "error");
            }
        });
    },

    createForm: function(link) {
        var form = $("<form>", {
            method: "POST",
            action: link.attr("href")
        });

        var token = $("<input>", {
            type: "hidden",
            name: "_token",
            value: link.data("token")
        });

        var hiddenInput = $("<input>", {
            name: "_method",
            type: "hidden",
            value: link.data("method")
        });

        return form.append(token, hiddenInput).appendTo("body");
    }
};

laravel.initialize();
