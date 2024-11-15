<?php
include( "config.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
    $name=$_REQUEST['name'];
    $sql="INSERT INTO `product_kit` (`id`, `group_name`) VALUES (NULL, '$name')";
    $query=mysqli_query($con,$sql);
    $last_id=mysqli_insert_id($con);
    if($query)
    {
        alertredirect("$name Group Created. Please Select Products and Quantity","add_product_in_kit.php?id=$last_id");
    }
    else
    {
    
        alertredirect("Something Went Wrong","add_product_in_kit.php");
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">

<script src="semester.js"></script>
</head>

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
 
  <?php breadcrumb(); ?>
  <div class="row" style="">
  <form method="post" action="">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Products Group </div>
      </div>
      <div class="row">
      <div class="col-6">
          <label class="text-danger"><strong>Enter Group Name: </strong></label>
          
             <input name="name" autofocus="autofocus"  class="form-control" type="text" required   placeholder="Enter Group Name">
         
          </div>
          
        
        
      </div>

     

 
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