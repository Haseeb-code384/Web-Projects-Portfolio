<?php
include( "config.php" );
include( "allFunctions.php" );
$start_date = $date;
$end_date = $date;
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $end_date = $_REQUEST[ 'end_date' ];
}
?>
<!DOCTYPE html>
<?php
include "start.php";
?>
</div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="col-sm-12"> 
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
  
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
           
       <?php
  $sum_head = 0;
  $sql_head = "SELECT * FROM `account_head` order by sort desc";
  $query_head = mysqli_query( $con, $sql_head );
  while ( $row_head = mysqli_fetch_array( $query_head ) ) {

    ?>
        
        <li class="nav-item">
        <a href="accounts_verify_user.php<?php echo "?user=$_SESSION[email]&head_name=$row_head[0]"; ?>" target="new" class="nav-link text-success" >User Unverified Transactions - <?php echo $row_head[0]; ?>  <span class="badge badge-success"><?php echo showQuery("SELECT count(*) FROM `m_account_detail` WHERE user_verified is null AND entered_by='$_SESSION[email]' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$row_head[0]'))") ?></span></a>
      </li>
        
        
        <?php }
    
        
        ?>
        
        
      <li class="nav-item">
        <a href="dailyvouchers_list_automated.php" target="new" class="nav-link text-info" >System Generated Vouchers </a>
      </li>
        
 
        
            <?php 
    if($_SESSION['email']=="Doctor Omar Chughtai"||$_SESSION['email']=="admin")
    { ?>
       <?php
  $sum_head = 0;
  $sql_head = "SELECT * FROM `account_head` order by sort desc";
  $query_head = mysqli_query( $con, $sql_head );
  while ( $row_head = mysqli_fetch_array( $query_head ) ) {

    ?>
        
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-danger" href="#" id="navbarDropdown<?php echo $row_head[1]; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          CEO Unverified Transactions <strong>(<?php echo $row_head[0]; ?>)</strong> <span class="badge badge-danger"><?php echo showQuery("SELECT count(*) FROM `m_account_detail` WHERE user_verified !='' AND admin_verified is null AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$row_head[0]')) ") ?></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown<?php echo $row_head[1]; ?>">
         <?php
        $sql_users="SELECT DISTINCT entered_by FROM `m_account_detail` WHERE m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$row_head[0]'))";
        $query_users=mysqli_query($con,$sql_users);
        while($row_users=mysqli_fetch_array($query_users))
        {
        ?>
                 <a class="dropdown-item"  href="<?php echo "accounts_verify_admin.php?user=$row_users[0]&head_name=$row_head[0]" ;?>" target="new"> <?php echo $row_users[0]." "; ?> <span class="badge badge-danger" style="float: right;"><?php echo showQuery("SELECT count(*) FROM `m_account_detail` WHERE user_verified !='' AND admin_verified is null AND entered_by='$row_users[0]' AND m_accountid IN(SELECT m_accountid FROM `master_account` WHERE accounttype IN (SELECT id FROM `account_subhead` WHERE head_name='$row_head[0]')) ") ?></span> </a>
          <?php
    }
        
        ?>
        </div>
      </li>
        
        
        <?php }
    } 
        
        ?>
    </ul>
  
  </div>
</nav>
        
   
   
        
      
  
        <form>
            <div class="row">
            <div class="col-sm-5">
                <label class="col-form-label">Start Date</label>
              <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
            </div> <div class="col-sm-5">
                <label>End Date</label>
              <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
            </div>
                <div class="col-sm-2">
                   <br>
                <input type="submit" name="submit" class="btn btn-primary" value="Filter">
                </div>
            </div>
      
        </form>
      <?php include("fix_header.php"); ?>
          <th>Voucher #</th>
            <th>Date</th>
            <th>Remarks</th>
            <th>Type</th>
            <th>Total Cr</th>
            <th>Total Dr</th>
            <th>Action</th>
          </tr>
          </thead>
          
          <tbody>
            <?php
              $sqlview = "SELECT * FROM `daily_voucher` WHERE id IN(SELECT invno FROM `m_account_detail` WHERE entered_by='$_SESSION[email]'  ) AND date BETWEEN '$start_date' AND '$end_date'";
//            echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo change_date_ddmmyyy( $rowview[1]); ?></td>
              <td><?php echo ucwords($rowview[2]); ?></td>
              <td><?php echo $rowview[3]; ?></td>
              <td><?php echo showQuery("SELECT SUM(amount) FROM `m_account_detail` WHERE info='Cr' AND invno='$rowview[0]'"); ?></td>
              <td><?php echo showQuery("SELECT SUM(amount) FROM `m_account_detail` WHERE info='Dr' AND invno='$rowview[0]'"); ?></td>
              <td><a title="View Voucher" target="new" href="view_dailyvoucher.php?id=<?php echo $rowview[0];?>"><i class="fa fa-eye fa-2x"></i></a> <a title="View Voucher" onBlur="return confirm('Do You Want To Delete?')" href="del.php?deldailyvoucher=<?php echo $rowview[0];?>"><i class="fa fa-trash fa-2x"></i></a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>
</body></html>