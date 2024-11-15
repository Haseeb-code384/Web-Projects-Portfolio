<?php
include( "config.php" );
include( "allFunctions.php" );


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
$sql = "SELECT * FROM `m_account_detail` WHERE user_verified is null AND entered_by='$_SESSION[email]'";
mysqli_set_charset( $con, "utf8mb4" );
$queryview = mysqli_query( $con, $sql );
$rowview = mysqli_fetch_array( $queryview );
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="border col-lg-12 text-center"> </div>
    <?php breadcrumb(); ?>
    <div class="row" style="">
      <h1 align="center">Verify Transactions - <?php echo $_REQUEST['head_name']; ?></h1>
      <body>
      <div class="table-responsive">
        <input type="hidden" name="id" value="<?php echo $rowview[0]; ?>">
        <input type="hidden" name="old_status" value="<?php echo $rowview['status']; ?>">
        <center>
          <table  class="table-hover table table-bordered table-striped" width="80%">
            <thead>
              <tr align="center" class="table-danger">
                <th>T-ID</th>
                <th>Voucher#</th>
                <th>Head</th>
                <th>Subhead</th>
                <th>Account ID</th>
                <th>Account Name</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Type</th>
                <th>Entered By</th>
                <th>Approve</th>
              </tr>
            </thead>
            <tbody>
              <?php
                
              $sql_checklist= "SELECT *,(SELECT account FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid) AS 'account_name',(SELECT subhead_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'subhead',(SELECT head_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'head_name'  FROM `m_account_detail` WHERE user_verified is null AND entered_by='$_SESSION[email]' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$_REQUEST[head_name]'))  order by tr_date DESC,tr_description";
              $query_checklist = mysqli_query( $con, $sql_checklist );
              $i = 0;
              while ( $row_checklist = mysqli_fetch_array( $query_checklist ) ) {
                // $arr=return_resultarray("SELECT * FROM `order_steps_checklist_data` WHERE order_id='$id' AND status_name='$row_checklist[0]'");
                $arr=return_resultarray("SELECT *,(SELECT account FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid) AS 'account_name',(SELECT subhead_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'subhead',(SELECT head_name FROM `account_subhead` WHERE id IN(SELECT accounttype FROM `master_account` WHERE m_accountid=m_account_detail.m_accountid)) AS 'head_name'  FROM `m_account_detail` WHERE user_verified='' AND entered_by='$_SESSION[email]' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$_REQUEST[head_name]'))  order by tr_date DESC,tr_description");
                if ( $arr != "" ) {
                  ?>
              <tr>
                <th><?php echo $row_checklist[0]; ?></th>
                  
                <th><a href="view_dailyvoucher.php?id=<?php echo $row_checklist['invno']; ?>" target="new">Voucher# <?php echo $row_checklist['invno']; ?></a></th>
                <th><?php echo $row_checklist['head_name']; ?></th>
                <th><?php echo $row_checklist['subhead']; ?></th>
                <th><?php echo $row_checklist['m_accountid']; ?></th>
                <th><?php echo $row_checklist['account_name']; ?></th>
                <th><?php echo change_date_ddmmyyy( $row_checklist['tr_date']); ?></th>
                <th><?php echo $row_checklist['amount']; ?></th>
                <th><?php echo ucwords($row_checklist['tr_description']); ?></th>
                <th><?php echo $row_checklist['info']; ?></th>
                <th><?php echo $row_checklist['entered_by']; ?></th>
                <th align="center"> <i class="fa fa-2x fa-check-square-o text-primary"></i> </th>
                <th><?php echo $arr['edited_at'] ?></th>
              </tr>
              <?php
              } else {
                ?>
              <tr>
                <th><?php echo $row_checklist[0]; ?></th>
                  
                <th><a href="view_dailyvoucher.php?id=<?php echo $row_checklist['invno']; ?>" target="new">Voucher# <?php echo $row_checklist['invno']; ?></a></th>
                <th><?php echo $row_checklist['head_name']; ?></th>
                <th><?php echo $row_checklist['subhead']; ?></th>
                <th><?php echo $row_checklist['m_accountid']; ?></th>
                <th><?php echo $row_checklist['account_name']; ?></th>
                <th><?php echo change_date_ddmmyyy( $row_checklist['tr_date']); ?></th>
                <th><?php echo $row_checklist['amount']; ?></th>
                <th><?php echo ucwords($row_checklist['tr_description']); ?></th>
                <th><?php echo $row_checklist['info']; ?></th>
                <th><?php echo $row_checklist['entered_by']; ?></th>
                <th align="center"> <i onClick="window.open('accounts_process_user_verification.php?<?php echo "t_id=$row_checklist[0]&user=$_SESSION[email]" ?>', 'Update List', 'width=1,height=1'); this.classList.remove('fa-square-o');this.classList.add('fa-check-square-o'); document.getElementById('box<?php echo $i; ?>').innerHTML='<?php echo $currentDateTime; ?>'" class="fa fa-2x fa-square-o text-primary"></i> </th>
                <th id="box<?php echo $i; $i++;  ?>"> <!--              <a href="https://api.whatsapp.com/send/?phone=923006029757&text=<?php echo $urdu; ?>&type=phone_number&app_absent=0" target="new">ok</a> --> </th>
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