function search_title(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "query.php?type=searchT&q=" + text, true);
    xhttp.send();
}
function search_author(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "query.php?type=searchA&q=" + text, true);
    xhttp.send();
}