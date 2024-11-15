<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cash Kharch</title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
	<script src="js\bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 text-danger "><b><h1 class="text-center border header"><?php echo"$project_name"; ?></h1></b></div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><u> Daily Cash Recieve </u></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="border border-secondry">
					<input class ="" type="submit" value="New">
					<br/>
					<br/>
					<label>Ref. #</label>
					<input type="text" />
					<label>Date</label>
					<input type="date" />
					<br>
					<br>
					<label>Total</label>
					<input type="text" />
				</div>
				<br/>
				<br/>
			</div>
			<div class="col-lg-12 text-center">
				<div class="">
					<table class="table">
						<thead>
							<tr>
								<th>Sent Status:</th>
								<th>SMS:</th>
								<th>تفصیل</th>
								<th>Amount</th>
								<th>Balance</th>
								<th>Account</th>
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
								<td><input type="submit" name="" value="send"></td>
							</tr>
						</tbody>
					</table>
					<div class="">
						<br/>
						<br/>
						<input class ="" type="submit" value="Print ">
						<input class =" btn btn-success" type="submit" value="Post">
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>