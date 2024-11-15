<?php
include( "config.php" );
include( "allFunctions.php" );

?>
<!DOCTYPE html>
<?php
include "start.php";
?>
</div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="col-lg-12"> 
        <h3>System Generated Vouchers</h3>
<!--
        <a href="accounts_verify_user.php" target="new">User Unverified Transactions <span class="badge badge-success"><?php echo showQuery("SELECT count(*) FROM `m_account_detail` WHERE user_verified is null AND entered_by='$_SESSION[email]'") ?></span></a>
        <?php 
    if($_SESSION['email']=="Doctor Omar Chughtai"||$_SESSION['email']=="admin")
    {
        ?>
        <a href="accounts_verify_admin.php" target="new">Admin Unverified Transactions <span class="badge badge-danger"><?php echo showQuery("SELECT count(*) FROM `m_account_detail` WHERE user_verified !='' AND admin_verified is null") ?></span></a>
        
        <?php
    }
        
        ?>
-->
        
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
            $sqlview = "SELECT * FROM `daily_voucher` WHERE remarks LIKE '%Automated Voucher%';";
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
              <td>
                  <?php
                  preg_match('/\d+$/', $rowview[2], $matches);

// Check if there was a match and get the number
if (isset($matches[0])) {
  $lastNumber = $matches[0];
}
                  ?>
                  <a title="View Order Details" target="new" href="order_details.php?id=<?php echo $lastNumber;?>"><i class="fa fa-dropbox fa-2x"></i></a><a title="View Voucher" target="new" href="view_dailyvoucher.php?id=<?php echo $rowview[0];?>"><i class="fa fa-eye fa-2x"></i></a>
                  <a title="View Voucher" onBlur="return confirm('Do You Want To Delete?')" href="del.php?deldailyvoucher=<?php echo $rowview[0];?>"><i class="fa fa-trash fa-2x"></i></a></td>
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