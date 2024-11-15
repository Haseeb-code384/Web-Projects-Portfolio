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
  <form method="post" action="process_add_product.php">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Product Information </div>
      </div>
      <div class="row">
      <div class="col-6">
          <label class="text-danger"><strong>Product Name: </strong></label>
          <input list="symptoms" class="form-control" type="text" name="name" required placeholder="Enter Product Name">
     <datalist id="symptoms">
      <?php populateDDdistinct("symptom_name","symptoms") ?>
  </datalist>
          </div>
          
         <div class="col-6">
          <label class=""><strong>Generic Name: </strong></label>
             <input list="generic_name" name="generic_name"  class="form-control" type="text"   placeholder="Enter Product Generic">
  <datalist id="generic_name">
      <?php populateDDdistinct("generic_name","products") ?>
  </datalist>
             
             
        </div>
        
      </div>
      <div class="row">
        <div class="col-6">
          <label class="text-danger"><strong>Category: </strong></label>
            
             <input list="category" name="category"  class="form-control" type="text"  required placeholder="Enter Product Category">
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
           <input list="company" name="company"  class="form-control" type="text"  required placeholder="Enter Product company">
  <datalist id="company">
      <?php populateDDdistinct("company","products") ?>
  </datalist>
        </div>
       <div class="col-6">
          <label class=""><strong>Description: </strong></label>
          <input class="form-control" type="text" name="description"  placeholder="Enter Product Description">
        </div>
       
      </div>
      <div class="row">
         <div class="col-6">
          <label class="text-danger"><strong>Cost Price: </strong></label>
          <input class="form-control" type="text" name="cost_price" required  placeholder="Enter Product Cost Price">
        </div>
         <div class="col-6">
          <label class="text-danger"><strong>Sale Price: </strong></label>
          <input class="form-control" type="text" name="sale_price" required  placeholder="Enter Product Sale Price">
        </div>
       
      </div>
      <div class="row">
       <div class="col-6">
          <label class="text-danger"><strong>Reorder Level: </strong></label>
          <input class="form-control" type="text" name="reorder_level" required  placeholder="Enter Product Reorder Level">
        </div>
          <div class="col-6">
          <label class="text-danger"><strong>Location: </strong></label>
          <input class="form-control" type="text" name="location" required  placeholder="Enter Stock Location">
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