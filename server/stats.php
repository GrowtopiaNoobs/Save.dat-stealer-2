<?php
    require("confirm.php");
    include("header.php");
    include("secret.php");
    $saveinfo = json_decode(file_get_contents($secret."/savedats.json"));
    $count = 0;
    foreach ($saveinfo as &$myObj) {
        $count++;
    }
    echo "There are ".$count." files in total.";
    include("footer.php");