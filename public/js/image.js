$("#image").on("change", function() {
    var fileName = $(this).val();
    $(this)
        .next(".custom-file-label")
        .html(fileName);
});

function readUrl(url) {
    if (url.files && url.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#image-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(url.files[0]);
    }
}

$("#image").change(function() {
    readUrl(this);
});
