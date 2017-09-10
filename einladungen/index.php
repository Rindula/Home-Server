<html>
    <head>
        <title>Einladungspreset</title>
        <link href="main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="book">
            <?php
            /*
             * Alle Rechte dieser Website liegen bei Sven Nolting.
             * Medien können unter Umständen von anderen Seiten sein.
             * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
             */

            $contents = file('namen.txt');

            foreach ($contents as $line) {
                $name = strtoupper($line);
                ?>

                <div class="page">
                    <div class="subpage">
                        <table>
                            <tr>
                                <td>
                                    <img src="kerze.jpg" alt=""/>
                                </td>
                                <td>
                                    <h1>Einladung</h1>
                                    <h2>zur Geburtstagsparty</h2>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="page">
                    <div class="subpage">
                        <table>
                            <tr>
                                <td>
                                    <h1>DU BIST EINGELADEN<br><?= $name ?></h1>
                                    <h2>Mitzubringen sind:</h2>
                                    <ul>
                                        <li>Sachen zum Zelten</li>
                                        <li>Laptop</li>
                                        <li>Spaß</li>
                                    </ul>
                                    <h2>Wann und wo?</h2>
                                    <p>Am <b>Samstag, den 22.07.2017</b> um <b>15:00 Uhr</b> treffen wir uns bei mir (<b>74889 Sinsheim, Hinterer Hettenberg 16</b>)</p>
                                </td>
                                <td>
                                    <h2>Was wir machen</h2>
                                    <p>Geplant ist Kuchenessen, eine Lanparty unter freiem Himmel mit anschließender Übernachtung unter dem Sternenhimmel in Zelten und am Lagerfeuer im Garten. Zu Abend wir es Nudelsalat geben, bei Extrawünschen bitte vorher bescheid geben!</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>