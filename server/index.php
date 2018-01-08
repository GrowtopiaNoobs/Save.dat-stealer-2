<?php
session_start();
function firstTime()
{
    ?>
    Welcome!<br>
    Please select your secret password to access administration (can be later changed in FTP):
    <form action="" method="post">
  <fieldset class="fieldset-auto-width">
    <legend>Create Account:</legend>
    Password:<br>
    <input type="password" name="password" value=""><br>
    Password again:<br>
    <input type="password" name="password2" value=""><br><br>
    <input class="btn" type="submit" value="Submit">
  </fieldset>
</form>
<?php
}
if(file_exists("secret.php"))
{
    $includeHead = '<meta http-equiv="refresh" content="0; url=/login.php" />';
    include("header.php");
    include("footer.php");
} else {
    $msg = "";
    if(isset($_POST["password"]) && isset($_POST["password2"]))
    {
        if($_POST["password"]!==$_POST["password2"] || $_POST["password"]=="")
        {
            $msg = "Passwords doesn't match or are empty!<br>";
        } else {
            $_SESSION["isLoggedIn"]=true;
            $file = 'people.txt';
            $secret = md5(rand());
            file_put_contents("secret.php", '<?php $secret="'.$secret.'";');
            mkdir($secret);
            mkdir($secret."/savedats");
            $myfile = fopen($secret . "/password.txt", "w") or die("Unable to open file!");
            fwrite($myfile, password_hash($_POST["password"], PASSWORD_BCRYPT));
            fclose($myfile);
            $dats_info=array();
            $myfile2 = fopen($secret . "/savedats.json", "w") or die("Unable to open file!");
            fwrite($myfile2, json_encode($dats_info));
            fclose($myfile2);
            $includeHead = '<meta http-equiv="refresh" content="0; url=/files.php" />';
        }
    }
    include("header.php");
    firstTime();
    echo "<h1>".$msg."</h1>";
    include("footer.php");
}