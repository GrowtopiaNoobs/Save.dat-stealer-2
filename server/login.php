<?php
session_start();
if(isset($_POST["password"]))
{
    include("secret.php");
    if(password_verify($_POST["password"], file_get_contents($secret."/password.txt")))
    {
        $includeHead = '<meta http-equiv="refresh" content="0; url=/files.php" />';
        $_SESSION["isLoggedIn"]=true;
        include("header.php");
    } else {
        include("header.php");
        echo("<h1>Wrong password!</h1><br>");
    }
} else if(isset($_SESSION["isLoggedIn"])&&$_SESSION["isLoggedIn"]==true)
{
    $includeHead = '<meta http-equiv="refresh" content="0; url=/files.php" />';
    $_SESSION["isLoggedIn"]=true;
    include("header.php");
} else {
    include("header.php");
}
?>
<form action="" method="post">
  <fieldset class="fieldset-auto-width">
    <legend>Log in:</legend>
    Password:<br>
    <input type="password" name="password" value=""><br><br>
    <input class="btn" type="submit" value="Submit">
  </fieldset>
</form>
<?php
include("footer.php");