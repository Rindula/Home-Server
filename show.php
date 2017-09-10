<head>
    <link id="styler" rel="stylesheet" type="text/css" />
    <script>
        function refresher()
        {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    document.getElementById("content").innerHTML = xhr.responseText;
                    setTimeout(refresher, 3000);
                }
            }
            xhr.open('GET', 'list.php', true);
            xhr.send(null);
        }

        function dayNightCycle() {
            var style = document.getElementById("styler");
            var now = new Date();
            if (now.getHours() >= 7 && now.getHours() < 20) {
                if (style.href !== "main_day.css") {
                    style.href = "main_day.css";
                }
            } else {
                if (style.href !== "main_night.css") {
                    style.href = "main_night.css";
                }
            }
            setTimeout(dayNightCycle, 1000);
        }

        dayNightCycle();
        refresher();
    </script>
</head>
<body>
    <div id="content">
        <h1>Kalender wird geladen...</h1>
    </div>
</body>
