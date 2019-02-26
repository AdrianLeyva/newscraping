var titles = [];
$(document).ready(function() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            titles = JSON.parse(this.responseText);
            $('#searchInput').autocomplete({
                source: titles
            });
        }
    };
    xmlhttp.open("GET", "requests.php", true);
    xmlhttp.send();
});

$('#sources').change(function() {
    var value = $('#sources').val();
    window.location.href="index.php?source=" + value;
});

$('#searchButton').click(function() {
    var value = $('#searchInput').val();
    window.open("detailed.php?title=" + value);
});

$('#filterButton').click(function() {
    var YEAR = 0; var MONTH = 1; var DAY = 2;
    var MONTHS_NAME = {
        "01": "January",
        "02": "February",
        "03": "March",
        "04": "April",
        "05": "May",
        "06": "June",
        "07": "July",
        "08": "August",
        "09": "September",
        "10": "October",
        "11": "November",
        "12": "December" 
    }

    var value = $('#filterInput').val();
    var dateSplit = value.split("-");
    var year = dateSplit[YEAR];
    var month = dateSplit[MONTH];
    var day = dateSplit[DAY];
    var formattedDate = day + " " + MONTHS_NAME[month] + " " + year;

    console.log(formattedDate);
    window.open("filter.php?date=" + formattedDate)
});