<?php
include( "../config.php" );
include( "../allFunctions.php" );
$crdr = $_REQUEST[ 'crdr' ];
$date_start = $_REQUEST[ 'date_start' ];
$date_end = $_REQUEST[ 'date_end' ];
$account_id = $_REQUEST[ 'account_id' ];
//$account_head = $_REQUEST['account_head'];
//$area_id = $_REQUEST['area_id'];

?>
<!DOCTYPE html>
<html>
<head>
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<title></title>
<style>
thead {
    position: sticky;
    top: 0;
}
</style>
<style type="text/css">
.special_column th {
    font-family: Jameel Noori Nastaleeq Regular;
    font-weight: bolder;
    font-size: 150%;
}
.vl {
    border-left: 3px solid red;
    height: 40px;
}
.special_border {
    height: 35px;
}
.class_bold td {
    text-align: right;
    width: 60%;
    margin-left: 34%;
}
tr td span {
    column-span: all;
}
</style>
</head>
<body>
<table style="margin-left: 10%;">
<tbody>
  <tr>
    <td><h3> <b>Ledger Report </b><br>
        <b> (<?php echo $account_id.") "; echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id"); ?></b><br>
      </h3></td>
    </td>
    <td></td>
    <td><?php include ('logo.php');?>
<br>
</td>
<td></td>
</tr>
<tr>
  <td><strong>FROM :</strong><?php echo change_date_ddmmyyy($date_start); ?></td>
  <td></td>
  <td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;">.</td>
  <td></td>
  <td><strong>To :</strong><?php echo change_date_ddmmyyy($date_end); ?></td>
</tr>
<tr>
  <td><hr style="width: 450%; border: 1px solid black"></td>
</tr>
<tr>
  <td></td>
</tr>
</table>
<table  style="margin-left: 10%; width: 85%;" border="1">
  <thead style="background-color: black; color: white;">
    <tr align="center">
      <th width="20">#</th>
      <th width="100">Date</th>
      <th  width="40">VC#</th>
      <th  width="40">Type</th>
      <th width="40">#</th>
      <th  width="500">Description</th>
      <th  width="40">Debit</th>
      <th  width="40">Credit</th>
      <th  width="5%" colspan="2">Balance</th>
    </tr>
    <tr>
      <th colspan="6"></th>
      <th colspan="2">Previous Balance</th>
      <th><?php
      $accumulated_bal = accumulated_bal( $account_id, $date_start );
      echo abs( $accumulated_bal );
      ?></th>
      <td><?php
      if ( $accumulated_bal > 0 ) {
        echo "Dr";
      } elseif ( $accumulated_bal == 0 ) {
        echo "Nil";
      }
      else {
        echo "Cr";
      }
      ?></td>
    </tr>
  </thead>
  <?php
  $sql = "SELECT tr_date,amount,type,tr_description,invno,info,user_verified,admin_verified,entered_by,sno FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' order by tr_date ASC";

  $query = mysqli_query( $con, $sql );
  $sum1 = 0;
  $i = 1;
  while ( $row = mysqli_fetch_array( $query ) ) {
    ?>
  <tr align="center" title="Entered By: <?php echo $row['entered_by']; ?> TID: <?php echo $row['sno']; ?>">
    <td><?php echo $i++; ?></td>
    <td><?php echo change_date_ddmmyyy($row[0]);?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo showQuery ( "SELECT type FROM `daily_voucher` WHERE id='$row[4]'" );
    echo ifelse( $row[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
    echo ifelse( $row[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
    ?></td>
    <td><?php echo $row[2];?></td>
    <td><?php echo ucwords($row[3]);?></td>
    <?php
    if ( $row[ 5 ] == 'Dr' ) {
      ?>
    <td><?php  $sum1=$sum1+$row[1]; echo $row[1]?></td>
    <td></td>
    <?php
    } else {
      ?>
    <td></td>
    <td><?php $sum1=$sum1-$row[1]; echo $row[1]?></td>
    <?php } ?>
    <td align="center"><?php echo abs($sum1);?></td>
    <td width="5"><?php
    if ( $sum1 > 0 ) {
      echo "Dr";
    } elseif ( $sum1 == 0 ) {
      echo "Nil";
    }
    else {
      echo "Cr";
    }
    ?></td>
    <td width="5%" style="border: none;"><button>
      <a title="View Voucher" target="new" href="../view_dailyvoucher.php?id=<?php echo $row[4];?>">>>
      </button>
      </a></td>
  </tr>
  <?php  } ?>
  <tr>
    <th colspan="6">Totals</th>
    <th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' and info='Dr'") ?></th>
    <th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' and info='Cr'") ?></th>
    <th colspan="2"></th>
  </tr>
</table>
</body>
</html>