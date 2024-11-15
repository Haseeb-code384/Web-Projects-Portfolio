<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}

include("config.php");
include("allFunctions.php");
	$demand_date=$_REQUEST['demand_date'];
	$salesman=$_REQUEST['salesman'];
?>
<!DOCTYPE html>
<html>
<head>
<link href="cdn/bootstrap.min.css" rel="stylesheet"/>
	
<link href="cdn/bootstrap-select.min.css" rel="stylesheet"/>
	
<script src="cdn/jquery.min.js"></script>
<script src="cdn/bootstrap.min.js"></script>
<script src="cdn/bootstrap-select.min.js"></script>
	
	
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
	
<style>
	form,nav,input,select,td,select{ font-size: 13pt;}
	
	</style>
</head><script>
	function loadcntnt()
		{
			document.getElementById("preloader").style.display="none";
			document.getElementById("cntnt").style.visibility="visible";
		}
	</script>
</head>
<div id="preloader">
	<center>
	<img src="img/loading.gif" style="width: 100px; vertical-align: middle;">
	</center>
	
	</div>
<body  onLoad="loadcntnt();">

	<?php 
include "start.php"; ?></div>
			<div id="cntnt" style="visibility: hidden;" >
<div class="content-wrapper"  style="margin-top: -37px;">
	<div class="container-fluid" style="">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2><u>Dispatch</u></h2>
			</div>
		</div>
		
		<form id="myform" method="POST" action="process_dispatch.php" enctype="multipart/form-data">
			
				
		<div class="row">
			
					<input class ="btn btn-success" type="submit" value="Post">
			<div class="col-sm-12 text-center">
				<div class=" row border border-secondry">
					
					
			<div class="col-sm-3">
					<label>Date:</label>
					<input class ="form-control" type="date" required name="date" id="date" value="<?php echo date("Y-m-d"); ?>"
					</div>
				</div>
			<div class="col-sm-3">
					<label>Remarks:</label>
					<input class="form-control" type="text"  name="remarks" id="remarks"
					>
			</div>
					<div class="col-sm-3">
					<label>Reading1:</label>
					<input class="form-control" type="text"  name="reading1" id="reading1">
			</div>
			<div class="col-sm-3">
					<label>Salesman</label>
				<br>
					<label><?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$salesman'"); ?></label>
				
				<input type="hidden" name="salesman" value="<?php echo $salesman; ?>">
			</div>
			</div>
				
			<div class="row text-center">
				
	<input type="hidden" id="press" value="1">
				<div class="table-responsive-sm tableFixHead">
				
				<table id="myTable" class="table table-striped table-bordered table-sm" >
					<thead>
						<tr>
						
							
							<th>SN</th>
							<th>Product ID</th>
							<th>Category</th>
							<th>Name</th>
							<th>Unit Price</th>
							<th>Quantity</th>
							<th>Amount</th>
							
						</tr>
					
					</thead>
				
					<tbody>
						<?php 
						$i=1;
						$sql_dispatch="SELECT demand_detail.demand_no,date,salesman,product_id,ospos_items.category,ospos_items.name,ospos_items.unit_price,quantity,ospos_items.unit_price*quantity AS 'total' FROM demand,demand_detail,ospos_items WHERE demand.id=demand_detail.demand_no AND ospos_items.item_id=product_id AND demand.date='$demand_date' AND salesman='$salesman'";
						$query_dispatch=mysqli_query($con,$sql_dispatch);
						while($row_dispatch=mysqli_fetch_array($query_dispatch))
{
	
	 ?> 
						
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_dispatch[3]; ?></td>
							<td><?php echo $row_dispatch[4]; ?></td>
							<td><?php echo $row_dispatch[5]; ?></td>
							<td><?php echo $row_dispatch[6]; ?></td>
							<td>
				<input type="text" class="form-control" style="font-size: 14pt;" name="quantity[]" value="<?php echo $row_dispatch[7]; ?>"></td>
							<td><?php echo $row_dispatch[8]; ?></td>
						
						</tr>
						
				<input type="hidden" name="product[]" value="<?php echo $row_dispatch[3]; ?>">
				<input type="hidden" name="unit_price[]" value="<?php echo $row_dispatch[6]; ?>">
				<input type="hidden" name="amount[]" value="<?php echo $row_dispatch[8]; ?>">
						
						<?php 
							
							
							$i++;
}
						for($j=$i;$j<=$i+16;$j++)
						{
						?>
						
						<tr>
							<td><?php echo $j; ?></td>
							<td></td>
							<td></td>
							<td>
								<select  class="form-control selectpicker  form-select-sm"  id="select-country" data-live-search="true" name="product[]" style="height: 200px;">
								<?php 
					include("optgroup_items.php") ?>
								</select>
							</td>
							<td>
				<input type="hidden" name="unit_price[]" value="<?php echo $row_dispatch[6]; ?>">
							</td>
							
							<td>
				<input type="text" class="form-control" style="font-size: 14pt;" name="quantity[]" value="<?php echo $row_dispatch[7]; ?>"></td>
							<td>
				<input type="hidden" name="amount[]" value="<?php echo $row_dispatch[8]; ?>"></td>
							<td><?php echo $row_dispatch[8]; ?></td>
						</tr>
						<?php } ?>
						<tr>
						<th colspan="6">Total</th>
						<th><?php echo $tamount=showQuery("SELECT sum(ospos_items.unit_price*quantity) FROM demand,demand_detail,ospos_items WHERE demand.id=demand_detail.demand_no AND ospos_items.item_id=product_id AND demand.date='$demand_date' AND salesman='$salesman'"); ?>
							<input type="hidden" name="tamount" value="<?php echo $tamount; ?>"
							</th>
							
						</tr>
					</tbody>
				</table>
					<br>
					<br>
					<br>
				</div>
				</form>
				<!--
				<button class="btn-sm btn-success" type="button" onclick="ins()" title="Add More Rows">+</button>
<button class="btn-sm btn-danger"  type="button"  onclick="rem()" title="Remove Last Row">-</button>
-->
				
	<input type="hidden" id="ival" value="<?php echo $i-1; ?>">
			</div>
		</div>
		</div>
		</div>
</body>
</html>
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