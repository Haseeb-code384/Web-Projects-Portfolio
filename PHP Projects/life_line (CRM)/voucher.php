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
	<div class="container-fluid">
		<div class="row "> 	
				<div class="col-lg-6  text-center border">
					<input class="text-right btn btn-success btn-square" type="button" value="New Voucher">
					<label> Voucher No.</label>
					<input type="number" name="" value="">
					<br/>
					<br/>
					<label> Date</label>
					<input type="date">
					<label>Find Voucher</label>
					<input type="text" name="" value="">
				</div>
				<div class="col-lg-6  text-center border">
					<input type="button" class="btn-warning btn-square" value="Post">
					<input type="button" class="btn-sm btn-light btn-small-square" value="First">
					<input type="button" class="btn-sm btn-light btn-small-square" value="P">
					<input type="button" class="btn-sm btn-light btn-small-square" value="N">
					<input type="button" class="btn-sm btn-light btn-small-square" value="Last">
					<label>Remrks<input type="text" name="" value=""></label>
					<br/>
					<br/>
					<input type="button" class="btn-sm btn-secondary" value="Find Voucher">
					<input type="button" class="btn-sm btn-light btn-small-square" value="GV">
					<input type="button" class="btn-sm btn-light btn-small-square" value="PV">
					<input type="button" class="btn-sm btn-light btn-small-square" value="CV">	 
				</div> 
			</div>
			<div class="row">
				<div class="col-lg-6">
					<table class="table">
						<caption class="text-center">Paymant Voucher</caption>
						<thead>
							<tr class="text-center">
								<th>رقم</th>
								<th>تفصیل</th>
								<th>کسٹمر</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<table class="table">
						<caption class="text-center">Cash Voucher</caption>
						<thead>
							<tr class="text-center">
								<th>رقم</th>
								<th>تفصیل</th>
								<th>کسٹمر</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
						</tbody>
					</table>
				</div>	
			</div>
			
	</div>
</body>
</html>