<?php

include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $company_account_name = strtoupper( $_REQUEST[ 'company_account_name' ] );
  $active = $_REQUEST[ 'active' ];
  $company_dispatch_ledger = $_REQUEST[ 'company_dispatch_ledger' ];
  $default_cash_handler_ledger = $_REQUEST[ 'default_cash_handler_ledger' ];
  $company_receiving_ledger = $_REQUEST[ 'company_receiving_ledger' ];
  $cash_receiving_ledger = $_REQUEST[ 'cash_receiving_ledger' ];
  $payment_clearance_ledger = $_REQUEST[ 'payment_clearance_ledger' ];
  $category = strtoupper( $_REQUEST[ 'category' ] );
  $sql = "INSERT INTO `courier_company` (`company_account_name`, `active`,`company_dispatch_ledger`,`default_cash_handler_ledger`,`company_receiving_ledger`,`cash_receiving_ledger`,`payment_clearance_ledger`) VALUES ('$company_account_name', '1','$company_dispatch_ledger','$default_cash_handler_ledger','$company_receiving_ledger','$cash_receiving_ledger','$payment_clearance_ledger')";
  $query = mysqli_query( $con, $sql );
  if ( $query ) {

    alertredirect( "Account Added Successfully", "manage_courier_company.php" );
  } else {

    alertredirect( "Something Went Wrong!!!!", "manage_courier_company.php" );
  }
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
<body>
<?php include("start.php"); ?>
<div class="content-wrapper">
<div class="container-fluid">
<div class="row" style="">
<?php breadcrumb(); ?>
<form>
<div class="col-sm-12">
<div class="row">
<div class="col-sm-3">
  <label class="text-danger"><strong>Company Account:</strong></label>
  <input class="form-control" placeholder="Enter Account (TCS, LEOPARDS, etc)" type="text" name="company_account_name" required>
</div>
<div class="col-sm-3">
<label class=""><strong>Stock Disptatch Debit A/C:</strong></label>
<select class="form-control" name="company_dispatch_ledger">
<?php include("optgroup_element.php"); ?>
</select>
</div>
<div class="col-sm-3">
  <label class=""><strong>Dispatch Expense Handler:</strong></label>
  <select class="form-control" name="default_cash_handler_ledger" >
    <?php include("optgroup_element.php"); ?>
  </select>
</div>
<div class="col-sm-3">
  <label class=""><strong>Receiving Credit A/C:</strong></label>
  <select class="form-control" name="company_receiving_ledger">
    <?php include("optgroup_element.php"); ?>
  </select>
</div>
    <div class="col-sm-3">
  <label class=""><strong>Receiving Amount Handler:</strong></label>
  <select class="form-control" name="cash_receiving_ledger">
    <?php include("optgroup_element.php"); ?>
  </select>
</div> 
    <div class="col-sm-3">
  <label class=""><strong>Payment Clearance Ledger:</strong></label>
  <select class="form-control" name="payment_clearance_ledger">
    <?php include("optgroup_element.php"); ?>
  </select>
</div>
<div class="col-1">
  <label class=""><strong>Active:</strong></label>
  <select name="active" class="form-select">
    <option value="1" selected>Yes</option>
    <option value="0">No</option>
  </select>
</div>
<div class="col-1">
  <label class=""><strong></strong></label>
  <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-primary col-12">
</div>
</div>
</div>
</div>
</form>
<?php //include("symptoms_tabs.php"); ?>
<div class="col-lg-12">
  <?php include("fix_header.php"); ?>
        <tr>
          <th>Company Account</th>
          <th>Active</th>
          <th>Stock Disptatch Debit A/C</th>
          <th>Dispatch Expense Handler</th>
          <th>Receiving Credit A/C</th>
          <th>Receiving Amount Handler</th>
          <th>Payment Clearance Ledger</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ( isset( $_REQUEST[ 'cat' ] ) ) {
          $cat = $_REQUEST[ 'cat' ];
          $sqlview = "SELECT * FROM `symptoms`WHERE category='$cat'  order by sort ASC ,symptom_name ASC";
        } else {

          $sqlview = "SELECT * FROM `courier_company` ";
        }

        $queryview = mysqli_query( $con, $sqlview );
        while ( $rowview = mysqli_fetch_array( $queryview ) ) {
          ?>
        <tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
          <td><?php echo $rowview[0]; ?></td>
          <td><?php echo showbool($rowview[1]); ?></td>
          <td><?php  echo get_ledger_name_by_id($rowview[2]); ?></td>
          <td><?php  echo get_ledger_name_by_id($rowview[3]); ?></td>
          <td><?php  echo get_ledger_name_by_id($rowview[4]); ?></td>
          <td><?php  echo get_ledger_name_by_id($rowview[5]); ?></td>
          <td><?php  echo get_ledger_name_by_id($rowview[6]); ?></td>
          <td><a href="courier_list_edit.php?name=<?php echo $rowview[0]; ?>">
            <button class="btn-sm btn-success">Edit</button>
            </a><a onClick="return confirm('Do You Want To Delete Permanently?');" href="del.php?courier_account=<?php echo $rowview[0]; ?>">
            <button class="btn-sm btn-danger">Delete</button>
            </a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
<br>
<br>
<br>
</body>
<script src="vendor/jquery/jquery.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</html>