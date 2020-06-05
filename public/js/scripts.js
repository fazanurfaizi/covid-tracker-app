$(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
        $("#back-to-top").fadeIn();
    } else {
        $("#back-to-top").fadeOut();
    }
});

$("#back-to-top").click(function() {
    $("body,html").animate(
        {
            scrollTop: 0
        },
        900
    );
    return false;
});

var css = "padding: 60px;text-align: center; background: transparent ; color: green; font-size: 50px;"
console.log("%cWelcome to Covid-19 Tracker App Console", css);
