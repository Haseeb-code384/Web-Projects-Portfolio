<?php
//include("allFunctions.php");
function assign_inquiry($email)
{
include("config.php");
include_once("allFunctions.php");
$uid=showQuery("SELECT id FROM `user` WHERE email='$email'");
$preffered_network=showQuery("SELECT preffered_network FROM `user` WHERE email='$email'");
    
     $sql_limits="SELECT status_name,allocate FROM `user_inquiry_limit` WHERE allocate>0 AND status_type='call_status' AND user_id='$uid'  ORDER BY status_type";
    
    $query_limits=mysqli_query($con,$sql_limits);
    while($row_limits=mysqli_fetch_array($query_limits))
    {
        executeQuery("UPDATE `inquiry` SET allocated_to='$email', allocated_at= '$currentDateTime' WHERE call_status='$row_limits[0]' AND permanent_allocation='0' AND id NOT IN(SELECT DISTINCT inquiry_id FROM `inquiry_status_history` WHERE allocated_to!='$email' AND date(time)!=CURRENT_DATE) ORDER BY phone1network='$preffered_network',phone2network='$preffered_network' LIMIT $row_limits[1] ");
        
        
    }
    
     $sql_limits="SELECT status_name,allocate FROM `user_inquiry_limit` WHERE allocate>0 AND status_type='order_status' AND user_id='$uid'  ORDER BY status_type";
    
    $query_limits=mysqli_query($con,$sql_limits);
    while($row_limits=mysqli_fetch_array($query_limits))
    {
        executeQuery("UPDATE `inquiry` SET allocated_to='$email', allocated_at= '$currentDateTime' WHERE order_status='$row_limits[0]' AND permanent_allocation='0' AND id NOT IN(SELECT DISTINCT inquiry_id FROM `inquiry_status_history` WHERE allocated_to!='$email' AND date(time)!=CURRENT_DATE) ORDER BY phone1network='$preffered_network',phone2network='$preffered_network' LIMIT $row_limits[1] ");
        
        
    }
    
    
    executeQuery("INSERT INTO `inquiry_status_history` (SELECT NULL,id,'Allocation','Auto Allocation','$currentDateTime','$email','System' FROM `inquiry` WHERE allocated_to='$email' AND date(allocated_at)=CURRENT_DATE)");
}


function takeback_inquiry($email)
{
include("config.php");
include_once("allFunctions.php");
$uid=showQuery("SELECT id FROM `user` WHERE email='$email'");
$preffered_network=showQuery("SELECT preffered_network FROM `user` WHERE email='$email'");
    
     $sql_limits="SELECT status_name,get_back FROM `user_inquiry_limit` WHERE allocate>0 AND status_type='call_status' AND user_id='$uid'  ORDER BY status_type";
    
    $query_limits=mysqli_query($con,$sql_limits);
    while($row_limits=mysqli_fetch_array($query_limits))
    {
        executeQuery("UPDATE `inquiry` SET allocated_to='', allocated_at= '$currentDateTime' WHERE  permanent_allocation='0' AND call_status='$row_limits[0]' AND allocated_to='$email' AND id NOT IN(SELECT DISTINCT inquiry_id FROM `inquiry_status_history` WHERE allocated_to!='$email' AND date(time)!=CURRENT_DATE) LIMIT $row_limits[1] ");
    }
     $sql_limits="SELECT status_name,get_back FROM `user_inquiry_limit` WHERE allocate>0 AND status_type='order_status' AND user_id='$uid'  ORDER BY status_type";
    
    $query_limits=mysqli_query($con,$sql_limits);
    while($row_limits=mysqli_fetch_array($query_limits))
    {
        executeQuery("UPDATE `inquiry` SET allocated_to='', allocated_at= '$currentDateTime' WHERE  permanent_allocation='0' AND order_status='$row_limits[0]' AND allocated_to='$email' AND id NOT IN(SELECT DISTINCT inquiry_id FROM `inquiry_status_history` WHERE allocated_to!='$email' AND date(time)!=CURRENT_DATE) LIMIT ORDER BY id asc $row_limits[1] ");
    }
    
    
    //executeQuery("INSERT INTO `inquiry_status_history` (SELECT NULL,id,'Taken Back','Auto Get Back','$currentDateTime','','System' FROM `inquiry` WHERE allocated_to='$email' AND date(allocated_at)=CURRENT_DATE)");
}
include("config.php");

$sql="SELECT email FROM `user` WHERE active=1";
$query=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($query))
{
    takeback_inquiry($row[0]);
  assign_inquiry($row[0]);
}


?>