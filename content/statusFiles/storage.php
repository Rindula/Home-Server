<?php
/*
 * Alle Rechte dieser Website liegen bei Sven Nolting.
 * Medien können unter Umständen von anderen Seiten sein.
 * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
 */

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>
<table style="width: 100%;">
    <tr>
        <td>
            Speicherplatz
        </td>
        <td>
            <style>
                .meter { 
                    height: 20px;  /* Can be anything */
                    position: relative;
                    background: #555;
                    -moz-border-radius: 25px;
                    -webkit-border-radius: 25px;
                    border-radius: 25px;
                    padding: 10px;
                    box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
                }
                .meter > span {
                    display: block;
                    height: 100%;
                    border-top-right-radius: 8px;
                    border-bottom-right-radius: 8px;
                    border-top-left-radius: 20px;
                    border-bottom-left-radius: 20px;
                    background-color: rgb(43,194,83);
                    background-image: linear-gradient(
                        center bottom,
                        rgb(43,194,83) 37%,
                        rgb(84,240,84) 69%
                        );
                    box-shadow: 
                        inset 0 2px 9px  rgba(255,255,255,0.3),
                        inset 0 -2px 6px rgba(0,0,0,0.4);
                    position: relative;
                    overflow: hidden;
                }

                .meter > span:after {
                    content: "";
                    position: absolute;
                    top: 0; left: 0; bottom: 0; right: 0;
                    background-image: linear-gradient(
                        -45deg, 
                        rgba(255, 255, 255, .2) 25%, 
                        transparent 25%, 
                        transparent 50%, 
                        rgba(255, 255, 255, .2) 50%, 
                        rgba(255, 255, 255, .2) 75%, 
                        transparent 75%, 
                        transparent
                        );
                    z-index: 1;
                    background-size: 50px 50px;
                    animation: move 4s linear infinite;
                    border-top-right-radius: 8px;
                    border-bottom-right-radius: 8px;
                    border-top-left-radius: 20px;
                    border-bottom-left-radius: 20px;
                    overflow: hidden;
                }

                @keyframes move {
                    0% {
                        background-position: 0 0;
                    }
                    100% {
                        background-position: 50px 50px;
                    }
                }
            </style>
            <div class="meter animate">
                <span style="width: <?= number_format((1 - (disk_free_space("/") / disk_total_space("/"))) * 100, 2) ?>%"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
            </div>
        </td>
        <td>
            <h3><?= number_format((1 - (disk_free_space("/") / disk_total_space("/"))) * 100, 2, ',', '.'); ?>%</h3>
            <p><?= formatBytes(disk_total_space("/") - disk_free_space("/")) ?> / <?= formatBytes(disk_total_space("/")) ?></p>
        </td>
    </tr>
</table>