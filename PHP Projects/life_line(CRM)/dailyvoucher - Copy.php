<?php
 
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}

include("config.php");
include("allFunctions.php")
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
	<script src="js/invoice.js"></script>
	<style>
	.tableFixHead          {   overflow: auto;height: 100%; }
.tableFixHead thead th { background-color: lightgray; position: sticky; top: 0; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 110%; }
th     { background-color: pink; }
	</style>
	<script src="jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
    document.addEventListener('keydown', function (event) {
  if (event.keyCode === 13 && event.target.nodeName === 'INPUT') {
    var form = event.target.form;
    var index = Array.prototype.indexOf.call(form, event.target);
    form.elements[index - 1].focus();
    event.preventDefault();
  }
});
    </script>
</head>
<body>
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper"  style="margin-top: -37px;">
	<div class="container-fluid" style="margin-top: -50px;">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><u> Sales Invoice </u></h2>
			</div>
		</div>
		
		<form action="process_invoice.php" id="myform" enctype="multipart/form-data">
					<label>Invoice #:</label>
					<input class ="mediumInputBox" value="<?php echo getNextId("invoice_no","tbl_dailysale") ?>" type="text" placeholder="Enter invoice number" name="invoice_no" required id="inv" onDblClick="window.location.href='edit_invoice.php?invoice='+document.getElementById('inv').value;">
					<a href="sale-invoce.php"><button>New Invoice</button></a>
					<button onClick="window.location.href='edit_invoice.php?invoice='+document.getElementById('inv').value;"><i class="fa fa-search"></i></button>
		<div class="row">
			
					<input class ="btn btn-success" type="submit" value="Post Invoice">
			<div class="col-lg-12 text-center">
				<div class=" row border border-secondry">
					
					
			<div class="col-lg-4">
					<label>Date:</label>
					<input class ="form-control" type="date" required name="date" id="date"
					</div>
				</div>
			<div class="col-lg-4">
					<label>Remarks:</label>
					<input class ="form-control" type="text" required name="remarks" id="remarks"
					>
				
			</div>
			<div class="col-lg-4">
					<label>Type:</label>
					<select name="type" class="form-select">
				<option>..</option>
				</select>
				
			</div>
			</div>
			<div class="col-lg-12 text-center">
				
	<input type="hidden" id="press" value="1">
				<div class="table-responsive-lg tableFixHead" style="width: 105%; margin-left: -30px;">
				
				<table id="myTable" class="table table-striped table-bordered table-sm">
					<thead>
						<tr><th style="background-color: #00FF2C" colspan="5">Out Side Dr (بنام)</th><th colspan="5" style="background-color: #00B3FF">In Side Cr (جمع)</th></tr>
						<tr>
							<th>Upload</th>
							<th><input type="text" class="smallInputBox fw-bolder" value="0"  required readonly  id="total_bamount" name="sold_amount"><br>Total Dr Amount</th>
							
							<th colspan="2">Description</th>
							<th>Account</th>
							<th>Upload</th>
							
							<th><input type="text" class="smallInputBox fw-bolder" value="0"  required readonly id="total_wazan" name="sold_weight"><br>Total Cr Amount</th>
							<th colspan="2">Description</th>
							<th>Account</th>
							
						</tr>
					
					</thead>
				
					<tbody>
						<?php for($i=0;$i<=70;$i++)
{
	
	 ?> 
						
						<tr>
							
							<td><input style="font-size: 5px;" type='file' name='drfile[]'id="c_rate<?php echo $i; ?>" ></td>
							<td><input type='number' placeholder='Dr Amount' name='amount[]'id="amount<?php echo $i; ?>" onKeyUp="sumamount();" ></td>
							<td><input type='text' placeholder='Description' name='farq[]' id="fark<?php echo $i; ?>"></td>
							<td><select class="form-select-sm" name="crtype[]" id="sel<?php echo $i; ?>">
								<?php 
					populateDD('inv_type','name','id'); ?>
								</select></td>
							<td><select class="form-select-sm" name="craccount[]" id="sel<?php echo $i; ?>">
								<?php 
					populateDD('master_account','account','m_accountid'); ?>
								</select></td>
							
							<td><input  style="font-size: 5px;"  type='file' name='crfile[]'id="c_rate<?php echo $i; ?>" ></td>
							<td><input type='number' placeholder='Cr Amount' name='wazan[]'id="wazan<?php echo $i; ?>" onKeyUp="sumwazan();" ></td>
							<td><input type='text' placeholder='Description' name='farq[]' id="fark<?php echo $i; ?>"></td>
							<td><select class="form-select-sm" name="crtype[]" id="sel<?php echo $i; ?>">
								<?php 
					populateDD('inv_type','name','id'); ?>
								</select></td>
							<td><select class="form-select-sm" name="craccount[]" id="sel<?php echo $i; ?>">
								<?php 
					populateDD('master_account','account','m_accountid'); ?>
								</select></td>
							
							
							
						</tr>
						
						<?php 
}
						?>
					</tbody>
				</table>
					<br>
					<br>
					<br>
				</div>
				</form>
				<!--
				<button class="btn-lg btn-success" type="button" onclick="ins()" title="Add More Rows">+</button>
<button class="btn-lg btn-danger"  type="button"  onclick="rem()" title="Remove Last Row">-</button>
-->
				
	<input type="hidden" id="ival" value="<?php echo $i-1; ?>">
			</div>
		</div>
	</div>
</body>
</html>
</html>