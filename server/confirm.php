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
if(!$_SESSION["isLoggedIn"])
{
    die();
}