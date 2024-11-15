<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $i = 0;

   $user_choices = $_POST['user_choices'];

  foreach ($user_choices as $user_id => $selected_options) {
     executeQuery("DELETE FROM `user_disease_category` WHERE username='$user_id' ");
     foreach ($selected_options as $option) {   
    executeQuery( "INSERT INTO `user_disease_category` (`username`, `disease`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES ('$user_id', '$option', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000', '')" );
      }
 
  }
  alertredirect("Disease Selection Completed","distribute_inquiry_wizard_select_date.php");
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
            <th width="" height="23">Sn</th>
            <th width="" >Seller Username</th>
            <th width="">Seller Name</th>
            <th width="">Disease</th>
          </tr>
      
        </thead>
        <?php
        $i = 1;
        $sqls = "SELECT * FROM `user` WHERE active=1 AND is_seller='Yes' AND allow_shuffling='Yes' order by user_group";
        $querys = mysqli_query( $con, $sqls );
        while ( $rows = mysqli_fetch_array( $querys ) ) {
          ?>
        <tr class="">
          <td align="center"><?php  echo($i); ?></td>
          <td align="center" class=""><?php  echo($rows['email']); ?>
            <input type="hidden" name="emp[]" value="<?php echo($rows['email']); ?>"/></td>
          <td ><?php  echo($rows['name']); ?>
         <td>   <?php
        $sql_network = "SELECT disease_category FROM `disease_category` order by disease_category";
        $query_network = mysqli_query( $con, $sql_network );
        while ( $row_network = mysqli_fetch_array( $query_network ) ) {
            $rand_id=rand();
          ?>
        <input id="<?php echo $rand_id  ?>" title="<?php echo $row_network[0] ?>"  type="checkbox" value="<?php echo $row_network[0]; ?>" <?php echo showQuery("SELECT 'checked' FROM `user_disease_category` WHERE disease='$row_network[0]' AND username='$rows[email]'") ?> name="user_choices[<?php echo $rows['email']; ?>][]">
        <label for="<?php echo $rand_id; ?>"><?php echo $row_network[0] ?></label>
        <?php } ?></td>
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