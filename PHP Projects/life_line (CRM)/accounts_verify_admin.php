<?php
include( "config.php" );
include( "allFunctions.php" );
$user=$_REQUEST['user'];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="referrer" content="no-referrer" />
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>
<?php include("preloader.php"); ?>
<?php
include "start.php";
$sql = "SELECT * FROM `m_account_detail` WHERE  user_verified !='' AND admin_verified is null AND entered_by='$user'";
mysqli_set_charset( $con, "utf8mb4" );
$queryview = mysqli_query( $con, $sql );
$rowview = mysqli_fetch_array( $queryview );
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="border col-lg-12 text-center"> </div>
    <?php //breadcrumb(); ?>
    <div class="row" style="">
      <h5 align="center">Admin Verify Transactions</h5>
        <div class="row">
        <div class="col-sm-6">
            <h5>Head Name: <?php echo $_REQUEST['head_name']; ?></h5>
            </div><div class="col-sm-6">
            <h5>User: <?php echo $_REQUEST['user']; ?></h5>
            </div>
        </div>
      <body>
   
        <input type="hidden" name="id" value="<?php echo $rowview[0]; ?>">
        <input type="hidden" name="old_status" value="<?php echo $rowview['status']; ?>">
        <center>
              <?php include("fix_header.php"); ?>
              <tr align="center" class="table-danger">
                <th>T-ID</th>
                <th>Voucher#</th>
                <th>Subhead</th>
                <th>Account ID</th>
                <th>Account Name</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Type</th>
                <th>Balance</th>
                <th>Approve</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $sql_checklist = "SELECT *,(SELECT account FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid) AS 'account_name',(SELECT subhead_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'subhead',(SELECT head_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'head_name'  FROM `m_account_detail` WHERE  user_verified !='' AND admin_verified is null AND entered_by='$user' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$_REQUEST[head_name]'))  order by tr_date DESC,tr_description";
              $query_checklist = mysqli_query( $con, $sql_checklist );
              $i = 0;
                $sum1=0;
              while ( $row_checklist = mysqli_fetch_array( $query_checklist ) ) {
                // $arr=return_resultarray("SELECT * FROM `order_steps_checklist_data` WHERE order_id='$id' AND status_name='$row_checklist[0]'");
                $arr = return_resultarray( "SELECT *,(SELECT account FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid) AS 'account_name',(SELECT subhead_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'subhead',(SELECT head_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'head_name'  FROM `m_account_detail` WHERE  user_verified !='' AND admin_verified is null AND entered_by='$user' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$_REQUEST[head_name]'))  ORDER BY tr_date DESC,tr_description" );
                //                if ( $arr != "" ) {
                if ( false ) {
                  ?>
              <tr>
                <td><?php echo $row_checklist[0]; ?></td>
                <td><a href="view_dailyvoucher.php?id=<?php echo $row_checklist['invno']; ?>" target="new">Voucher# <?php echo $row_checklist['invno']; ?></a></td>
                <td><?php echo $row_checklist['head_name']; ?></td>
                <td><?php echo $row_checklist['subhead']; ?></td>
                <td><?php echo $row_checklist['m_accountid']; ?></td>
                <td><?php echo $row_checklist['account_name']; ?></td>
                <td><?php echo change_date_ddmmyyy( $row_checklist['tr_date']); ?></td>
                <td><?php echo $row_checklist['amount']; ?></td>
                <td><?php echo ucwords($row_checklist['tr_description']); ?></td>
                <td><?php echo $row_checklist['info']; ?></td>
                <td><?php echo $row_checklist['entered_by']; ?></td>
                <th align="center"> <i class="fa fa-2x fa-check-square-o text-primary"></i> </td>
                <td><?php echo $arr['edited_at'] ?></td>
              </tr>
              <?php
              } else {
                ?>
              <tr>
                <td><?php echo $row_checklist[0]; ?></td>
                <td><a title="Click To View Voucher" href="view_dailyvoucher.php?id=<?php echo $row_checklist['invno']; ?>" target="new"><?php echo $row_checklist['invno']; ?></a></td>
<!--                <td><?php echo $row_checklist['head_name']; ?></td>-->
                <td><?php echo $row_checklist['subhead']; ?></td>
                <td><?php echo $row_checklist['m_accountid']; ?></td>
                <td><?php echo $row_checklist['account_name']; ?></td>
                <td><?php echo change_date_ddmmyyy( $row_checklist['tr_date']); ?></td>
                <td><?php echo $row_checklist['amount']; ?></td>
                <td><?php echo ucwords($row_checklist['tr_description']); ?></td>
                <td><?php echo $row_checklist['info']; ?></td>
<!--                <td style="font-size: 10pt;"><?php //echo  abs(accumulated_bal_tr($row_checklist['m_accountid'],$row_checklist[0])); ?></td>-->
                <td style="font-size: 10pt;">   <?php ($row_checklist['info']=="Dr") ? $sum1=$sum1+$row_checklist['amount'] : $sum1=$sum1-$row_checklist['amount']; echo abs($sum1); ?>
                  </td>
                <td align="center"> <i onClick="window.open('accounts_process_admin_verification.php?<?php echo "t_id=$row_checklist[0]&user=$_SESSION[email]" ?>', 'Update List', 'width=1,height=1'); this.classList.remove('fa-square-o');this.classList.add('fa-check-square-o'); document.getElementById('box<?php echo $i; ?>').innerHTML='<?php echo $currentDateTime; ?>'" class="fa fa-2x fa-square-o text-primary"></i> </td>
                <th id="box<?php echo $i; $i++;  ?>"> <!--              <a href="https://api.whatsapp.com/send/?phone=923006029757&text=<?php echo $urdu; ?>&type=phone_number&app_absent=0" target="new">ok</a> --> </td>
              </tr>
              <?php
              }
              }
              ?>
            </tbody>
          </table>
        </center>
        <!--
      <table>
      
      </table>
--> 
        
      </div>
    </div>
  </div>
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
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>