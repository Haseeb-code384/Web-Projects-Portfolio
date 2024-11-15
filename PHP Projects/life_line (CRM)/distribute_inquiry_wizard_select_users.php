<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $i = 0;

  $emp = $_REQUEST[ 'emp' ];
  $stat = $_REQUEST[ 'status' ];

  foreach ( $stat as $status ) {
    executeQuery( "UPDATE `user` SET allow_shuffling='$status' WHERE email='$emp[$i]';" );
    $i++;
  }
  alertredirect("User Selection Completed","distribute_inquiry_wizard_select_disease.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>
<?php
include "preloader.php";
?>
<?php

include "start.php";
?>
</div>
<div class="content-wrapper">
<div class="container-fluid">
  <?php
  include( "distribute_inquiry_wizard_tabs.php" );
  ?>
  <div class="row" style="">
    <form method="post" action="">
      <?php include("fix_header.php"); ?>
          <tr class="" align="center">
            <th width="50" height="23">Sn</th>
            <th width="180" >Seller Username</th>
            <th width="240">Seller Name</th>
            <th width="240">Team</th>
            <th colspan="2" align="center" >Allow Shuffling</th>
          </tr>
          <tr style="height: 10px;">
            <th colspan="4"></th>
            <th width="10">Yes</th>
            <th width="10">No</th>
          </tr>
        </thead>
        <?php
        $i = 1;
        $sqls = "SELECT * FROM `user` WHERE active=1 AND is_seller='Yes' order by user_group";
        $querys = mysqli_query( $con, $sqls );
        while ( $rows = mysqli_fetch_array( $querys ) ) {
          ?>
        <tr class="">
          <td align="center"><?php  echo($i); ?></td>
          <td align="center" class=""><?php  echo($rows['email']); ?>
            <input type="hidden" name="emp[]" value="<?php echo($rows['email']); ?>"/></td>
          <td ><?php  echo($rows['name']); ?>
          <td ><?php  echo($rows['user_group']);  ?></td>
          <td align="center"><input type="radio"  <?php echo ($rows['allow_shuffling']=="Yes") ? 'checked' : '' ?>  id="present"  value="Yes" name="status[<?php echo $i; ?>]" title="<?php  echo($rows[1]); ?>" /></td>
          <td align="center"><input type="radio" <?php echo ($rows['allow_shuffling']=="No") ? 'checked' : '' ?>  value="No" title="<?php  echo($rows[1]); ?>" name="status[<?php echo $i; ?>]"  ></td>
        </tr>
        <?php $i++;} ?>
      </table>
      <input type="hidden" name="i" value="<?php echo($i); ?>"/>
      <center>
        <input type="submit" required name="submit"  value="Next" class="btn-sm btn-lg form-group btn-primary col-2" style="width: 280px;height: 50px;">
      </center>
    </form>
  </div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</body>
</html>