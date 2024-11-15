<?php
include("config.php");
include("allFunctions.php");
include("preloader.php");

$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Get the URL parameters
$params = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

// Combine the previous page URL and parameters
//$previousPageWithParams = $previousPage . '?' . $params;
$previousPageWithParams = $previousPage ;

// Output the result
$page= $previousPageWithParams;
if(isset($_REQUEST['submit']))
{
    
     $mother_medicine = $_REQUEST['mother_medicine'];
     $medicine_potency = $_REQUEST['medicine_potency'];
     $medicine_form = $_REQUEST['medicine_form'];
     $quantity = $_REQUEST['quantity'];
     $location = $_REQUEST['location'];
    
	$sql="INSERT INTO `medicine_stock` (`mother_medicine`, `medicine_potency`, `medicine_form`, `quantity`, `location`) VALUES ('$mother_medicine', '$medicine_potency', '$medicine_form', '$quantity', '$location')";
	$query=mysqli_query($con,$sql);
    if($query)
    {
        alertredirect("Data Inserted Successfully","manage_medicine_stock.php");
    }
	
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
  $currentPage = basename($_SERVER['PHP_SELF']);

  if ($currentPage === 'manage_rubric.php') {
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
  } else {
    echo '<script src="vendor/jquery/jquery.min.js"></script>';
  }
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
    <style>
    textarea {
      width: 100%;
      height: 300px;
    }
  </style>
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluids">
	<div class="col-sm-12">
			
		
			<?php breadcrumb(); ?>
			<form>
         
        <div class="row">
        <div class="col-sm-3">
            <label>Mother Medicine</label>
        <select name="mother_medicine" required id="example-getting-started" style="height: 100px;" >
   <?php populateDD("medicine_list","concat(abbreviation,' | ',medicine_name)","medicine_name") ?>
</select>
        </div>
        
        <div class="col-sm-3">
            
            <label>Potency</label>
<select class="form-control" name="medicine_potency" required>
    
        <?php populateDD("medicine_potency","potency","potency") ?>
        </select>
    </div>
        
        <div class="col-sm-2">
            
            <label>Form</label>
      <select class="form-control" name="medicine_form" required>
        <?php populateDD("medicine_forms","form_name","form_name") ?>
        </select>
        </div>
            
        <div class="col-sm-2">
            
            <label>Quantity</label>
            <input type="text" name="quantity" required placeholder="Quantity" class="form-control">
        </div> 
            <div class="col-sm-2">
            
            <label>Location</label>
            <input type="text" name="location" required placeholder="Location" class="form-control">
        </div>
        </div>

</center>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            enableResetButton: true,
            enableFiltering: true,
            includeSelectAllOption: true, 
            buttonWidth: '100%',
        });
    });
</script>
    <input type="submit" name="submit" class="btn-sm btn-primary">
			</form>
			</div>
	</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</body>
</html>