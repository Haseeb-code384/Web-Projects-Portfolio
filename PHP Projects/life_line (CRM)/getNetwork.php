<?php
include('config.php');
include('allFunctions.php');
$num=$_GET['num'];



if(strlen($num)>=5){

$res = mysqli_query( $con ,"SELECT network FROM `network_series` WHERE series='$num'" );
	$row=mysqli_fetch_array($res);
    if($row[0]!="")
    {
populateDDsel("network","network","network",$row[0]);   
    }
    else
    {
        echo "<option>Other</option>";
    }
}
else
{
    populateDDsel("network","network","network","");   
}






?>