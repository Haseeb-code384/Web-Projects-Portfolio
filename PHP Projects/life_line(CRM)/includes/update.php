<?php
include("../config.php");
$id=$_REQUEST['id'];
$txt=$_REQUEST['v'];
$p=$_REQUEST['p'];
$l=$_REQUEST['l'];
$s=$_REQUEST['s'];
$srt=$_REQUEST['srt'];
$count=count($p);
for($i=0;$i<$count;$i++)
{
	$sql="UPDATE `menu` SET `menu_name` = '$txt[$i]',  `parent_id` = '$p[$i]',  `link` = '$l[$i]', `status` = '$s[$i]', `sort` = '$srt[$i]' WHERE `menu`.`menu_id` = $id[$i];";
	mysqli_query($con,$sql);
}
header("location: naveditor.php");
?>