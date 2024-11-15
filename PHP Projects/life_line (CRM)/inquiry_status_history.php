<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
if ( check_admin( $_SESSION[ 'email' ] ) ) {
  $sql = "SELECT type,status,time,allocated_to,allocated_by,order_no,comments FROM `inquiry_status_history` WHERE inquiry_id='$id' ORDER BY id DESC";
} else {
  $sql = "SELECT type,status,time,allocated_to,allocated_by,order_no,comments FROM `inquiry_status_history` WHERE inquiry_id='$id' AND (time>=(SELECT MAX(time) FROM `inquiry_status_history` WHERE inquiry_id='$id' AND type='Allocation') AND time>=(SELECT MAX(time) FROM `inquiry_status_history` WHERE inquiry_id='$id' AND type='Inquiry Added') )   ORDER BY id DESC";
}
//echo $sql;
$queryview = mysqli_query( $con, $sql );

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<h1 align="center">Inquiry Status History (Inquiry ID<?php echo $id; ?>)</h1>
<body>
<table border="1" width="100%">
  <thead align="center">
    <tr align="center" bgcolor="#48BDD5">
      <th>Type</th>
      <th>Status</th>
      <th>Comment</th>
      <th>Time</th>
      <th>Allocated To</th>
      <th>Allocated By</th>
      <th>Order ID</th>
    </tr>
  </thead>
  <?php
  while ( $rowview = mysqli_fetch_array( $queryview ) ) {

    ?>
  <tr align="center">
    <td><?php echo $rowview[0]; ?></td>
    <td><?php echo $rowview[1]; ?></td>
    <td><?php echo $rowview[6]; ?></td>
    <td><?php echo change_datetime_ddmmyyyhis($rowview[2]); ?></td>
    <td><?php echo $rowview[3]; ?></td>
    <td><?php echo $rowview[4]; ?></td>
    <td><?php echo $rowview[5]; ?></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
