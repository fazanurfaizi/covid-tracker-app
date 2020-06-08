/**
 * Scroll to top
 */
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
/**
 * End of scroll to top
 */

 $(document).ready(function() {
     /**
      * Image preview
      */
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
     /**
      * End of Image preview
      */

    // Custom Console Log
    var css = "padding: 60px;text-align: center; background: transparent; color: green; font-size: 64px;"
    console.log("%cWelcome to Covid-19 Tracker App", css);
 });

/**
 * ChartJS Setup
 */
async function getData() {
    const response = await fetch("https://api.covid19api.com/summary");
    const data = await response.json();
    const { NewConfirmed, TotalConfirmed, TotalDeaths, TotalRecovered } = data.Global;
    return { NewConfirmed, TotalConfirmed, TotalDeaths, TotalRecovered };
}

async function setCovid() {
    const data = await getData();
    document.getElementById("new-cases").innerHTML = turnAngka(data.NewConfirmed);
    document.getElementById("recovered").innerHTML = turnAngka(data.TotalRecovered);
    document.getElementById("deaths").innerHTML = turnAngka(data.TotalDeaths);
    document.getElementById("total-cases").innerHTML = turnAngka(data.TotalConfirmed);
}

function turnAngka(number) {
    var num_string = number.toString();
    var sisa = num_string.length % 3;
    var rupiah = num_string.substr(0, sisa);
    var ribuan = num_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? "." : "";
        return (rupiah += separator + ribuan.join("."));
    }
}

async function getLiveData() {

    const response = await fetch("https://api.covid19api.com/live/country/id");
    const data = await response.json();
    const date = [];
    const confirmed = [];
    const deaths = [];
    const recovered = [];
    for(var i = 0; i < data.length; i++) {
        date.push(getFormattedDate(new Date(data[i].Date)));
        //date.push(new Date(data[i].Date).toDateString("DD MM YYYY"));
        confirmed.push(data[i].Confirmed);
        deaths.push(data[i].Deaths);
        recovered.push(data[i].Recovered);
    }
    return { date, confirmed, deaths, recovered };
}

function getFormattedDate(date) {
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : "0" + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : "0" + day;

    return day + "-" + month + "-" + year;
}

charts = {

    initChartsPages: async function() {

        const data = await getData();
        const liveData = await getLiveData();
        const liveDate = [];
        const liveConfirmed = [];
        const liveDeaths = [];
        const liveRecovered = [];
        for(var i = liveData.date.length - 1; i >= liveData.date.length - 15; i--) {
            liveDate.push(liveData.date[i]);
            liveConfirmed.push(liveData.confirmed[i]);
            liveDeaths.push(liveData.deaths[i]);
            liveRecovered.push(liveData.recovered[i]);
        }
        liveDate.reverse();
        liveConfirmed.reverse();
        liveDeaths.reverse();
        liveRecovered.reverse();

        ctx = document.getElementById("covidChart").getContext("2d");

        myChart = new Chart(ctx, {
            type: "bar",

            data: {
                labels: liveDate,
                datasets: [
                    {
                        // Recovered
                        label: "Recovered",
                        borderColor: "#6bd098",
                        backgroundColor: "#6bd098",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                        data: liveRecovered
                    },
                    {
                        // Active Case / Confirmed
                        label: "Confirmed",
                        borderColor: "#fcc468",
                        backgroundColor: "#fcc468",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                        data: liveConfirmed
                    },
                    {
                        // Deaths
                        label: "Deaths",
                        borderColor: "#f17e5d",
                        backgroundColor: "#f17e5d",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                        data: liveDeaths
                    }
                ]
            },
            options: {
                legend: {
                    display: true
                },

                tooltips: {
                    enabled: true
                },

                scales: {
                    yAxes: [
                        {
                            ticks: {
                                fontColor: "#9f9f9f",
                                beginAtZero: true,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                drawBorder: true,
                                zeroLineColor: "#ccc",
                                color: "rgba(255,255,255,0.05)"
                            }
                        }
                    ],
                    xAxes: [
                        {
                            barPercentage: 1.6,
                            gridLines: {
                                drawBorder: true,
                                color: "rgba(255,255,255,0.1)",
                                zeroLineColor: "transparent",
                                display: true
                            },
                            ticks: {
                                padding: 20,
                                fontColor: "#9f9f9f"
                            }
                        }
                    ]
                }
            }
        });

        ctx = document.getElementById("covidPie").getContext("2d");
        myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: ["total recovered", "total confirmed", "total deaths"],
                datasets: [
                    {
                        label: [
                            "total recovered",
                            "total confirmed",
                            "total deaths"
                        ],
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        backgroundColor: ["#6bd098", "#fcc468", "#f17e5d"],
                        borderWidth: 0,
                        data: [data.TotalRecovered, data.TotalConfirmed, data.TotalDeaths]
                    }
                ]
            },

            options: {
                legend: {
                    display: true
                },

                pieceLabel: {
                    render: "percentage",
                    fontColor: ["white"],
                    precision: 2
                },

                tooltips: {
                    enabled: true
                },

                scales: {
                    yAxes: [
                        {
                            ticks: {
                                display: false
                            },
                            gridLines: {
                                drawBorder: false,
                                zeroLineColor: "transparent",
                                color: "rgba(255,255,255,0.05)"
                            }
                        }
                    ],

                    xAxes: [
                        {
                            barPercentage: 2,
                            gridLines: {
                                drawBorder: false,
                                color: "rgba(255,255,255,0.1)",
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                display: false
                            }
                        }
                    ]
                }
            }
        });
    }
};
/**
 * End of ChartJS Setup
 */
