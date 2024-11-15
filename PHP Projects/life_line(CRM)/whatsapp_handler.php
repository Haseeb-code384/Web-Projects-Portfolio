<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );
$number = $_REQUEST[ 'number' ];
$inqury_id = $_REQUEST[ 'inqury_id' ];
$order_id = $_REQUEST[ 'order_id' ];
$referrer = isset( $_SERVER[ 'HTTP_REFERER' ] ) ? $_SERVER[ 'HTTP_REFERER' ] : '';
executeQuery( "INSERT INTO `whatsapp_history` (`id`, `time`, `user`, `number`, `inquiry_id`,`referrer`,`order_id`) VALUES (NULL, '$currentDateTime', '$_SESSION[email]', '$number', '$inqury_id','$referrer','$order_id')" );
header( "Location: https://api.whatsapp.com/send/?phone=$number&text&type=phone_number&app_absent=0" )
?>