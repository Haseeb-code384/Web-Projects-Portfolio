<?php
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
$sql = "SELECT * FROM `order_dispatch_info` WHERE order_id='$id'";
$queryview = mysqli_query( $con, $sql );
$rowview = mysqli_fetch_array( $queryview );
if(exists_in_db("SELECT parent FROM `order_status` WHERE order_status='$rowview[status]' AND parent='Final Stage'"))
{
?>
<script>
if(confirm('This Order Is Already In Final Stage Do You Want To Change?'))
    {
        
if(confirm('Are You Sure?'))
    {
        
    }
        else
            {
                window.close();
            }
    }
    else
        {
           window.close();
        }
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

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
  <div class="border col-lg-12 text-center"> </div>
  <?php breadcrumb(); ?>
  <div class="row" style="">
  <h1 align="center">Change Order Status</h1>
  <body>
  <div class="table-responsive">
  <form method="post" action="process_update_order_status.php">
    <input type="hidden" name="id" value="<?php echo $rowview[0]; ?>">
    <input type="hidden" name="old_status" value="<?php echo $rowview['status']; ?>">
    <table  class="table-bordered table-hover" width="100%">
      <thead>
        <tr align="center" bgcolor="#48BDD5">
          <th>Order Status</th>
          <th>Status Change Comments</th>
        
        </tr>
      </thead>
      <tr align="center">
        <td>
            
            <select name="order_status"  class="form-select" onChange="">
            <?php 
                if(exists_in_db("SELECT dispatch_id FROM `order_dispatch_info` WHERE order_id='$id'"))
                {
                 order_status_dd($rowview['status'],false);    
                }
             else
             {
               order_status_dd_processing($rowview['status'],false);  
             }
              ?>
          </select>
          
          </td>
        <td><input type="text" name="comments" class="form-control" placeholder="Comments" required></td>
      </tr>   
       
       
    </table>

      
    </div>
    <div class="col-12 text-center"> <br>
      <input type="submit" name="submit" class="btn-sm btn-primary">
      <input type="reset" class="btn-sm btn-secondary" value="Clear All">
    </div>
    </div>
    </div>
  </form>
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