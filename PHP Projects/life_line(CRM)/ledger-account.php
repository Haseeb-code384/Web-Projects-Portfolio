<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Voucher </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="background-color: #27B7C2">
			<div class="col-lg-8">
				<div class="border text-center">
					<h3>Ledger Account</h3>
				</div>
			</div>
		<div class="row" style="background-color: #27B7C2">
			<div class="col-lg-8">
				<div class="border ">
					<input type="button" value="First">
					<input type="button" value="Next">
					<input type="button" value="Previous">
					<input type="button" value="Last">
					<input type="button" value="New">
					<input type="button" value="...">
					<input type="button" class=" btn-danger element-align-left" value="close">
				</div>
			</div>
			<div class="border col-lg-4">
				
			</div>
			<br/>
			<br/>
			<div class="border col-lg-8">
				<div class="form-group">
					<label>S No: <input class="form-control" type="number" name="" value=""></label>
					<br/>
					<label class="">M_AccountID: <input class="form-control" type="number" name="" value=""></label>
					<br/>
					<label>Account: <input class="form-control" type="number" name="" value=""></label>
					<input class="btn-sm btn-primary" type="button" name="" value="Refresh">
					<br/>
					<label class="">Date <input class="form-control" type="Date" name="" value=""></label>
					<br/>
					<label>Amount:<input class="form-control" type="number" name="" value=""></label>
					<br/>
					<label class="">contact number: <input class="form-control" type="text" name="" value=""></label>
					<br/>
					<label>Type: <input class="form-control" type="text" name="" value=""></label>
					<br/>
					<label class="">credit limit<input class="form-control" type="number" name="" value=""></label>
					<br/>
					<div>
						<label>Description: <input class=" form-control" type="text" name="" value=""></label>
						<br/>
						<label class="">Ref No:<input class="mediumInputBox form-control"type="number" name="" value=""></label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 text-center">
				<div class="">
					<table class="table">
						<thead>
							<tr>
								<th>S No</th>
								<th>Account_ID</th>
								<th>Account</th>
								<th>Date</th>
								<th>Amount</th>
								<th>type</th>
								<th>Description</th>
								<th>Ref. No.</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
	</div>
</body>
</html>