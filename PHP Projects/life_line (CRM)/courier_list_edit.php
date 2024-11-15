<?php
include( "config.php" );
include( "allFunctions.php" );

$name = $_REQUEST[ 'name' ];
$sqlview = "SELECT * FROM `courier_company` WHERE company_account_name='$name'";
$queryview = mysqli_query( $con, $sqlview );
$rowview = mysqli_fetch_array( $queryview );

if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $company_account_name = strtoupper( $_REQUEST[ 'company_account_name' ] );

  $active = $_REQUEST[ 'active' ];

  $company_dispatch_ledger = $_REQUEST[ 'company_dispatch_ledger' ];
  $default_cash_handler_ledger = $_REQUEST[ 'default_cash_handler_ledger' ];
  $company_receiving_ledger = $_REQUEST[ 'company_receiving_ledger' ];
  $cash_receiving_ledger = $_REQUEST[ 'cash_receiving_ledger' ];
  $payment_clearance_ledger = $_REQUEST[ 'payment_clearance_ledger' ];

  $old_name = $_REQUEST[ 'old_name' ];

  $sql = "UPDATE `courier_company` SET `company_account_name` = '$company_account_name', `active` = '$active',`company_dispatch_ledger`='$company_dispatch_ledger',`default_cash_handler_ledger`='$default_cash_handler_ledger',`company_receiving_ledger`='$company_receiving_ledger',`cash_receiving_ledger`='$cash_receiving_ledger',`payment_clearance_ledger` = '$payment_clearance_ledger' WHERE `courier_company`.`company_account_name` = '$old_name'";
  //	echo $sql;
  $query = mysqli_query( $con, $sql );
  header( "Location: manage_courier_company.php" );
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
    <form>
      <input type="hidden" value="<?php echo $rowview[0]; ?>" name="old_name">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-3">
            <label class="text-danger"><strong>Company Account:</strong></label>
            <input class="form-control input-lg" value="<?php echo $rowview[0]; ?>" placeholder="Enter Account (TCS, LEOPARDS, etc)" type="text" name="company_account_name" required>
          </div>
          <div class="col-sm-3">
            <label class=""><strong>Stock Disptatch Debit A/C:</strong></label>
            <select class="form-control"  name="company_dispatch_ledger">
              <?php
              $selected_account = $rowview[ 'company_dispatch_ledger' ];
              include( "optgroup_element.php" );
              ?>
            </select>
          </div>
          <div class="col-sm-3">
            <label class=""><strong>Dispatch Expense Handler</strong></label>
            <select class="form-control" name="default_cash_handler_ledger" >
              <?php

              $selected_account = $rowview[ 'default_cash_handler_ledger' ];
              include( "optgroup_element.php" );
              ?>
            </select>
          </div>
          <div class="col-sm-3">
            <label class=""><strong>Receiving Credit A/C:</strong></label>
            <select class="form-control" required name="company_receiving_ledger">
              <?php

              $selected_account = $rowview[ 'company_receiving_ledger' ];
              include( "optgroup_element.php" );
              ?>
            </select>
          </div>   
        
          <div class="col-sm-3">
            <label class=""><strong>Receiving Amount Handler:</strong></label>
            <select class="form-control" name="cash_receiving_ledger">
              <?php

              $selected_account = $rowview[ 'cash_receiving_ledger' ];
              include( "optgroup_element.php" );
              ?>
            </select>
          </div>
                <div class="col-sm-3">
            <label class=""><strong>Payment Clearance Ledger:</strong></label>
            <select class="form-control" required name="payment_clearance_ledger">
              <?php

              $selected_account = $rowview[ 'payment_clearance_ledger' ];
              include( "optgroup_element.php" );
              ?>
            </select>
          </div>
          <div class="col-1">
            <label class=""><strong>Active:</strong></label>
            <select name="active" class="form-select">
<!--              <option value="<?php echo $rowview[0]; ?>" selected><?php echo showbool($rowview[1]); ?></option>-->
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="col-1">
            <label class=""><strong></strong></label>
            <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-primary col-12">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<br>
<br>
<br>
</body>
</html>