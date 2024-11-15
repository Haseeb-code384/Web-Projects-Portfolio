<?php
session_start();
if ( !isset( $_SESSION[ 'email' ] ) ) {
	header( "location:login.php" );
}

include( "config.php" );
include( "allFunctions.php" );
$dispatch_date = $_REQUEST[ 'dispatch_date' ];
$salesman = $_REQUEST[ 'salesman' ];
$reading1=showQuery("SELECT reading1 FROM `dispatch` WHERE date='$dispatch_date' AND salesman='$salesman'");
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
	<script src="invoice.js"></script>
	<style>
		.tableFixHead {
			overflow: auto;
			height: 100%;
		}
		
		.tableFixHead thead th {
			background-color: lightgray;
			position: sticky;
			top: 0;
			z-index: 1;
		}
		/* Just common table stuff. Really. */
		
		table {
			border-collapse: collapse;
			width: 110%;
		}
		
		th {
			background-color: pink;
		}
	</style>

	<script src="jquery-2.1.4.min.js"></script>

	<script type="text/javascript">
		document.addEventListener( 'keydown', function ( event ) {
			if ( event.keyCode === 13 && event.target.nodeName === 'INPUT' ) {
				var form = event.target.form;
				var index = Array.prototype.indexOf.call( form, event.target );
				form.elements[ index - 1 ].focus();
				event.preventDefault();
			}
		} );
	</script>

	<style>
		form,
		nav,
		input,
		select,
		button,
		td,
		select {
			font-size: 13pt;
		}
		.big{
			font-size:14pt;
		}
	</style>
</head>
<script>
	function loadcntnt() {
		document.getElementById( "preloader" ).style.display = "none";
		document.getElementById( "cntnt" ).style.visibility = "visible";
	}
</script>
</head>
<div id="preloader">
	<center>
		<img src="img/loading.gif" style="width: 100px; vertical-align: middle;">
	</center>

</div>

<body onLoad="loadcntnt();">

	<?php 
include "start.php"; ?>
	</div>
	<div id="cntnt" style="visibility: hidden;">
		<div class="content-wrapper" style="margin-top: -37px;">
			<div class="container-fluid" style="">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2><u>Invoice</u></h2>
					</div>
				</div>

				<form  id="myform" method="get" action="preview_saleman_invoice.php" enctype="multipart/form-data">


					<div class="row">

						<input class="btn-sm btn-success" type="submit" value="Post">
						<div class="col-sm-12 text-center">
							<div class=" row border border-secondry">
								<div class="col-sm-2">
									<label>Date:</label>
									<input class="form-control" style="font-size: 14pt;" type="date" required name="idate" id="date" value="<?php echo date("m/d/Y"); ?>" </div>
								</div>
								<div class="col-sm-4">
									<label>Remarks:</label>
									<input  style="font-size: 14pt;" class="form-control" type="text" name="remarks" id="remarks">
								</div>
								<div class="col-sm-4">
									<label>Salesman</label>
									<br>
									<label>
										<input type="text" name="salesman" value="<?php echo $salesman; ?>">
										<?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$salesman'"); ?>
									</label>
									<input  style="font-size: 14pt;" type="hidden" name="salesman" value="<?php echo $salesman; ?>">
								</div>

								<div class="col-sm-2">
									<label>Commission %:</label>
									<input  style="font-size: 14pt;" class="form-control" type="text" name="commission_p_age" value="<?php echo showQuery(" SELECT rate FROM `master_account` WHERE m_accountid='$salesman' "); ?>">
								</div>
							</div>

							<div class="row" >

								<div class="col-sm-12 text-center" >
									<div class=" row border border-secondry" >


										<div class="col-sm-3">
											<label>Vehicle Number</label>
											<input  style="font-size: 14pt;" class="form-control" type="text" name="vehicle_no">
										</div>

										<div class="col-sm-3">
											<label>Reading 1:</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="reading1" id="reading1" value="<?php echo $reading1; ?>">
										</div>
										<div class="col-sm-3">
											<label>Reading 2:</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="reading2" onKeyUp="cal_dis(this.value);">
										</div>
										<div class="col-sm-3">
											<label>Distance</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="distance" id="distance">
										</div>
									</div>
									<div class="row">

										<div class="col-sm-12 text-center">
											<div class=" row border border-secondry">


												<div class="col-sm-3">
													<label>Fuel Rate:</label>
													<input  style="font-size: 14pt;" class="form-control" type="text" name="fuel_rate" id="fuel_rate" onKeyUp="fuel(this.value);">
												</div>
												<div class="col-sm-3">
													<label>Fuel Per KM:</label>
													<input  style="font-size: 14pt;" class="form-control" type="text" name="per_km" id="per_km" value="12">
												</div>


												<div class="col-sm-3">
													<label>Fuel Charges:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="fuel_charges" id="fuel_charges" value="0">
												</div>
												<div class="col-sm-3">
													<label>Rent:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="rent" id="rent" value="0">
												</div>

												<div class="col-sm-6">
													<label>Misc Expense:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="misc" id="misc" value="0">
												</div>
												<div class="col-sm-6">
													<label>Parchi:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="parchi" id="parchi" value="0">
												</div>
											</div>
										</div>
									</div>




									<div class="row text-center">

										<input type="hidden" id="press" value="1">
										<div class="table-responsive-sm tableFixHead">

											<table id="myTable" class="table table-striped table-bordered table-sm">
												<thead>
													<tr>


														<th>SN</th>
														<th>Product ID</th>
														<th>Category</th>
														<th>Name</th>
														<th>Unit Price</th>
														<th>Dispatch</th>
														<th>Return</th>
														<th>Waste</th>
																												<!--	
														<th>Final Quantity</th>
													<th>Amount</th>-->

													</tr>

												</thead>

												<tbody>
													<?php 
						$i=1;
						$sql_dispatch="SELECT dispatch_detail.product_id,ospos_items.category,ospos_items.name,dispatch_detail.unit_price,dispatch_detail.quantity,dispatch_detail.amount FROM dispatch,dispatch_detail,ospos_items WHERE dispatch.date='$dispatch_date' AND salesman='$salesman' AND dispatch_detail.dispatch_no=dispatch.id  AND dispatch_detail.product_id=ospos_items.item_id ORDER BY ospos_items.category";
						
						$query_dispatch=mysqli_query($con,$sql_dispatch);
						while($row_dispatch=mysqli_fetch_array($query_dispatch))
{
	
	 ?>

													<tr>
														<td>
															<?php echo $i; ?>
														</td>
														<td>
															<input  type="hidden"  name="product[]" value="<?php echo $row_dispatch[0]; ?>">
															<?php echo $row_dispatch[0]; ?>
														</td>
														<td>
															<?php echo $row_dispatch[1]; ?>
														</td>
														<td>
															
															<?php echo $row_dispatch[2]; ?>
														</td>
														<td>
															
															<input  style="font-size: 14pt;" type="text" class="form-control" name="p_unit_price[]" value="<?php echo $row_dispatch[3]; ?>">
														</td>
														<td>
															<input  style="font-size: 14pt;" type="text" class="form-control" name="p_dispatch[]" value="<?php echo $row_dispatch[4]; ?>">
														</td>
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="p_return[]" value="0">
														</td>
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="p_waste[]" value="0">
														</td>
																												<!--	
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="final_qty[]" value="0">
														</td>
														
														<td><input type="text" class="form-control" name="amount[]" value="0">
														</td>
-->

													</tr>


													<?php 
							
							
							$i++;
}
						?>
													<tr>
														<th colspan="6">Discount</th>
														<th colspan="3"><input  style="font-size: 14pt;" type="text" class="form-control" name="discount" value="0"></th>

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
	jQuery( document ).ready( function ( $ ) {
		let picker = $( '.selectpicker' );
		picker.selectpicker();

		$( document ).on( 'click', picker, function () {
			$( '#group' ).html(
				$( 'option:selected', picker ).parent( 'optgroup' ).prop( 'label' ) || 'no group'
			);
			$( '#text' ).html(
				$( 'option:selected', picker ).text()
			);
			$( '#value' ).html(
				picker.val()
			);
		} );
	} );
</script>