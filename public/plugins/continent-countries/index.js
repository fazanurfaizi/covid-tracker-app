function setRegions() {
    for (region in countries)
        document.write(
            '<option value="' + region + '">' + region + "</option>"
        );
}

function setCountry(oRegionSel, oCountrySel, ocityStatesel) {
    var countryArr;
    oCountrySel.length = 0;
    ocityStatesel.length = 0;
    var region = oRegionSel.options[oRegionSel.selectedIndex].text;
    if (countries[region]) {
        oCountrySel.disabled = false;
        ocityStatesel.disabled = true;
        oCountrySel.options[0] = new Option("SELECT COUNTRY", "");
        countryArr = countries[region].split("|");
        for (var i = 0; i < countryArr.length; i++)
            oCountrySel.options[i + 1] = new Option(
                countryArr[i],
                countryArr[i]
            );
        document.getElementById("txtregion").innerHTML = region;
        document.getElementById("txtplacename").innerHTML = "";
    } else oCountrySel.disabled = true;
}

function setCityState(oCountrySel, ocityStatesel) {
    var city_stateArr;
    ocityStatesel.length = 0;
    var country = oCountrySel.options[oCountrySel.selectedIndex].text;
    if (cityStates[country]) {
        ocityStatesel.disabled = false;
        ocityStatesel.options[0] = new Option("SELECT NEAREST DIVISION", "");
        city_stateArr = cityStates[country].split("|");
        for (var i = 0; i < city_stateArr.length; i++)
            ocityStatesel.options[i + 1] = new Option(
                city_stateArr[i],
                city_stateArr[i]
            );
        document.getElementById("txtplacename").innerHTML = country;
        getCountryName(country)
    } else ocityStatesel.disabled = true;
}

function getCountryName(country) {
    console.log(country);
}

function printCityState(oCountrySel, ocityStatesel) {
    var country = oCountrySel.options[oCountrySel.selectedIndex].text;
    var city_state = ocityStatesel.options[ocityStatesel.selectedIndex].text;
    if (city_state && cityStates[country].indexOf(city_state) != -1)
        document.getElementById("txtplacename").innerHTML =
            city_state + ", " + country;
    else document.getElementById("txtplacename").innerHTML = country;
}
