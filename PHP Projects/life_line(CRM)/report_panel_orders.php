<?php 
include('allFunctions.php');
?>
<!DOCTYPE html>
<html>
<?php include("preloader.php"); ?>
	<?php 
include "start.php";?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 border">
				<div class="col-sm-12 text-center">
					<h1>Reporting Panel</h1>
				</div>
				<form target="new" method="get">
				<div class="row">
					<div class="col-lg-12" >
						<div class="form-group">
							<div class="border text-center">
				
								<label>From<input class="form-control" required type="date" name="date_start" value="<?php echo date("Y-m-01") ?>"></label>
								<label>To<input class="form-control" required type="date" name="date_end" value="<?php echo date("Y-m-d") ?>"></label>
                                <br>
                                <input type="submit" formtarget="_new"  class="btn btn-primary" formaction="reports/orders_report.php" value="Get Detailed Report">
                                <input type="submit"  formtarget="_new"  class="btn btn-success" formaction="reports/summary_orders_report.php" value="Get Summary Report">
                               
                                    <?php
                                if(check_accounts_access($_SESSION['email']))
                                {
                                ?>
                                <input type="submit"  formtarget="_new"  class="btn btn-info" formaction="reports/orders_payment_report.php" value="Get Payment Detail Report"><br>
                                <input id="detail" type="checkbox" name="show_detailed_payment" value="show">
                                <label for="detail">Include Detailed Payments</label>
                                <?php } ?>
                                 <input id="mistaken" type="checkbox" name="show_mistaken" value="show">
                                <label for="mistaken">Include Mistaken</label>
                                <br>
                                
                                <br>
                                  <label class="">Delivery Status</labe>
                                    <select   class="form-control" type="text" name="delivery_status">
									<?php 
                                        if(check_accounts_access($_SESSION['email']))
                                        {
                                               order_status_dd_accounts("",true);
                                        }
                                        else
                                        {
                                            order_status_dd("",true);
                                           
                                        }
  
    //populateDDsel("order_status  WHERE sort>20 ORDER BY `order_status`.`sort` ASC ","order_status","order_status","") ?>
									</select>                             
                                <br>
                                  <label class="">Courier Company</labe>
                                    <select   class="form-control" type="text" name="courier_company">
									<?php populateDDsel("courier_company WHERE active='1'","company_account_name","company_account_name","") ?>
									</select>
								<br/>
                                <?php
    include("admin_selective_user_dropdown.php");
                                ?>
									<!--
									
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
	</div></form>
                        <br>
                        <br>
                        <br>
                        <br>
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