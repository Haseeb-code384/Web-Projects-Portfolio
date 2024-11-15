<?php
session_start();
if ( !isset( $_SESSION[ 'email' ] ) ) {
  header( "location: login.php" );
}
include( "includes/navbar.php" );

  $currentPage = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
<title><?php echo $project_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- Bootstrap core CSS-->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom fonts for this template-->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Page level plugin CSS--> 
<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">
 
<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="dist2/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="dist2/css/bootstrap-multiselect.css" type="text/css"/>
     
</head>
<?php include("end.php"); ?>