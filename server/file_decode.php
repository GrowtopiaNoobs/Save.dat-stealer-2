<?php
require("confirm.php");
include("secret.php");
include("header.php");
include("password_decoder.php");
$data = get_savedat($secret."/savedats/".$_GET["file"].".dat");
$keys = array_keys($data);
echo('<table id="t01">
    <tr>
    <th>Var Name</th>
    <th>Var Data</th>
    </tr>');
foreach ($keys as &$key) {
    echo "<tr><td>".$key."</td><td>".$data[$key]."</td></tr>";
}
echo "</table>";
include("footer.php");