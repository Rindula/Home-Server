<!DOCTYPE html>
<html>
    <head>
        <style>
            .calendar_cell {
                width: 140px;
                min-height: 150px;
                border: 1px solid black;
                background-color: #9966ff;
                color: white;
                transition: .2s all linear;
                border-radius: 5px;
            }

            .calendar div:not(.thisMonth) {
                background-color: #cccccc;
            }

            .termin {
                background-color: #ff8566;
            }
        </style>
    </head>
    <body>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Montag</th>
                    <th>Dienstag</th>
                    <th>Mittwoch</th>
                    <th>Donnerstag</th>
                    <th>Freitag</th>
                    <th>Samstag</th>
                    <th>Sonntag</th>
                </tr>
            </thead>
            <?php
            $db_link = mysqli_connect("localhost", "root", "SiSal2002", "terminkalender");

            $monat = date("n");
            $jahr = date("Y");
            $sql = "SELECT id, datum, titel, beschreibung FROM termine WHERE YEAR(datum) = '$jahr' AND MONTH(datum) = '$monat' ORDER BY datum ASC";


            if (date("w") != 1) {
                $diff = date("w", date("Y") . "-" . (date("m") - 1) . "-" . cal_days_in_month(CAL_GREGORIAN, date("n") - 1, date("Y")));
                $day = cal_days_in_month(CAL_GREGORIAN, date("n") - 1, date("Y")) - $diff - 1;
                $month = date("n") - 1;
            } else {
                $day = 1;
                $month = date("n");
            }

            $done = false;
            for ($n = 1; !$done; $n++) {
                ?>
                <tr>
                    <?php
                    for ($i = 0; $i < 7; $i++) {
                        $day++;
                        if ((cal_days_in_month(CAL_GREGORIAN, $month, date("Y")) < $day)) {
                            $day = 1;
                            $month++;
                            if ($n >= 4) {
                                $done = true;
                            }
                        }
                        $classes = "calendar_cell";
                        if (date("n") == $month) {
                            $classes .= " thisMonth";
                        }
                        $termin = "";
                        $date = date("Y") . "-" . $month . "-" . $day;
                        $db_erg = $db_link->query($sql);
                        while ($zeile = mysqli_fetch_assoc($db_erg)) {
                            if (date("Y-m-d", strtotime($date)) == date("Y-m-d", strtotime($zeile["datum"]))) {
                                $termin = "<b>-" . $zeile["titel"] . "</b>";
                                $classes .= " termin";
                                break;
                            }
                        }
                        ?>
                        <td><div class="<?= $classes ?>"><h3>&nbsp;<?= $day ?></h3><br><?= $termin ?></div></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>

    </body>
</html>