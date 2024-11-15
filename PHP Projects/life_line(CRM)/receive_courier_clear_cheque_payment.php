<?php

include "allFunctions.php";
include "start.php";
include "config.php";

$user = $_SESSION[ 'email' ];
$id = $_REQUEST[ 'id' ];
$sql_deposit = "SELECT * FROM `order_courier_bill_receivings` WHERE id='$id'";
$query_deposit = mysqli_query( $con, $sql_deposit );
$row_deposit = mysqli_fetch_array( $query_deposit );
echo "<h1 align='center'>Courier Payment Clearance $id </h1>";
if ( isset( $_REQUEST[ 'submit' ] ) ) 
{
    $id=$_REQUEST['id'];
    $clearance_date=$_REQUEST['clearance_date'];
    $credit_account=$_REQUEST['credit_account'];
    $debit_account=$_REQUEST['debit_account'];
    $cleared_by=$_REQUEST['cleared_by'];
    $cleared_at=$_REQUEST['cleared_at'];
    $cheque_number=$_REQUEST['cheque_number'];
    $cheque_amount=$_REQUEST['cheque_amount'];
    $courier_company=$_REQUEST['courier_company'];
    
 executeQuery("UPDATE `order_courier_bill_receivings`  SET cheque_payment='Cleared at $cleared_at',cleared_by='$cleared_by', cleared_at='$clearance_date' WHERE id='$id'");
    
      $sql_voucher="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$clearance_date', 'Automated Voucher For Clearance Receiving id $id', 'CPV', '$cheque_amount', '$cheque_amount', '$currentDateTime')";
            $query_voucher=mysqli_query($con,$sql_voucher);
            $voucher_id=mysqli_insert_id($con);
    
           echo executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$debit_account', '$clearance_date', '$cheque_amount', '', 'Automated Clearance of Receiving# $id $courier_company ($cheque_number)', '$voucher_id', '$cleared_by', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");
        
    echo executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$credit_account', '$clearance_date', '$cheque_amount', '', 'Automated Clearance of Receiving# $id $courier_company ($cheque_number)', '$voucher_id', '$cleared_by', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
    alertredirect("$id Cleared Successfully","receiver_courier_payment_list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<script>
     function calculate_grand_total(inp,outp)
    {
         const subtotalElements = document.querySelectorAll(inp);

// Loop through each element and alert its inner HTML
        var sum=0;
subtotalElements.forEach(element => {
  var subtotalHTML = parseFloat(element.value);
    sum=sum+subtotalHTML;
});
        document.getElementById(outp).innerHTML=sum.toFixed(2);
    }
    </script>
<style>
.myinput {
    width: 80px;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
</head>
<body onLoad="">
<div class="content-wrapper" >
  <div class="container-fluid" >
  <?php //include("courier_receiving_payment_tabs.php"); ?>
  <!--
  <form method="post">
    <div class="row">
    <div class="col-sm-9">
      <input name="tracking_id" type="text" autofocus="autofocus"  class="form-control" placeholder="Tracking ID" list="tracking_id" pattern="[^\s]+" required autocomplete="off"  >
    </div>
    <div class="col-sm-3">
      <input class="btn btn-success col-sm-12" type="submit" name="submit" value="Add">
    </div>
  </form>
-->
  <form method="post" onSubmit="return confirm('Are You Sure To Clear This Payment? This Change Will Be Permanent');">
    </div>
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <!--          <input placeholder="Lifeline Order ID" type="text" class="form-control" name="order_id" >-->
    
    <div class="row">
      <div class="col-sm-2">
        <label>Cheque Number</label>
        <input type="text" name="cheque_number" readonly class="form-control" value="<?php echo $row_deposit['cheque_number'] ?>" >
      </div>
      <div class="col-sm-2">
        <label>Payment Amount</label>
        <input type="text" name="cheque_amount" readonly  class="form-control"  value="<?php echo $row_deposit['cheque_amount'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Payment Date</label>
        <input type="text" name="cheque_date" readonly  class="form-control" value="<?php echo $row_deposit['cheque_date'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Courier Company</label>
        <input type="text" name="courier_company" readonly  class="form-control" value="<?php echo $row_deposit['courier_company'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Clearance Status</label>
        <input type="text" name="cheque_payment" readonly  class="form-control" value="<?php echo $row_deposit['cheque_payment'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Cleared At</label>
        <input type="text" name="cleared_at" readonly  class="form-control" value="<?php echo $currentDateTime ?>">
      </div>
<!--
      <div class="col-sm-2">
        <label>Cleared By</label>
-->
        <input type="hidden" name="cleared_by" readonly  class="form-control" value="<?php echo $_SESSION['email'] ?>">
<!--      </div>-->
      <div class="col-sm-2">
        <label>Clearance Date</label>
        <input type="date" name="clearance_date"   class="form-control" value="<?php echo $date ?>">
      </div>
      <div class="col-sm-2">
        <label>Credit Account</label>
        <select name="credit_account" required class="form-control" >
          <option value="<?php echo showQuery("SELECT cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'"); ?>"><?php echo get_ledger_name_by_id( showQuery("SELECT cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'")); ?></option>
        </select>
      </div>
      <div class="col-sm-2">
        <label>Debit Account</label>
        <select name="debit_account" required class="form-control" >
          <!--            <option value="<?php echo showQuery("SELECT cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'"); ?>"><?php echo get_ledger_name_by_id( showQuery("SELECT cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'")); ?></option>-->
          
          <?php
          //                $selected_account=showQuery("SELECT payment_clearance_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'");
          //                include("optgroup_element.php"); 

          ?>
          <option value="<?php echo showQuery("SELECT payment_clearance_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'"); ?>"><?php echo get_ledger_name_by_id( showQuery("SELECT payment_clearance_ledger FROM `courier_company` WHERE company_account_name='$row_deposit[courier_company]'")); ?></option>
        </select>
        </select>
      </div>
    </div>
    <input type="submit" name="submit" class="btn btn-success col-sm-" value="Clear Now" >
  </form>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
</body>
</html>