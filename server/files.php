<?php
    require("confirm.php");
    include("header.php");
    include("secret.php");
    $saveinfo = json_decode(file_get_contents($secret."/savedats.json"));
?>
<table id="t01">
<tr>
    <th>IP</th>
    <th>Date</th>
    <th>Download</th>
    <th>Decode</th>
</tr>
<?php
    foreach ($saveinfo as &$myObj) {
        echo "<tr><td>".$myObj->ip."</td>";
        echo "<td>".date("d.m.Y H:i:s", $myObj->time)."</td>";
        echo '<td><a href="'.$secret."/savedats/".$myObj->name.'.dat" download="save.dat">Download</a></td>';
        echo '<td><a href="file_decode.php?file='.$myObj->name.'">View</a></td></tr>';
    }
    echo "</table>";
    include("footer.php");