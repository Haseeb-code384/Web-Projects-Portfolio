<?php
session_start();
$current_user=$_SESSION['login_user'];
if(session_destroy())
{
header("Location: login.php");
}
?>