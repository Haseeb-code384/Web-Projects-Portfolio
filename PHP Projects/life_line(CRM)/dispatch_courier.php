<?php

include "allFunctions.php";
include "start.php";

include "preloader.php";
include "config.php";

$user = $_SESSION[ 'email' ];
if ( isset( $_REQUEST[ 'submit' ] ) ) {


  $tracking_id = $_REQUEST[ 'tracking_id' ];

  executeQuery( "INSERT INTO `order_dispatch_cart`(`id`, `order_id`, `tracking_id`, `user`, `time`) (SELECT null,order_id,tracking_id,'$user','$currentDateTime' FROM order_dispatch_info WHERE tracking_id='$tracking_id' )" );
}
if ( isset( $_REQUEST[ 'submit_order' ] ) ) {

  $order_id = $_REQUEST[ 'order_id' ];
        $dispatch_id=showQuery("SELECT dispatch_id FROM `order_dispatch_info` WHERE order_id=$order_id;" ); 
 if ($dispatch_id=="")
      {
  executeQuery( "INSERT INTO `order_dispatch_cart`(`id`, `order_id`, `tracking_id`, `user`, `time`) (SELECT null,order_id,tracking_id,'$user','$currentDateTime' FROM order_dispatch_info WHERE order_id IN ($order_id) )" );
       }   else
      {
          
    alertredirect( "Error!!! $order_id Already Present In $dispatch_id", "dispatch_courier.php" );
      }
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
<body>
<div class="content-wrapper" >
  <div class="container-fluid" >
    <?php include("courier_dispatch_tabs.php"); ?>
    <div class="row">
      <form method="post" class="col-sm-6">
        <div class="col-sm-12">
          <input name="tracking_id" type="text" autofocus="autofocus"  class="form-control" placeholder="Tracking ID" list="tracking_id" pattern="[^\s]+" required  autocomplete="off"  >
          <input class="btn btn-success col-sm-12" type="submit" name="submit" value="Add Tracking ID">
        </div>
      </form>
      <form method="post" class="col-sm-6">
        <div class="col-sm-12">
          <input required placeholder="Lifeline Order ID" type="text" class="form-control" name="order_id" list="o_id" >
          <input class="btn btn-success col-sm-12" type="submit" name="submit_order" value="Add Order ID">
        </div>
      </form>
    </div>
    <form method="post">
      <datalist id="tracking_id">
        <?php populateDDsel("order_dispatch_info","tracking_id","tracking_id","") ?>
      </datalist>
      <datalist id="o_id">
        <?php populateDDsel("order_dispatch_info","order_id","order_id","") ?>
      </datalist>
      <?php include("fix_header.php"); ?>
          <th>Del</th>
            <th>Order ID</th>
            <th>Tracking ID</th>
            <th>Order Date</th>
            <th>Receiver Name</th>
            <th>Inquiry ID</th>
            <th>Patient ID</th>
            <th>Courier Company</th>
            <th>Consultency Fee</th>
            <th>COD Amount</th>
            <th>Freight Charges</th>
            <th>Parcel Weight</th>
            <!--            <th>Payment Status</th>-->
            <th>Parcel Status</th>
          </tr>
          </thead>
          
          <tbody>
            <?php
            $sql_view = "SELECT * FROM order_dispatch_info,order_dispatch_cart WHERE order_dispatch_info.order_id=order_dispatch_cart.order_id AND order_dispatch_cart.user='$user'  
ORDER BY `order_dispatch_cart`.`time`  ASC";
            //                      echo $sql_view;
            $query_view = mysqli_query( $con, $sql_view );
            $i = 0;
            while ( $row_view = mysqli_fetch_array( $query_view ) ) {
              ?>
            <tr  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_view[payment_status]'"); ?> !important;">
              <td><?php echo $i+1; ?> <a href="del.php?delete_order_dispatch_cart=<?php echo $row_view['id']; ?>" onClick="return confirm('Do You Want To Remove?')" class="fa fa-trash text-danger"></a></td>
              <td><?php echo $row_view['order_id']; ?>
                <input type="hidden" value="<?php echo $row_view['order_id']; ?>" name="order_id[]" readonly class="myinput text-center">
                <br>
                <i title="More"  onClick="window.open('order_details.php?id=<?php echo $row_view['order_id']; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <i title="Status History" onClick="window.open('order_status_history.php?id=<?php echo $rowview['order_id']; ?>','height=200','width=200');" class="fa fa-history text-primary"></i></td>
              <td><?php echo $row_view['tracking_id']; ?></td>
              <td><?php echo change_date_ddmmyyy($row_view['order_date']); ?></td>
              <td><?php echo $row_view['receiver_name']; ?></td>
              <td><?php echo $row_view['order_patient_id']; ?></td>
              <td><?php echo showQuery("SELECT patient_id FROM `inquiry` WHERE id='$row_view[order_patient_id]'"); ?></td>
              <td><?php echo $row_view['courier_company']; ?></td>
              <td><input type="number" step="0.01" name="customer_feedback[]" value="<?php echo $row_view['customer_feedback']; ?>" class="text-center myinput customer_feedback" onKeyUp="calculate_grand_total('.customer_feedback','customer_feedback');"></td>
              <td><input type="number" step="0.01" name="order_amount[]" value="<?php echo $row_view['order_amount']; ?>" class="text-center myinput order_amount" onKeyUp="calculate_grand_total('.order_amount','total_order_amount');"></td>
              <td><input name="courier_cost[]" step="0.01" onKeyUp="calculate_grand_total('.courier_cost','total_courier_cost');" type="number" value="<?php echo $row_view['courier_cost']; ?>" class="text-center myinput courier_cost"></td>
              <td><input name="package_weight[]" onKeyUp="calculate_grand_total('.package_weight','total_package_weight');" type="number" step="0.01" value="<?php echo $row_view['package_weight']; ?>" class="text-center myinput package_weight"></td>
              <!--
              <td>
                  <select name="status[]" required class="form-control">
                  <?php
                  order_status_payment_dd( $row_view[ 'payment_status' ], false );
                  ?>
                </select></td>
-->
              
              <td><select name="d_status[]" required class="form-control">
                  <option value=""><?php echo $row_view[ 'status' ]; ?></option>
                  <option>Dispatched</option>
                  <?php
                  //                order_status_dd( $row_view[ 'status' ], false );
                  ?>
                </select></td>
            </tr>
            <?php $i++; } ?>
            <tr class="h6" align="center">
              <th align="left" colspan="8" ><?php echo $i; ?> Parcels</th>
              <th  > <span id="customer_feedback"> <?php echo showQuery("SELECT sum(customer_feedback) FROM order_dispatch_info,order_dispatch_cart WHERE  order_dispatch_info.order_id=order_dispatch_cart.order_id AND order_dispatch_cart.user='$user' ") ?> </span> </th>
              <th  > <span id="total_order_amount"> <?php echo showQuery("SELECT sum(order_amount) FROM order_dispatch_info,order_dispatch_cart WHERE  order_dispatch_info.order_id=order_dispatch_cart.order_id AND order_dispatch_cart.user='$user' ") ?> </span> </th>
              <th> <span id="total_courier_cost"><?php echo showQuery("SELECT sum(courier_cost) FROM order_dispatch_info,order_dispatch_cart WHERE  order_dispatch_info.order_id=order_dispatch_cart.order_id AND order_dispatch_cart.user='$user' ") ?> </span> </th>
              <th><span id="total_package_weight"><?php echo showQuery("SELECT sum(package_weight) FROM order_dispatch_info,order_dispatch_cart WHERE  order_dispatch_info.order_id=order_dispatch_cart.order_id AND order_dispatch_cart.user='$user' ") ?></span></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label><strong>Courier Company</strong></label>
          <select class="form-control" name="courier_company" required>
             <?php populateDDsel("`courier_company` WHERE company_account_name IN(SELECT DISTINCT courier_company FROM `order_dispatch_info` WHERE order_id IN (SELECT order_id FROM `order_dispatch_cart` WHERE user='$_SESSION[email]'))","company_account_name","company_account_name","") ?>
          </select>
        </div>
        <div class="col-sm-6">
          <label><strong>Dispatch Date</strong></label>
          <input type="date" name="cheque_date" class="form-control" required>
        </div>
      </div>
      <input type="submit" class="btn btn-primary col-sm-6" formaction="process_courier_dispatch.php">
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