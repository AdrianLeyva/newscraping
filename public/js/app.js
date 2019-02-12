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