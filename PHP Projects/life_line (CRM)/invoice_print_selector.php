	<?php
include("config.php");
include("allFunctions.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Invoice </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		
<div class="breadcrumb h1"><i class="fa fa-list"></i>Print Voucher Invoice</div>

		<div class="col-lg-12">
			<center>
			<form action="print_invoice.php">
				<div class="col-6 ">
					<label>Select Invoice Date</label>
				<input type="date"required name="invoice_date" class="form-control">
					<br>
					
					<select required  class="form-control selectpicker  form-select-sm"  id="select-country" data-live-search="true" name="salesman" >
								<?php 
					include("optgroup_element.php"); ?>
								</select>
					
					<input type="submit" value="View Voucher">
				</div>
			</form>
			<a href="voucher_list.php">View All Voucher</a>
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

	<script type="text/javascript">
 	
 	jQuery(document).ready(function($){
    let picker = $('.selectpicker');
        picker.selectpicker();

    $(document).on('click', picker, function () {
        $('#group').html(
            $('option:selected', picker).parent('optgroup').prop('label') || 'no group'
        );
        $('#text').html(
            $('option:selected', picker).text()
        );
        $('#value').html(
            picker.val()
        );
    });
});

 </script>
</body>
</html>