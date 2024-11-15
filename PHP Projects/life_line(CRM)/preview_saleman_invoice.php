<?php
session_start();
if ( !isset( $_SESSION[ 'email' ] ) ) {
	header( "location:login.php" );
}

include( "config.php" );
include( "allFunctions.php" );

$idate = $_REQUEST[ 'idate' ];
$remarks = $_REQUEST[ 'remarks' ];
$salesman = $_REQUEST[ 'salesman' ];
$salesman = $_REQUEST[ 'salesman' ];
$commission_p_age = $_REQUEST[ 'commission_p_age' ];
$vehicle_no = $_REQUEST[ 'vehicle_no' ];
$reading1 = $_REQUEST[ 'reading1' ];
$reading2 = $_REQUEST[ 'reading2' ];
$distance = $_REQUEST[ 'distance' ];
$fuel_rate = $_REQUEST[ 'fuel_rate' ];
$per_km = $_REQUEST[ 'per_km' ];
$fuel_charges = $_REQUEST[ 'fuel_charges' ];
$rent = $_REQUEST[ 'rent' ];
$misc = $_REQUEST[ 'misc' ];
$parchi = $_REQUEST[ 'parchi' ];
$product = $_REQUEST[ 'product' ];
$p_unit_price = $_REQUEST[ 'p_unit_price' ];
$p_dispatch = $_REQUEST[ 'p_dispatch' ];
$p_return = $_REQUEST[ 'p_return' ];
$p_waste = $_REQUEST[ 'p_waste' ];
$discount = $_REQUEST[ 'discount' ];

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
	<script>
	function calbal()
		{
	var grand_total=parseFloat(document.getElementById("grand_total").value);
	var cash_received=parseFloat(document.getElementById("cash_received").value);
	var balance=cash_received-grand_total;
document.getElementById("balance").value=Math.round(balance);
			if(balance>=0)
				{
					document.getElementById("balance").style.color='Green';
					document.getElementById("balance").style.backgroundColor='lightgreen';
				}
			else{
					document.getElementById("balance").style.color='Red';
					document.getElementById("balance").style.backgroundColor='lightpink';
			}
				
			
		}
	</script>

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

				<form  id="myform" method="POST" action="process_salesman_invoice.php" enctype="multipart/form-data">


					<div class="row">

						<input class="btn-sm btn-success" type="submit" value="Post">
						<div class="col-sm-12 text-center">
							<div class=" row border border-secondry">
								<div class="col-sm-2">
									<label>Date:</label>
									<input class="form-control" style="font-size: 14pt;" type="date" required name="idate" id="date" value="<?php echo $idate ?>" </div>
								</div>
								<div class="col-sm-4">
									<label>Remarks:</label>
									<input  style="font-size: 14pt;" class="form-control" type="text" name="remarks" id="remarks" value="<?php echo $remarks ?>">
								</div>
								<div class="col-sm-4">
									<label>Salesman</label>
									<br>
									<label>
										<?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$salesman'"); ?>
									</label>

									<input  style="font-size: 14pt;" type="text" name="salesman" value="<?php echo $salesman; ?>">
								</div>

								<div class="col-sm-2">
									<label>Commission %:</label>
									<input  style="font-size: 14pt;" class="form-control" type="text" name="commission_p_age" value="<?php echo $commission_p_age; ?>">
								</div>
							</div>

							<div class="row" >

								<div class="col-sm-12 text-center" >
									<div class=" row border border-secondry" >


										<div class="col-sm-3">
											<label>Vehicle Number</label>
											<input  style="font-size: 14pt;" class="form-control" type="text" name="vehicle_no" value="<?php echo $vehicle_no ?>">
										</div>

										<div class="col-sm-3">
											<label>Reading 1:</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="reading1" id="reading1" value="<?php echo $reading1; ?>">
										</div>
										<div class="col-sm-3">
											<label>Reading 2:</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="reading2" value="<?php echo $reading2 ?>"onKeyUp="cal_dis(this.value);">
										</div>
										<div class="col-sm-3">
											<label>Distance</label>

											<input  style="font-size: 14pt;" class="form-control" type="text" name="distance" id="distance" value="<?php echo $distance ?>">
										</div>
									</div>
									<div class="row">

										<div class="col-sm-12 text-center">
											<div class=" row border border-secondry">


												<div class="col-sm-3">
													<label>Fuel Rate:</label>
													<input  style="font-size: 14pt;" class="form-control" type="text" name="fuel_rate" id="fuel_rate" onKeyUp="fuel(this.value);" value="<?php echo $fuel_rate ?>">
												</div>
												<div class="col-sm-3">
													<label>Fuel Per KM:</label>
													<input  style="font-size: 14pt;" class="form-control" type="text" name="per_km" id="per_km" value="<?php echo $per_km ?>">
												</div>


												<div class="col-sm-3">
													<label>Fuel Charges:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="fuel_charges" id="fuel_charges" value="<?php echo $fuel_charges; ?>">
												</div>
												<div class="col-sm-3">
													<label>Rent:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="rent" id="rent" value="<?php echo $rent ?>">
												</div>

												<div class="col-sm-6">
													<label>Misc Expense:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="misc" id="misc" value="<?php echo $misc ?>">
												</div>
												<div class="col-sm-6">
													<label>Parchi:</label>

													<input  style="font-size: 14pt;" class="form-control" type="text" name="parchi" id="parchi" value="<?php echo $parchi; ?>">
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
																												
														<th>Final Quantity</th>
													<th>Amount</th>

													</tr>

												</thead>

												<tbody>
													<?php 
						
						
						$t=0;
													$tamount=0;
$total_prod_no=count(array_filter($product));
						for($i=0;$i<$total_prod_no;$i++)
								{
	
	 ?>

													<tr>
														<td>
															<?php echo $i+1; ?>
														</td>
														<td>
															<input  type="hidden"  name="product[]" value="<?php echo $product[$i]; ?>">
															<?php echo $product[$i]; ?>
														</td>
														<td>
															<?php echo showQuery("SELECT category FROM `ospos_items` WHERE item_id='$product[$i]'") ?>
														</td>
														<td>
															<?php echo showQuery("SELECT name FROM `ospos_items` WHERE item_id='$product[$i]'") ?>
														</td>
														<td>
															
															<input  style="font-size: 14pt;" type="text" class="form-control" name="p_unit_price[]" value="<?php echo $p_unit_price[$i]; ?>">
														</td>
														<td>
															<input  style="font-size: 14pt;" type="text" class="form-control" name="p_dispatch[]" value="<?php echo $p_dispatch[$i]; ?>">
														</td>
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="p_return[]" value="<?php echo $p_return[$i]; ?>">
														</td>
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="p_waste[]" value="<?php echo $p_waste[$i]; ?>">
														</td>
																												
														<td><input  style="font-size: 14pt;" type="number" class="form-control" name="final_qty[]" value="<?php echo $fq= $p_dispatch[$i]-$p_return[$i]-$p_waste[$i]; ?>">
														</td>
														
														<td><input style="font-size: 14pt;" type="text" class="form-control" name="amount[]" value="<?php  $tamount=$fq*$p_unit_price[$i];
															echo $tamount;
															?>">
															<?php echo $t=$t+$tamount; 
															$tamount=0;
															?>
														</td>


													</tr>


													<?php 
							
							

}
						?>
													<tr>
													<th colspan="6">Subtotal</th>
														
											<th colspan="6">
														<input type="text" style="font-size: 14pt;" name="subtotal" class="form-control" value="<?php echo $t; ?>">
														</th>
													</tr>
													<tr>
														<th colspan="6">Discount</th>
														<th colspan="6"><input  style="font-size: 14pt;" type="text" class="form-control" name="discount" value="<?php echo $discount; ?>">
														
														</th>

													</tr>
													<th colspan="6">Commission Amount</th>
											<th colspan="6">
														<input type="text" style="font-size: 14pt;" name="commission_amount" class="form-control" value="<?php echo $commission_amount=$t*($commission_p_age/100); ?>">
														</th>
													</tr>
													<tr>
											<th colspan="6">Grand Total</th>
														<?php
														 $gtotal=$t-$discount-$commission_amount-$fuel_charges-$rent-$misc-$parchi;
														?>
											<th colspan="6">
												
												<input type="checkbox" class="form-check" required>
												<input  class="form-control" style="font-size: 14pt;" type="text" id="grand_total" name="grand_total" value="<?php echo $gtotal?>"></th>
											</tr>
												<tr>
											<th colspan="6">Cash Received</th>
														
											<th colspan="6">
												<input type="checkbox" class="form-check" required>
												<input  class="form-control" style="font-size: 14pt;" type="text" name="cash_received" id="cash_received" onKeyUp="calbal();" required></th>
											</tr>
											<tr>
											<th colspan="6">Balance</th>
														
											<th colspan="6"><input  class="form-control" style="font-size: 14pt;" type="text" name="balance" id="balance" required></th>
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