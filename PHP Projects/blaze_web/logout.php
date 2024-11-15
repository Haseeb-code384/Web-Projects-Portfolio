<?php 
if(session_status() == PHP_SESSION_NONE){
    // Then start the session
    session_start();
}

// <<<<<<<< To Destroy Sessions

   //Unset Session Variables
session_unset();

   // Destroy
session_destroy();


?>
