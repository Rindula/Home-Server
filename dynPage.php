<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
echo "data: ";

error_reporting(-1);

$xml = simplexml_load_file( "http://armasquads.de/user/squads/xml/BpotpTeaYUIg7JXDMucXMPkl0SQ3cAVf/squad.xml" );   

echo "<h1>".$xml->name."</h1>";
echo "<h2>".$xml->title."</h2>";
echo "<table>";
echo "<tr class='headline'>";
echo "<th style='border-bottom: 1px solid; border-left: 1px solid;'>ID</th>";
echo "<th style='border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;'>Username</th>";
echo "<th style='border-bottom: 1px solid;'>Name</th>";
echo "<th style='border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;'>Rang</th>";
echo "<th style='border-bottom: 1px solid; border-right: 1px solid;'>Kontakt (E-Mail)</th>";
echo "</tr>";
foreach ( $xml->member as $user )   
{   
    echo "<tr style='border-bottom: 1px solid;'>";
   echo '<td style="border-bottom: 1px solid; border-left: 1px solid;">' . $user['id'] . '</td>';   
   echo '<td style="border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">' . $user['nick'] . '</td>';   
      
   echo '<td style="border-bottom: 1px solid;">' . $user->name . '</td>';   
   echo '<td style="border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">' . $user->remark . '</td>';
   echo '<td style="border-bottom: 1px solid; border-right: 1px solid;">' . preg_replace('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/', '<a href="mailto:$1">$1</a>', $user->email) . '</td>';   
    echo "</tr>";
    
}   
echo "</table><br>";

echo "<h1 style='text-align: center; font-size: 100px; position: relative; top: 40%;'>".date('d.m.Y')."<br>".date('H:i', time())." Uhr</h1>\n\n";
flush();
?>