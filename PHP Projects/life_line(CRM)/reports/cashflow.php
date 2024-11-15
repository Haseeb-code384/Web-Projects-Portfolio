<?php session_start();
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
    <td><h3> <b>Cash Flow Report </b><br>
        <!--					<b> (<?php echo $account_id.") "; echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id"); ?></b><br>--> 
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
<table  style="width: 100%; font-size: 9pt;" border="1">
  <tr align="center">
    <th width="">TID</th>
    <th  width="">VC#</th>
    <th  width="">Subhead</th>
    <th width="">Ledger</th>
    <th width="">Ledger Name</th>
    <th width="80">Date</th>
    <th  width="400">Description</th>
    <th  width="40">Debit</th>
    <th  width="40">Credit</th>
    <th  width="40">Balance</th>
    <th  width="40">Verify</th>
    <!--		<th  width="5%" colspan="2"> Balance</th>-->
    
  </tr>
  <?php
    $i=0;
  $sql = "SELECT tr_date,amount,type,tr_description,invno,info,user_verified,admin_verified,entered_by,m_accountid,(SELECT subhead_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE master_account.m_accountid =m_account_detail.m_accountid)) as 'subhead',sno FROM `m_account_detail` WHERE  tr_date between '$date_start' and '$date_end'";
  //	echo $sql;
  $query = mysqli_query( $con, $sql );
  $sum1 = 0;
  while ( $row = mysqli_fetch_array( $query ) ) {
    ?>
  <tr align="center" title="Entered By: <?php echo $row['entered_by']; ?>">
    <td><?php echo ($row['sno']);?><br>
      <?php
      echo ifelse( $row[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
      echo ifelse( $row[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
      ?>
      </td>
    <td>
         <a title="View Voucher" target="new" href="../view_dailyvoucher.php?id=<?php echo $row[4];?>">
     <?php echo $row[4];?>
      </a>
        </td>
    <td><?php echo $row['subhead'];?></td>
    <td><?php echo $row['m_accountid'];?></td>
    <td><?php echo showQuery("SELECT account FROM `master_account` WHERE master_account.m_accountid ='$row[m_accountid]'")?></td>
    <td><?php echo change_date_ddmmyyy($row[0]);?></td>
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
      
    <td><?php echo accumulated_bal_tr( $row['m_accountid'], $row['sno'] ); ?></td>
    <!--
			<td align="right">

<?php //echo $sum1;?></td>
			<td width="5">
			<?php
				if($sum1>0)
				{
					echo "Dr";
				}
				elseif($sum1==0)
				{
					echo "Nil";
				}
			else
			{
				echo "Cr";
			}
				?></td>
-->
    <td width="5%" style="border: none;">
     
            <?php
        
       if( $row[ 'admin_verified' ] == "")
      {
      ?>
          <i onClick="window.open('../accounts_process_admin_verification.php?<?php echo "t_id=$row[sno]&user=$_SESSION[email]" ?>', 'Update List', 'width=1,height=1'); this.classList.remove('fa-square-o');this.classList.add('fa-check-square-o'); document.getElementById('box<?php echo $i; ?>').innerHTML='<?php echo $currentDateTime; ?>'; this.style.visibility='hidden'" class="fa fa-2x fa-square-o text-primary"></i>
        <?php    
      }
        ?>
    
      </td>
  </tr>
  <?php  } ?>
  <tr>
    <th colspan="7">Totals</th>
    <th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE  tr_date between '$date_start' and '$date_end' and info='Dr'") ?></th>
    <th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE  tr_date between '$date_start' and '$date_end' and info='Cr'") ?></th>
    <th colspan="2"></th>
  </tr>
</table>
</body>
</html>