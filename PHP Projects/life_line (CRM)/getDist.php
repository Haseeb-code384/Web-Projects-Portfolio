<?php
include('config.php');
$prov=$_GET['prov'];



if($prov!=""){

$res = mysqli_query( $con ,"SELECT distinct district FROM `tehsils` WHERE province='$prov' ORDER BY `district` ASC" );
	
echo "<option value='district'>"; echo "Select District"; echo "</option>";

while($row=mysqli_fetch_array($res)){
	
	echo "<option value='$row[0]' >"; echo $row[0]; echo "</option>";
	
	
	
}
}






?>