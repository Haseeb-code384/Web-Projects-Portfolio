<?php
include("config.php");
include("allFunctions.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Demand List </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		
<div class="breadcrumb h1"><i class="fa fa-list"></i>Demand List</div>

		<div class="col-lg-12">
			<center>
			<form action="demand_order.php">
				<div class="col-6 ">
				<input type="date"required name="demand_date" class="form-control">
					<input type="submit" value="View Demand Order">
				</div>
			</form>
			<a href="demand_list.php">View All Demands</a>
				</center>
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
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script> 
</body>
</html>