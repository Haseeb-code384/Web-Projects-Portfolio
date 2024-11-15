<?php
include( "config.php" );
include( "allFunctions.php" );
$limit=50;
$sql_user="SELECT email FROM `user` WHERE active=1 AND is_seller='Yes';";
$query_user=mysqli_query($con,$sql_user);
while($row_user=mysqli_fetch_array($query_user))
{
    echo "UPDATE `inquiry` SET allocated_at=CURRENT_TIMESTAMP WHERE phone1network IN (SELECT network FROM `user_networks` WHERE username='$row_user[email]') AND allocated_to='$row_user[email]'  AND call_status='Pending'  AND record_type='Inquiry' ORDER BY  `inquiry`.`last_updated_at` DESC LIMIT $limit; <br>";
    
    
}
?>