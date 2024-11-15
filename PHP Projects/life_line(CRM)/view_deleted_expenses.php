<?php
include( "config.php" );
include( "allFunctions.php" );

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
<?php
include "start.php";

$login_user = $_SESSION[ 'email' ];
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="col-lg-12">
      <?php include("expense_tabs.php"); ?>
      <?php include("fix_header.php"); ?>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Amount</th>
              <th>Payment Type</th>
              <th>Category</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php

            if ( isset( $_REQUEST[ 'cat' ] ) ) {
              $cat = $_REQUEST[ 'cat' ];
              $sqlview = "SELECT * FROM `expenses` where deleted =1 and expense_category='$cat'";
            } else {

              $sqlview = "SELECT * FROM `expenses` where deleted =1";
            }


            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            
							<tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[2]; ?></td>
              <td><?php echo $rowview[3]; ?></td>
              <td><?php echo $rowview[4]; ?></td>
              <td><a href="edit_expense.php?id=<?php echo $rowview[0]; ?>">
                <button class="btn-sm btn-success" title="Update Expense"><i class="fa fa-pencil"></i></button>
                </a>
                <button class="btn-sm btn-info" title="Double Click To Restore" onDblClick="window.location.href='del.php?expense_id_restore=<?php echo $rowview[0]; ?>'"><i class="fa fa-history"></i></button></td>
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