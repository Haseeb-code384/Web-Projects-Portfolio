<?php
include( "config.php" );
include( "allFunctions.php" );

if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $m_accountid = $_REQUEST[ 'm_accountid' ];
  $account = strtoupper( $_REQUEST[ 'account' ] );
  $accounttype = $_REQUEST[ 'accounttype' ];
  $remarks = $_REQUEST[ 'remarks' ];
  $address = "";
  $contactno = $_REQUEST[ 'contactno' ];
  $crlimit = $_REQUEST[ 'crlimit' ];
  $netbalance = 0;
  $acct_no = 0;
  $selbal = 0;
  $commitee = 0;
  $weight_less = 0;
  $rate = 0;
  $act_code = 0;
  $sms = 0;
    $usernames=$_REQUEST['username'];

  $sql = "INSERT INTO `master_account` (`m_accountid`, `account`, `accounttype`, `remarks`, `address`, `contactno`, `crlimit`, `netbalance`, `acct_no`, `selbal`, `commitee`, `weight_less`, `rate`, `act_code`, `sms`, `trial170`) VALUES (NULL, '$account', '$accounttype', '$remarks', '$address', '$contactno', '$crlimit', '0', NULL, '$selbal', '$commitee', '$weight_less', '$rate', '$act_code', '$sms', NULL)";
  $query = mysqli_query( $con, $sql );
    foreach($usernames as $username)
    {
        executeQuery("INSERT INTO `m_account_permission` (`account_id`, `username`, `timestamp`) VALUES ('$m_accountid', '$username', '$currentDateTime')");
    }
  if ( $query ) {
    alertredirect( "Data Inserted Successfully", "chart-of-account.php" );
  } else {
    alertredirect( "Something Went Wrong!!!", "chart-of-account.php" );
  }

}

?>

<!DOCTYPE html>

<?php include("preloader.php"); ?>
<?php
include "start.php";
?>
<div class="content-wrapper">
  <div class="container-fluid">
  <form method="post">
      <?php breadcrumb(); ?>
    <div class="col-sm-12">
    
      <div class="row">
        <div class="col-sm-1">
          <label>ID:</label>
          <input class="form-control " type="number" name="m_accountid" value="<?php echo getNextId("m_accountid","master_account"); ?>">
        </div>
        <div class="col-sm-2">
          <label>Account Name: </label>
          <input class="form-control" type="text" name="account">
        </div>
        <div class="col-sm-2">
          <label>Account Type: </label>
          <select class="form-control" required name="accounttype">
            <option value="">Select Type</option>
            <?php populateDD("account_subhead","subhead_name","id") ?>
          </select>
        </div>
        <div class="col-sm-2">
          <label>Contact number: </label>
          <input class="form-control" type="text" name="contactno" value="">
        </div>
        <div class="col-sm-2">
          <label>Remarks: </label>
          <input class="form-control" type="text" name="remarks" value="">
        </div>
        <div class="col-sm-1">
          <label>Cr Limit</label>
          <input class="form-control" type="number" name="crlimit" placeholder="Enter Credit Limit">
        </div>  
            <div class="col-sm-2">
         <?php 
                include("admin_selective_multi_user_dropdown.php");
                ?>
        </div>
        <div class="col-sm-2">
          <input type="submit" name="submit" class="btn btn-primary">
          <input type="reset" class="btn btn-secondary" value="Clear All">
        </div>
      </div>
      </div>
    
  </form>
  <?php include("fix_header.php"); ?>
        <tr>
          <th>Account_ID</th>
          <th>Account Name</th>
          <th>Account Type</th>
          <th>Contact#</th>
          <th>Remarks</th>
          <th>Credit</th>
          <th>Balance</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include("chart_of_accounts_types.php");
              if(isset($_REQUEST['account_type']))
{
        $account_type=$_REQUEST['account_type'];
   
          if(check_admin($_SESSION['email']))
          {
              
        $sqlview = "SELECT * FROM `master_account`  WHERE accounttype='$account_type'  ORDER BY `master_account`.`m_accountid`  DESC";
          }
          else
          {
              
        $sqlview = "SELECT * FROM `master_account`  WHERE accounttype='$account_type'  AND m_accountid IN (SELECT DISTINCT account_id FROM `m_account_permission`  WHERE username='$_SESSION[email]')";
          }
                  
}
else
{
    if(check_admin($_SESSION['email']))
          {
              
        $sqlview = "SELECT * FROM `master_account`   ORDER BY `master_account`.`m_accountid`  DESC";
          }
    else
    {
           $sqlview = "SELECT * FROM `master_account` WHERE  m_accountid IN (SELECT DISTINCT account_id FROM `m_account_permission`  WHERE username='$_SESSION[email]') ORDER BY `master_account`.`m_accountid`  DESC";
    }
   
}
//echo $sqlview;
        $queryview = mysqli_query( $con, $sqlview );
        while ( $rowview = mysqli_fetch_array( $queryview ) ) {
          ?>
        <tr>
          <td><?php echo $rowview[0]; ?></td>
          <td><?php echo $rowview[1]; ?></td>
          <td><?php
          echo showQuery( "SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[2]'" );
          ?></td>
          
          <!--
								<td><?php //echo $rowview[7]; ?></td>
								<td><?php echo showQuery("SELECT areaname FROM `arealist` WHERE areaid='$rowview[4]'") ; ?></td>
-->
          
          <td><?php echo $rowview[5]; ?></td>
          <td><?php echo $rowview[3]; ?></td>
          <td><?php echo $rowview['crlimit']; ?></td>
          <td><?php echo getNonNegativeValue(accumulated_bal($rowview[0],$date)); ?></td>
          <td>
              		<button class="btn-sm btn-info btn-sm" onClick="window.open('accounts_permissions_checkbox.php?user_edit_id=<?php echo $rowview[0];?>','height=100',width=100);" >Permissions</button>
              <a href="chart_of_account_edit.php?chart_of_account_id=<?php echo $rowview[0]; ?>" class="btn-sm btn-success">Edit</a>
            <button title="Double Click To Delete" onDblClick="window.location.href='chart_of_account_delete.php?chart_of_account_id=<?php echo $rowview[0]; ?>'" class="btn-sm btn-danger">Delete</button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<br>
<br>
<br>
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
</body>
</html>