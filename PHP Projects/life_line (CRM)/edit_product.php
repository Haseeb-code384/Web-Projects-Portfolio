<?php
include( "config.php" );
include( "allFunctions.php" );
$id=$_REQUEST['id'];
$sql="SELECT * FROM `products` WHERE item_id='$id'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
if(isset($_REQUEST['submit']))
{
    $item_id=$_REQUEST['item_id'];
    $name=$_REQUEST['name'];
    $generic_name=$_REQUEST['generic_name'];
    $category=$_REQUEST['category'];
    $supplier_id=$_REQUEST['supplier_id'];
    $company=$_REQUEST['company'];
    $description=$_REQUEST['description'];
    $cost_price=$_REQUEST['cost_price'];
    $sale_price=$_REQUEST['sale_price'];
    $reorder_level=$_REQUEST['reorder_level'];
    $location=$_REQUEST['location'];
    $deleted=$_REQUEST['deleted'];
    
    
    
    $sql_update="UPDATE `products` SET `name` = '$name', `generic_name` = '$generic_name', `category` = '$category', `supplier_id` = '$supplier_id', `company` = '$company', `description` = '$description', `cost_price` = '$cost_price', `sale_price` = '$sale_price', `reorder_level` = '$reorder_level', `location` = '$location', `deleted` = '$deleted' WHERE `products`.`item_id` = '$item_id'";
    $query_update=mysqli_query($con,$sql_update) or die($con);
   
    if($query_update)
    {
        alertredirect("Product Updated Successfully","view_products.php");
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
  <form method="post">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Product Information </div>
      </div>
      <div class="row">
      <div class="col-6">
          <input type="hidden" name="item_id" value="<?php echo $id; ?>">
          <label class="text-danger"><strong>Product Name: </strong></label>
          <input  list="symptoms" class="form-control" type="text" name="name"  value="<?php echo $row['name']; ?>" required placeholder="Enter Product Name">
          
     <datalist id="symptoms">
      <?php populateDDdistinct("symptom_name","symptoms") ?>
  </datalist>
        </div>
         <div class="col-6">
          <label class=""><strong>Generic Name: </strong></label>
             <input list="generic_name" name="generic_name"  value="<?php echo $row['generic_name']; ?>"  class="form-control" type="text"   placeholder="Enter Product Generic">
  <datalist id="generic_name">
      <?php populateDDdistinct("generic_name","products") ?>
  </datalist>
             
             
        </div>
        
      </div>
      <div class="row">
        <div class="col-6">
          <label class="text-danger"><strong>Category: </strong></label>
            
             <input list="category" name="category"  value="<?php echo $row['category']; ?>"  class="form-control" type="text"  required placeholder="Enter Product Category">
  <datalist id="category">
      <?php populateDDdistinct("category","products") ?>
  </datalist>
            
        </div>
          <div class="col-sm-6">
          <label class=""><strong>Supplier:</strong></label>
          <select name="supplier_id"  class="form-select">
            <?php populateDDdistinct("","") ?>
          </select>
        </div>
      </div>
      <div class="row">
       <div class="col-6">
          <label class="text-danger"><strong>Company: </strong></label>
           <input list="company" name="company"  value="<?php echo $row['company']; ?>"  class="form-control" type="text"  required placeholder="Enter Product company">
  <datalist id="company">
      <?php populateDDdistinct("company","products") ?>
  </datalist>
        </div>
       <div class="col-6">
          <label class=""><strong>Description: </strong></label>
          <input class="form-control" type="text" name="description"  value="<?php echo $row['description']; ?>"  placeholder="Enter Product Description">
        </div>
       
      </div>
      <div class="row">
         <div class="col-6">
          <label class="text-danger"><strong>Cost Price: </strong></label>
          <input class="form-control" type="text" name="cost_price"  value="<?php echo $row['cost_price']; ?>" required  placeholder="Enter Product Cost Price">
        </div>
         <div class="col-6">
          <label class="text-danger"><strong>Sale Price: </strong></label>
          <input class="form-control" type="text" name="sale_price"  value="<?php echo $row['sale_price']; ?>" required  placeholder="Enter Product Sale Price">
        </div>
       
      </div>
      <div class="row">
       <div class="col-6">
          <label class="text-danger"><strong>Reorder Level: </strong></label>
          <input class="form-control" type="text"  value="<?php echo $row['reorder_level']; ?>" name="reorder_level" required  placeholder="Enter Product Reorder Level">
        </div>
          <div class="col-6">
          <label class="text-danger"><strong>Location: </strong></label>
          <input class="form-control" type="text" name="location"  value="<?php echo $row['location']; ?>" required  placeholder="Enter Stock Location">
        </div>
          <div class="row">
              
              <div class="col-6">
              
              <label>Delete</label>
                  <input type="checkbox" name="deleted" <?php if($row['deleted']=='1'){echo 'checked';} ?> value="1">
                  
              </div>
          
          
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

</body>
</html>