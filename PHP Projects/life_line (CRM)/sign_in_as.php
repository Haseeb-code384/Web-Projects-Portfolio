<?php session_start();
session_destroy();
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

echo "<script>alert('YOU ARE BEING SIGNED IN AS $username PLEASE WAIT...');</script>";
$page="login.php?username=$username&password=$password&login=Sign+in";

header("Location: ".$page);
echo "<script>window.location.href='$page'</script>";

?>