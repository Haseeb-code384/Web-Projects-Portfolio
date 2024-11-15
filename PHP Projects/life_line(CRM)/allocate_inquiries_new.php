<?php
include( "config.php" );
include( "allFunctions.php" );
$limit=50;
$sql_user="SELECT email FROM `user` WHERE active=1 AND is_seller='Yes';";
$query_user=mysqli_query($con,$sql_user);
while($row_user=mysqli_fetch_array($query_user))
{
    executeQuery("UPDATE `inquiry` SET allocated_at='$currentDateTime',allocated_to='$row_user[email]' WHERE phone1network IN (SELECT network FROM `user_networks` WHERE username='$row_user[email]') AND  record_type='Inquiry' AND allocated_to='' and record_date>='2024-05-01'  limit 15 ; ");
    
    
}
?>
