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
                                    <div style="height: 145mm;">
                                        <img style="max-width: 100mm;" src="title.png" alt=""/>
                                    </div>
                                </td>
                                <td>
                                    <h1>Einladung</h1>
                                    <h2>zur Geburtstagsparty</h2>
                                    <h3>Ich werde 18</h3>
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
                                    <div style="height: 145mm">
                                        <h1>DU BIST EINGELADEN<br><?= $name ?></h1>
                                        <h2>Mitzubringen sind:</h2>
                                        <ul>
                                            <li>Schlafsack</li>
                                            <li>Filme (auch auf Blu-Ray)</li>
                                            <li>Taschenlampen</li>
                                        </ul>
                                        <h2>Wann und wo?</h2>
                                        <p>Am <span class="important">Freitag, den 13.07.2018</span> ab <span class="important">15:00 Uhr</span> treffen wir uns bei mir (<span class="important">74889 Sinsheim, Hinterer Hettenberg 16</span>)</p>
                                        <h2>WhatsApp</h2>
                                        <p>Scanne den Barcode um beizutreten</p>
                                        <img style="height: 3.5cm" src="qrcode.jpg" alt="">
                                    </div>
                                </td>
                                <td>
                                    <h2>Was wir machen</h2>
                                    <p>Geplant ist Kuchenessen, ein Filmabend unter freiem Himmel mit anschließender Nachtwanderung und Übernachtung. Wir können am Lagerfeuer grillen, wenn also irgendwelche Wünsche oder vorlieben/nicht-ess-wünsche gibt, bitte vorher bescheid sagen!</p>
                                    <p>Es können (wahrscheinlich) nicht alle übernachten, deshalb gilt: Wer den weiteren Weg hat, hat vorrang.</p>
                                    <p class="important">Als Zusage gilt, wer in der WhatsApp Gruppe ist.</p>
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