<?php
include( 'allFunctions.php' );

?>
<!DOCTYPE html>
<html>
 <head>
<style>
.navbar {
    font-size: 12pt;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<link href="cdn/bootstrap.min.css" rel="stylesheet"/>
<link href="cdn/bootstrap-select.min.css" rel="stylesheet"/>
<script src="cdn/jquery.min.js"></script> 
<script src="cdn/bootstrap.min.js"></script> 
<script src="cdn/bootstrap-select.min.js"></script>
</head>
 <?php include("preloader.php"); ?>
<?php
include "start.php";
?>
<div class="content-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12 border">
<input class="element-align-left btn-danger" type="button" value="Close">
<div class="col-sm-12 text-center">
   <h1>Reporting Panel</h1>
 </div>
<form method="post">
<div class="row">
<div class="col-lg-12" >
<div class="form-group">
<div class="border text-center">
<center>
   <a href="reports/trial_balance.php" target="new"><span class="btn btn-primary">Get Trial Balance</span></a>
   <a href="reports/balance_sheet.php" target="new"><span class="btn btn-danger">Get Balance Sheet</span></a>
   <select name="crdr" class="form-select col-4">
    <option>Cr</option>
    <option>Dr</option>
  </select>
 </center>
<input type="submit" class="btn btn-primary" formtarget="_new" value="Get Entry Report" formaction="reports/crdrReport.php">
<input type="submit"  class="btn btn-success"  formtarget="_new" value="Get Ledger Report" formaction="reports/viewledger.php">
    
            <?php 
    if($_SESSION['email']=="Doctor Omar Chughtai"||$_SESSION['email']=="admin")
    { ?>
    <br>
<input type="submit" class="btn btn-info"  formtarget="_new" value="Get Cash Flow Report" formaction="reports/cashflow.php">
<input type="submit" class="btn btn-warning"  formtarget="_new" value="Get Business Report" formaction="reports/business_report.php">
<input type="submit" class="btn btn-danger"  formtarget="_new" value="Get Al-Hafiz Report" formaction="reports/alhafiz_report.php">
      <br>
    <?php } ?>
<label>From
   <input class="form-control" type="date" name="date_start" value="<?php echo date("Y-m-01") ?>">
 </label>
<label>To
   <input class="form-control" type="date" name="date_end" value="<?php echo date("Y-m-d") ?>">
 </label>
<br/>
<br/>
<label class="">
Select Account
<select class="form-control selectpicker  form-select-lg"   id="select-country" data-live-search="true"  name="account_id">
<?php include("optgroup_element.php"); ?>
</select>
<!--
									<input type="submit" class="btn btn-primary" name="" value="کھاتہ تفصیل درج شدہ پارٹی">
								</label>
								<label >Accounnt head:<select class=" smallInputBox " type="text" name="account_head">
									<?php populateDD("accounttype","accountdescription","accounttypeid") ?>
									</select></label>
								<label >Area:<select class=" smallInputBox " type="text" name="area_id">
									<?php populateDD("arealist","areaname","areaid") ?>
									</select></label>
								<br/>
								<br/>
								<input type="submit" formtarget="_new"  formtarget="_new" formaction="reports/0summaryreport.php" class="btn btn-primary form-control" name="" value="  شارٹ بیلنس سمری 0">
								<br/>
								<br/>
								<input type="submit"  formtarget="_new" formaction="reports/short-balance-summary.php" class="btn btn-secondary form-control" name="" value="شارٹ سمری ">
								<br/>
								<br/>
								<input type="submit"  class="btn btn-success form-control" name="" value="ڈیلی سیل رپورٹ">
								<br/>
								<br/>
								<input type="submit"  formtarget="_new" formaction="reports/sale-mukamal.php" class="btn btn-warning form-control" name="" value=" سیل مکمل">
								<br/>
								<br/>
								<input type="submit"  formtarget="_new" formaction="reports/daily-balance-summary.php"class="btn btn-info form-control" name="" value="  ڈیلی بیلنس سمری">
								<br/>
								<br/>
								<input type="submit" formtarget="_new" formaction="reports/daily-account-entry.php" class="btn-basic form-control" name="" value=" ڈیلی اکاؤنٹ انٹری ">
								<br/>
								<br/>
								<input type="submit"  formtarget="_new" formaction="reports/daily-balance-report.php" class="btn-default form-control" name="" value="  ڈیلی بیلنس رپورٹ">
								<br/>
								<br/>
								<input type="submit" formtarget="_new" formaction="reports/select-balance-report.php" class="btn btn-success form-control" name="" value=" سلیکٹ بیلنس رپورٹ">
								<br/>
								<br/>
								<input type="submit"  formtarget="_new" formaction="reports/dukandar-list.php" class="btn btn-warning form-control" name="" value="  دکاندار لسٹ">
								<br/>
								<br/>
								<input type="submit" formtarget="_new" formaction="reports/phone-number-list.php" class="btn btn-danger form-control" name="" value="  فون نمبر لسٹ">
							</div>	
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="border text-center ">
								<div class="button-group">
									<input type="submit"  class="btn btn-primary btn-group-lg btn-lg" name="" value="کمیٹی کھاتہ">
									<input type="submit"  formtarget="_new" formaction="reports/comitti-tafseel.php" class="btn btn-secondary btn-group-lg btn-lg" name="" value="کمیٹی تفصیل  ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit"  formtarget="_new" formaction="reports/cometi-report.php" class="btn btn-warning btn-group-lg btn-lg" name="" value="کمیٹی رپورٹ ">
									<input type="submit"  formtarget="_new" formaction="reports/rate-aur-cometi-list.php" class="btn btn-default btn-group-lg btn-lg" name="" value=" ریٹ اور کمیٹی لسٹ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit"  formtarget="_new" formaction="reports/wazan-total-dukandar.php" class="btn btn-danger btn-group-lg btn-lg" name="" value="وزن ٹوٹل دکاندار ">
									<input type="submit" class="btn btn-success btn-group-lg btn-lg" name="" value=" ماہانہ کمیٹی ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit"  formtarget="_new" formaction="reports/wazan-report-driver.php" class="btn btn-info btn-group-lg btn-lg" name="" value="وزن رپورٹ ڈرائیور ">
									<input type="submit"  formtarget="_new" formaction="reports/total-khareed-report.php" class="btn btn-basic btn-group-lg btn-lg" name="" value="ٹوٹل خرید رپورٹ">
								</div>
								<br/>
								<br/>
								<div class="button-group">
									<input type="submit"  formtarget="_new" formaction="reports/sale-report.php" class="btn btn-warning btn-group-lg btn-lg" name="" value="سیل ">
									<input type="submit"  formtarget="_new" formaction="reports/0-sale.php" class="btn btn-success btn-group-lg btn-lg" name="" value="سیل 0 ">
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>		
		</div>			
	</div> -->
</div>
</form>
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