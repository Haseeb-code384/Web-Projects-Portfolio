<?php

include "allFunctions.php";
include "start.php";
include "config.php";

$user = $_SESSION[ 'email' ];
$id = $_REQUEST[ 'id' ];
$sql_deposit = "SELECT * FROM `order_courier_bill_receivings` WHERE id='$id'";
$query_deposit = mysqli_query( $con, $sql_deposit );
$row_deposit = mysqli_fetch_array( $query_deposit );
echo "<h1 align='center'>Courier Payment Receiving $id </h1>";
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $tracking_id = $_REQUEST[ 'tracking_id' ];
  executeQuery( "INSERT INTO `order_payment_cart`(`id`, `order_id`, `tracking_id`, `user`, `time`) (SELECT null,order_id,tracking_id,'$user','$currentDateTime' FROM order_dispatch_info_history WHERE tracking_id='$tracking_id')" );
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
<body onLoad="calculate_grand_total('.order_amount','total_order_amount');calculate_grand_total('.courier_cost','total_courier_cost');calculate_grand_total('.package_weight','total_package_weight');calculate_grand_total('.customer_feedback','customer_feedback');">
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
  <form method="post" onSubmit="return confirm('Are You Sure To Edit This Data? This Change Will Be Permanent');">
    </div>
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <!--          <input placeholder="Lifeline Order ID" type="text" class="form-control" name="order_id" >-->
    
    <datalist id="tracking_id">
      <?php populateDDsel("order_dispatch_info_history","tracking_id","tracking_id","") ?>
    </datalist>
    <?php include("fix_header.php"); ?>
      <th>Del</th>
        <th>Order ID</th>
        <th>Tracking ID</th>
        <th>Order Date</th>
        <th>Receiver Name</th>
        <th>Courier Company</th>
        <th>Consultency Fee</th>
        <th>COD Amount</th>
        <th>Freight Charges</th>
        <th>Parcel Weight</th>
        <th>Payment Status</th>
        <th>Parcel Status</th>
      </tr>
      </thead>
      
      <tbody>
        <?php
        $sql_orders="SELECT DISTINCT order_id FROM `order_dispatch_info_history` WHERE payment_receiving_id='$id' ";
                
                $query_orders=mysqli_query($con,$sql_orders);
                while($row_orders=mysqli_fetch_array($query_orders))
                {
    $sql_view = "SELECT * FROM `order_dispatch_info_history` WHERE payment_receiving_id='$id' AND order_id='$row_orders[0]'  
ORDER BY `order_dispatch_info_history`.`entered_at`  DESC LIMIT 1 ";
        //                           echo $sql_view;
        $query_view = mysqli_query( $con, $sql_view );
        $i = 0;
        while ( $row_view = mysqli_fetch_array( $query_view ) ) {
          ?>
        <tr  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_view[status]'"); ?> !important;">
          <td><?php echo $i+1; ?> 
            <!--                <a href="del.php?delete_order_payment_cart=<?php echo $row_view['id']; ?>" onClick="return confirm('Do You Want To Remove?')" class="fa fa-trash text-danger"></a>--></td>
          <td><?php echo $row_view['order_id']; ?>
            <input type="hidden" value="<?php echo $row_view['order_id']; ?>" name="order_id[]" readonly class="myinput text-center">
            <i title="More"  onClick="window.open('order_details.php?id=<?php echo $row_view['order_id']; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i></td>
          <td><?php echo $row_view['tracking_id']; ?></td> 
            <td><?php echo change_date_ddmmyyy(showQuery("SELECT order_date FROM `order_dispatch_info` WHERE order_id='$row_view[order_id]'")); ?></td>    <td><?php echo showQuery("SELECT receiver_name FROM `order_dispatch_info` WHERE order_id='$row_view[order_id]'"); ?></td>
          <td><?php echo $row_view['courier_company']; ?></td>
          <td><input type="number" step="0.01" name="customer_feedback[]" value="<?php echo $row_view['customer_feedback']; ?>" class="text-center myinput customer_feedback" onKeyUp="calculate_grand_total('.customer_feedback','customer_feedback');"></td>
          <td><input type="text" name="order_amount[]" value="<?php echo $row_view['order_amount']; ?>" class="text-center myinput order_amount" onKeyUp="calculate_grand_total('.order_amount','total_order_amount');"></td>
          <td><input name="courier_cost[]" onKeyUp="calculate_grand_total('.courier_cost','total_courier_cost');" type="text" value="<?php echo $row_view['courier_cost']; ?>" class="text-center myinput courier_cost"></td>
          <td><input name="package_weight[]" onKeyUp="calculate_grand_total('.package_weight','total_package_weight');" type="text" value="<?php echo $row_view['package_weight']; ?>" class="text-center myinput package_weight"></td>
          <td><select name="status[]" required class="form-control">
              <?php
              order_status_payment_dd( $row_view[ 'payment_status' ], false );
              ?>
            </select></td>
          <td><select name="d_status[]" required class="form-control">
              <?php
              order_status_dd( $row_view[ 'status' ], false );
              ?>
            </select></td>
        </tr>
        <?php $i++; } } ?>
      </tbody>
      <?php
      //  $sql_view = "SELECT * FROM order_dispatch_info_history,order_payment_cart WHERE order_dispatch_info_history.order_id=order_payment_cart.order_id AND order_payment_cart.user='$user'  ORDER BY `order_payment_cart`.`time`  ASC";
      //          $sql_view = "SELECT * FROM order_dispatch_info_history WHERE order_dispatch_info_history.payment_receiving_id='1';";
      //                    echo $sql_view;
      // $query_view = mysqli_query( $con, $sql_view );
      //          $i = 0;
      while ( false ) {
        ?>
      <tr>
        <td><?php echo $i+1; ?> <a href="del.php?delete_order_payment_cart=<?php echo $row_view['id']; ?>" onClick="return confirm('Do You Want To Remove?')" class="fa fa-trash text-danger"></a></td>
        <td><?php echo $row_view['order_id']; ?>
          <input type="hidden" value="<?php echo $row_view['order_id']; ?>" name="order_id[]" readonly class="myinput text-center">
          <i title="More"  onClick="window.open('order_details.php?id=<?php echo $row_view['order_id']; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i></td>
        <td><?php echo $row_view['tracking_id']; ?></td>
        <td><?php echo change_date_ddmmyyy(showQuery("SELECT order_date FROM `order_dispatch_info` WHERE order_id='$row_view[order_id]'")); ?></td>
        <td><?php echo $row_view['receiver_name']; ?></td>
        <td><?php echo $row_view['courier_company']; ?></td>
        <td><input type="number" step="0.01" name="customer_feedback[]" value="<?php echo $row_view['customer_feedback']; ?>" class="text-center myinput customer_feedback" onKeyUp="calculate_grand_total('.customer_feedback','customer_feedback');"></td>
        <td><input type="number"  step="0.01"  name="order_amount[]" value="<?php echo $row_view['order_amount']; ?>" class="text-center myinput order_amount" onKeyUp="calculate_grand_total('.order_amount','total_order_amount');"></td>
        <td><input name="courier_cost[]" onKeyUp="calculate_grand_total('.courier_cost','total_courier_cost');" type="number"   step="0.01" value="<?php echo $row_view['courier_cost']; ?>" class="text-center myinput courier_cost"></td>
        <td><input name="package_weight[]" onKeyUp="calculate_grand_total('.package_weight','total_package_weight');" type="number"  step="0.01" value="<?php echo $row_view['package_weight']; ?>" class="text-center myinput package_weight"></td>
        <td><select name="status[]" required class="form-control">
            <?php
            order_status_payment_dd( $row_view[ 'status' ], false );
            ?>
          </select></td>
        <td><select name="d_status[]" required class="form-control">
            <?php
            order_status_dd( $row_view[ 'status' ], false );
            ?>
          </select></td>
      </tr>
      <?php $i++; } ?>
      </tbody>
      
      <tr class="h6">
        <th colspan="6" ><?php echo $i; ?> Parcels</th>
        <th  > <span id="customer_feedback"> <?php echo showQuery("SELECT sum(customer_feedback) FROM order_dispatch_info_history,order_payment_cart WHERE  order_dispatch_info_history.order_id=order_payment_cart.order_id AND order_payment_cart.user='$user' ") ?> </span> </th>
        <th  > <span id="total_order_amount"> <?php echo showQuery("SELECT sum(order_amount) FROM order_dispatch_info_history,order_payment_cart WHERE  order_dispatch_info_history.order_id=order_payment_cart.order_id AND order_payment_cart.user='$user' ") ?> </span> </th>
        <th> <span id="total_courier_cost"><?php echo showQuery("SELECT sum(courier_cost) FROM order_dispatch_info_history,order_payment_cart WHERE  order_dispatch_info_history.order_id=order_payment_cart.order_id AND order_payment_cart.user='$user' ") ?> </span> </th>
        <th  ><span id="total_package_weight"><?php echo showQuery("SELECT sum(package_weight) FROM order_dispatch_info_history,order_payment_cart WHERE  order_dispatch_info_history.order_id=order_payment_cart.order_id AND order_payment_cart.user='$user' ") ?></span></th>
      </tr>
    </table>
    <div class="row">
      <div class="col-sm-2">
        <label>Fuel Adjustment</label>
        <input type="text" name="fuel_adjustment" class="form-control" value="<?php echo $row_deposit['fuel_adjustment'] ?>" >
      </div>
      <div class="col-sm-2">
        <label>Fuel Surcharge</label>
        <input type="text" name="fuel_surcharge" class="form-control"  value="<?php echo $row_deposit['fuel_surcharge'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Fuel Factor</label>
        <input type="text" name="fuel_factor" class="form-control" value="<?php echo $row_deposit['fuel_factor'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Gst Amount</label>
        <input type="text" name="gst_amount" class="form-control" value="<?php echo $row_deposit['gst_amount'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Hnd Oth Charges</label>
        <input type="text" name="hnd_oth_charges" class="form-control" value="<?php echo $row_deposit['hnd_oth_charges'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Price Adjustment</label>
        <input type="text" name="price_adjustment" class="form-control" value="<?php echo $row_deposit['price_adjustment'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Cmi Charges</label>
        <input type="text" name="cmi_charges" class="form-control" value="<?php echo $row_deposit['cmi_charges'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Insurance Charges</label>
        <input type="text" name="insurance_charges" class="form-control" value="<?php echo $row_deposit['insurance_charges'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Discount</label>
        <input type="text" name="discount" class="form-control" value="<?php echo $row_deposit['discount'] ?>">
      </div>
      <div class="col-sm-2">
        <label>Other Charges</label>
        <input type="text" name="other_charges" class="form-control" value="<?php echo $row_deposit['other_charges'] ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label><strong>Courier Company</strong></label>
        <select class="form-control" name="courier_company" required>
          <?php populateDDsel("`courier_company` WHERE active=1","company_account_name","company_account_name",$row_deposit['courier_company']) ?>
        </select>
      </div>
      <div class="col-sm-2">
        <label><strong>Bill No / Remarks</strong></label>
        <input type="text" name="payment_inv_no" class="form-control" value="<?php echo $row_deposit['payment_inv_no'] ?>">
      </div>
      <!--
      <div class="col-sm-2">
        <label><strong>Bill Date</strong></label>
        <input type="date" name="payment_receiving_id" required class="form-control" value="<?php echo $row_deposit['payment_receiving_id'] ?>">
      </div>
-->
      <div class="col-sm-2">
        <label><strong>Cheque Number</strong></label>
        <input type="text" name="cheque_number" class="form-control" required value="<?php echo $row_deposit['cheque_number'] ?>">
      </div>
      <div class="col-sm-2">
        <label><strong>Cash / Cheque Amount (Physically Written on Cheque)</strong></label>
        <input type="number" step="0.01" name="cheque_amount" class="form-control" required value="<?php echo $row_deposit['cheque_amount'] ?>">
      </div>
      <div class="col-sm-2">
        <label><strong>Cheque Date</strong></label>
        <input type="date" name="cheque_date" class="form-control" required value="<?php echo $row_deposit['cheque_date'] ?>">
      </div>
    </div>
    <input type="submit" class="btn btn-success col-sm-6" value="Update" formaction="process_courier_payment_receiving_edit.php">
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