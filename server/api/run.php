<?php
include("../secret.php");
if(isset($_POST["data"]))
{
    $dataToSave = base64_decode(preg_replace('/\s+/', '+', $_POST["data"]));
    $name = md5(base64_encode($dataToSave));
    $fp = fopen("../".$secret."/savedats/".$name.".dat", 'w');
    fwrite($fp, $dataToSave);
    fclose($fp);
    $saveinfo = json_decode(file_get_contents("../".$secret."/savedats.json"));
    $myObj = new stdClass();
    $myObj->ip = $_SERVER['REMOTE_ADDR'];
    $myObj->name = $name;
    $myObj->time = time();
    $saveinfo[] = $myObj;
    file_put_contents("../".$secret."/savedats.json", json_encode($saveinfo));
}
