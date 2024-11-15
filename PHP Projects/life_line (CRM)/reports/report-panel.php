<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Report Panel</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/custom-theme.css">
</head>
<body>
	
	
</div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 border">
				<input class="element-align-left btn-danger" type="button" value="Close">
				<div class="col-sm-8 text-center">
					<h1 >Reporting Panel</h1>
				</div>
				<form>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<div class="border text-center">
								<label>From<input class="form-control" type="date" name="" value="From"></label>
								<label>To<input class="form-control" type="date" name="" value="To"></label>
								<input type="submit" value="کیش بک">
								<br/>
								<br/>
								<label class="">منتخب کھاتہ<input class=" smallInputBox " type="text" name="" value="">
									<input class="form-control" type="text">
									<br/>
									<input type="submit" class="btn btn-primary" name="" value="کھاتہ تفصیل درج شدہ پارٹی">
								</label>
								<label >Accounnt head:<input class="form-control" type="text" name="" value=""></label>
								<label >Area:<input class="form-control" type="text" name="" value=""></label>
								<br/>
								<br/>
								<input type="submit" formaction="0summaryreport.php" class="btn btn-primary form-control" name="" value="  شارٹ بیلنس سمری 0">
								<br/>
								<br/>
								<input type="submit" formaction="short-balance-summary.php" class="btn btn-secondary form-control" name="" value="شارٹ سمری ">
								<br/>
								<br/>
								<input type="submit"  class="btn btn-success form-control" name="" value="ڈیلی سیل رپورٹ">
								<br/>
								<br/>
								<input type="submit" formaction="sale-mukamal.php" class="btn btn-warning form-control" name="" value=" سیل مکمل">
								<br/>
								<br/>
								<input type="submit" formaction="daily-balance-summary.php"class="btn btn-info form-control" name="" value="  ڈیلی بیلنس سمری">
								<br/>
								<br/>
								<input type="submit"formaction="daily-account-entry.php" class="btn-basic form-control" name="" value=" ڈیلی اکاؤنٹ انٹری ">
								<br/>
								<br/>
								<input type="submit" formaction="daily-balance-report.php" class="btn-default form-control" name="" value="  ڈیلی بیلنس رپورٹ">
								<br/>
								<br/>
								<input type="submit"formaction="select-balance-report.php" class="btn btn-success form-control" name="" value=" سلیکٹ بیلنس رپورٹ">
								<br/>
								<br/>
								<input type="submit" formaction="dukandar-list.php" class="btn btn-warning form-control" name="" value="  دکاندار لسٹ">
								<br/>
								<br/>
								<input type="submit"formaction="phone-number-list.php" class="btn btn-danger form-control" name="" value="  فون نمبر لسٹ">
							</div>	
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="border text-center ">
								<div class="button-group">
									<input type="submit"  class="btn btn-primary btn-group-lg btn-lg" name="" value="کمیٹی کھاتہ">
									<input type="submit" formaction="comitti-tafseel.php" class="btn btn-secondary btn-group-lg btn-lg" name="" value="کمیٹی تفصیل  ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit" formaction="cometi-report.php" class="btn btn-warning btn-group-lg btn-lg" name="" value="کمیٹی رپورٹ ">
									<input type="submit" formaction="rate-aur-cometi-list.php" class="btn btn-default btn-group-lg btn-lg" name="" value=" ریٹ اور کمیٹی لسٹ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit" formaction="wazan-total-dukandar.php" class="btn btn-danger btn-group-lg btn-lg" name="" value="وزن ٹوٹل دکاندار ">
									<input type="submit" class="btn btn-success btn-group-lg btn-lg" name="" value=" ماہانہ کمیٹی ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit" formaction="wazan-report-driver.php" class="btn btn-info btn-group-lg btn-lg" name="" value="وزن رپورٹ ڈرائیور ">
									<input type="submit" formaction="total-khareed-report.php" class="btn btn-basic btn-group-lg btn-lg" name="" value="ٹوٹل خرید رپورٹ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit" formaction="sale-report.php" class="btn btn-warning btn-group-lg btn-lg" name="" value="سیل ">
									<input type="submit" formaction="0-sale.php" class="btn btn-success btn-group-lg btn-lg" name="" value="سیل 0 ">
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>		
		</div>			
	</div>
	</div></form>
</body>
</html>