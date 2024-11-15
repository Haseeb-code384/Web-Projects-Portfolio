<?php
include( "config.php" );
include( "allFunctions.php" );
$id=$_REQUEST['id'];
if(isset($_REQUEST['submit']))
{
    $kit_id=$_REQUEST['kit_id'];
    $product=$_REQUEST['product'];
    $qty=$_REQUEST['qty'];
    $sql="INSERT INTO `products_in_kits` (`id`, `kit_id`, `product_id`, `quantity`) VALUES (NULL, '$kit_id', '$product', '$qty')";
    $query=mysqli_query($con,$sql);
    $last_id=mysqli_insert_id($con);
    if($query)
    {
        alertredirect("Product Added In Kit","add_product_in_kit.php?id=$kit_id");
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
      <input type="hidden" name="kit_id" value="<?php echo $_REQUEST['id']; ?>">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Products Group </div>
      </div>
      <div class="row">
      <div class="col-5">
          <label class="text-danger"><strong>Select Product Name: </strong></label>
          <?php include("search_product_box.php"); ?>
         
          </div>
          
         <div class="col-5">
          <label class=""><strong>Quantity in Group: </strong></label>
             <input name="qty"  class="form-control" type="number" required style="padding: 10px;"   placeholder="Enter Product Quantity">
 
             
        </div>
          
         <div class="col-2">
          <input type="submit" style="margin-top: 33px; padding: 10px;" name="submit" class="btn-sm btn-success col-12" value="Add">
   
      </div>
      </div>

     

 
    </div>
    
    </div>
    </div>
  </form>
    <div class="table-responsive">
      <table class="table table-hover table-bordered">
          <thead>
              <tr align="center">
              <th colspan="6"><h2 align="center"><?php echo "Items In ".showQuery("SELECT group_name FROM `product_kit` WHERE id='$id'"); ?></h2></th>
              </tr>
    <tr>
        <td>Delete</td>
        <td>Product ID</td>
        <td>Product Name</td>
        <td>Product Quantity</td>
        <td>Unit Price</td>
        <td>Price in Kit</td>
    </tr>
          </thead>
    <tbody>
        <?php 
        $sql_table="SELECT id,products_in_kits.product_id,products_in_kits.quantity,(SELECT name FROM `products` WHERE item_id=products_in_kits.product_id),(SELECT sale_price FROM `products` WHERE item_id=products_in_kits.product_id),(SELECT sale_price*products_in_kits.quantity FROM `products` WHERE item_id=products_in_kits.product_id) FROM `products_in_kits` WHERE kit_id='$id'";
        $query_table=mysqli_query($con,$sql_table);
        $sum=0;
     
        while($row_table=mysqli_fetch_array($query_table))
        {
        ?>
        <tr>
            <th><a class="fa fa-trash text-danger" href="del.php?DelItemInKit=<?php echo $row_table[0]; ?>&id=<?php echo $id; ?>"></a></th>
        
        <td><?php echo $row_table[1];  ?></td>
        <td><?php echo $row_table[3];  ?></td>
        <td><?php echo $row_table[2];  ?></td>
        <td><?php echo $row_table[4];  ?></td>
        <td><?php $sum=$sum+$row_table[5];
            echo $row_table[5];
            ?></td>
        </tr>  
        <?php }
       
        ?>
        <tr>
            <th align="center" colspan="5">Kit Price</th>
            <th colspan=""><?php 
                echo $sum;
                ?></th>
        </tr>
    </tbody>
    </table>
    </div>
    <center>
    
    <a href="view_product_kits.php" class="btn btn-primary text-white">Done</a>
    </center>
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