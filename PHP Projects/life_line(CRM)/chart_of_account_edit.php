<?php

$chart_of_account_id = $_GET[ 'chart_of_account_id' ];

include( "config.php" );
include( "allFunctions.php" );

if ( isset( $_REQUEST[ 'update' ] ) ) {

  $account = $_REQUEST[ 'account' ];
  $accounttype = $_REQUEST[ 'accounttype' ];
  $remarks = $_REQUEST[ 'remarks' ];
  $address = $_REQUEST[ 'address' ];
  $contactno = $_REQUEST[ 'contactno' ];
  $crlimit = $_REQUEST[ 'crlimit' ];
  $commitee = $_REQUEST[ 'commitee' ];
  $weight_less = $_REQUEST[ 'weight_less' ];
  $rate = $_REQUEST[ 'rate' ];
  $act_code = $_REQUEST[ 'act_code' ];
  $sms = $_REQUEST[ 'sms' ];

  //$sql="UPDATE `master_account` SET `account`='$account',`accounttype`= '$accounttype',`remarks`= '$remarks', `address`= '0', `contactno`= '$contactno',`crlimit`= '0', `commitee`= '$commitee', `weight_less`= '$weight_less', `rate`= '$rate',`act_code`= '$act_code', `sms`= '$sms' WHERE m_accountid = $chart_of_account_id";

  $sql = "UPDATE `master_account` SET `account`='$account',`accounttype`= '$accounttype',`remarks`= '$remarks', `address`= '$address' , `contactno`= '$contactno',`crlimit`= '0', `commitee`= '$commitee', `weight_less`= '0', `rate`= '0',`act_code`= '$act_code', `sms`= '$sms' WHERE m_accountid = $chart_of_account_id";

  //echo $sql;
  $query = mysqli_query( $con, $sql );
  if ( $query ) {

    echo "<script>alert('Updated Successfully');
		window.location.href='chart-of-account.php';
		</script>";
  } else {

    echo "<script>alert('Something went wrong')</script>";
  }
  ?>
<script>window.location.href="chart-of-account.php";
	
	</script>
<?php
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
<?php include("preloader.php"); ?>
<?php
include "start.php";
?>
<div class="content-wrapper">
<div class="container-fluid">
<form method="post">
  <div class="row">
    <div class="border col-lg-12">
      <div class="form-group">
        <?php
        $sqlview = "SELECT * FROM `master_account` WHERE m_accountid = $chart_of_account_id";
        $query = mysqli_query( $con, $sqlview )or die ( mysqli_error( $con ) );
        $rowview = mysqli_fetch_array( $query );
        ?>
        <label>Account ID:
          <input class="form-control" type="number" name="m_accountid" disabled value="<?php echo $_REQUEST['chart_of_account_id']; ?>">
        </label>
       
        <label>Account Name:
          <input class="form-control" style="width: 400px;" type="text" name="account" value="<?php echo $rowview['account']?>" >
        </label>
        <label >Account Type:
          <select class="form-control" required name="accounttype">
            <?php

            populateDDsel( "account_subhead", "subhead_name", "id", $rowview[ 'accounttype' ] )
            ?>
          </select>
        </label>
        <label >Contact Number:
          <input class="form-control" type="text" name="contactno" value="<?php echo $rowview['contactno'];?>">
        </label>
        <label>Remarks:
          <input class="form-control" type="text" name="remarks" value="<?php echo $rowview['remarks'];?>">
        </label>
        <label >Credit Limit
          <input class="form-control" type="number" name="crlimit" value="<?php echo $rowview['crlimit'];?>">
        </label>
        
        <input type="submit" name="update" class="btn btn-primary" value="Update values">
    </div>
    </div>
  </div>
  </div>
</form>
<br>
<br>
<br>
</body>
</html>