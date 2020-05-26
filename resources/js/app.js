import $ from "jquery";
import "select2";
import "bootstrap";
import swal from "sweetalert";

$(document).ready(function() {
    $(".select2").select2();
    $(".select2-tags").select2({
        width: "resolve"
    });
    $("#alert-success").fadeTo(2000, 300).slideUp(300, function() {
        $("#alert-success").slideUp(300);
    })
})

var laravel = {
    initialize: function () {
        this.methodLinks = $("a[data-method]");
        this.token = $("a[data-token]");
        this.registerEvents();
    },

    registerEvents: function () {
        this.methodLinks.on("click", this.handleMethod);
    },

    handleMethod: function (e) {
        var link = $(this);
        var method = link.data("method").toUpperCase();
        var form;
        var name = link.data("name");

        if ($.inArray(method, ["PUT", "DELETE"]) === -1) {
            return;
        }

        form = laravel.createForm(link);
        laravel.verifyConfirm(form, name);

        e.preventDefault();
    },

    verifyConfirm: function (form, name) {
        swal({
            title: "Are you sure?",
            text: `You will delete this ${name}`,
            icon: "warning",
            buttons: [
                'No, Cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true
        }).then(function(confirm) {
            if(confirm) {
                swal({
                    title: "Delete Successfully",
                    text: `You are successfully deleted this ${name}!`,
                    icon: "success",
                    timer: 2000
                }).then(function () {
                    form.submit();
                });
            } else {
                swal("Canceled", `You canceled to delete this ${name}`, "error");
            }
        })
    },

    createForm: function (link) {
        var form = $("<form>", {
            method: "POST",
            action: link.attr("href"),
        });

        var token = $("<input>", {
            type: "hidden",
            name: "_token",
            value: link.data("token"),
        });

        var hiddenInput = $("<input>", {
            name: "_method",
            type: "hidden",
            value: link.data("method"),
        });

        return form.append(token, hiddenInput).appendTo("body");
    },
};

laravel.initialize();
