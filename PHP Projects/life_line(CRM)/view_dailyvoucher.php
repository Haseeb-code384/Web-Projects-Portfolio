<?php
session_start();
include( 'config.php' );
include( 'allFunctions.php' );
$id = $_REQUEST[ 'id' ];
$sqlv = "SELECT * FROM `daily_voucher` WHERE id='$id'";
$queryv = mysqli_query( $con, $sqlv );
$rowv = mysqli_fetch_array( $queryv );
$login_user = $_SESSION[ 'email' ];
$invoice_no = $rowv[ 'id' ];
$tdate = $rowv[ 'date' ];
$remarks = $rowv[ 'remarks' ];
$type = $rowv[ 'type' ];
$total_dr_amount = $rowv[ 'total_cr_amount' ];
$total_cr_amount = $rowv[ 'total_cr_amount' ];

?>

<!doctype html>
<html>
<head>
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="jquery-1.7.1.min.js"></script> 
<script src="printThis.js"></script> 
<script language="javascript">
	function print_page(){
		$('#print_this').printThis({loadCSS:'print.css',printContainer:false});
		return false;
	}
</script>
<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<body>
<div align="center"> <a  href="" onClick="return print_page()">
  <button >Print</button>
  </a> <a href="dailyvoucher.php">
  <button>New Voucher</button>
  </a> <a href="index.php">
  <button>Home</button>
  </a> </div>
<div id="print_this">
  <table border="1" style="width: 100%">
    <tr>
      <center>
        <img src="img/mp_logo1.png" height="150px;">
          <h3>Accounts Voucher</h3>
      </center>
      <th colspan="5" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
    </tr>
    <tr >
      <th  style="border: none;">Voucher# <?php echo $invoice_no; ?></th>
      <th  style="border: none;" colspan="">Type: <?php echo $type; ?></th>
      <th  style="border: none;" colspan="">Date: <?php echo change_date_ddmmyyy($tdate); ?></th>
      <th  style="border: none;" colspan="2">Remarks: <?php echo $remarks; ?></th>
    </tr>
  </table>
  <div style="display: inline;"> ِ
    <table width="50%" border="1" style="position: absolute; float: left; margin-top: -18px">
      <tr>
        <th colspan="4"> Out Side Debit (بنام) </th>
      </tr>
      <tr  style="background-color: black; color: white;">
        <th>TID</th>
        <th>Account</th>
        <th>Description</th>
        <th>Dr <br> Amount</th>
      </tr>
      <?php
      $sqld = "SELECT * FROM `m_account_detail` WHERE info='Dr' AND invno='$id' ORDER BY `m_account_detail`.`tr_description` ASC";
      $queryd = mysqli_query( $con, $sqld );

      $i = 0;
      while ( $rowd = mysqli_fetch_array( $queryd ) ) {

        ?>
      <tr title="Entered By: <?php echo $rowd['entered_by']; ?>" height="80px;">
        <th><?php echo $rowd[0]; ?></th>
        <th><?php echo showQuery ( "SELECT concat('(',m_accountid,') ',account) FROM `master_account` WHERE m_accountid='$rowd[1]'" );
        echo ifelse( $rowd[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
        echo ifelse( $rowd[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
        ?></th>
        <th><?php echo ucwords( $rowd[5]); ?></th>
        <th style="background-color: lightgray;"><?php echo $rowd[3]; ?></th>
      </tr>
      <?php

      }
      ?>
      <tr style="background-color: pink;" align="center">
        <th colspan="3">Total Dr</th>
        <th><strong><?php echo showQuery("SELECT SUM(amount) FROM `m_account_detail` WHERE info='Dr' AND invno='$id'"); ?></strong></th>
      </tr>
    </table>
    ِ
    <table width="49.5%" border="1" style="float: right; margin-top: auto;">
      <tr>
        <th colspan="5"> In Side Credit (جمع) </th>
      </tr>
      <tr  style="background-color: black; color: white;">
        <th>TID</th>
        <th>Account</th>
        <th>Description</th>
        <th>Cr Amount</th>
      </tr>
      <?php
      $sqlc = "SELECT * FROM `m_account_detail` WHERE info='Cr' AND invno='$id' ORDER BY `m_account_detail`.`tr_description` ASC";
      $queryc = mysqli_query( $con, $sqlc );

      $i = 0;
      while ( $rowc = mysqli_fetch_array( $queryc ) ) {

        ?>
      <tr title="Entered By: <?php echo $rowc['entered_by']; ?>" height="80px;">
        <th><?php echo $rowc[0]; ?></th>
        <th><?php echo showQuery ( "SELECT concat('(',m_accountid,') ',account) FROM `master_account` WHERE m_accountid='$rowc[1]'" );
        echo ifelse( $rowc[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
        echo ifelse( $rowc[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
        ?></th>
          
        <th><?php echo ucwords($rowc[5]); ?></th>
        <th style="background-color: lightgray;"><?php echo $rowc[3]; ?></th>
      </tr>
      <?php

      }
      ?>
      <tr style="background-color: pink;" align="center">
        <th colspan="3">Total Cr</th>
        <th><strong><?php echo showQuery("SELECT SUM(amount) FROM `m_account_detail` WHERE info='Cr' AND invno='$id'"); ?></strong></th>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
