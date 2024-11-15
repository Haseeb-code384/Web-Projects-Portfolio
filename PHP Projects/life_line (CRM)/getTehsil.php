<?php
include('config.php');
$dist=$_GET['dist'];



if($dist!=""){

$res = mysqli_query( $con ,"SELECT distinct tehsil FROM `tehsils` WHERE district='$dist' ORDER BY `district` ASC" );
	
echo "<option value='tehsil'>"; echo "Select Tehsil"; echo "</option>";

while($row=mysqli_fetch_array($res)){
	
	echo "<option value='$row[0]' >"; echo $row[0]; echo "</option>";
	
	
	
}
}






?>