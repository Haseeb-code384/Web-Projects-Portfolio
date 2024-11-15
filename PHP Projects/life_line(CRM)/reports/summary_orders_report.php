<?php
include( "../config.php" );
include( "../allFunctions.php" );
$date_start = $_REQUEST[ 'date_start' ];
$date_end = $_REQUEST[ 'date_end' ];
$seller = $_REQUEST[ 'seller' ];
$seller_sql = "";
$delivery_sql = "";
$courier_company_sql = "";

$mistaken = "";

if ( $_REQUEST[ 'show_mistaken' ] == "show" ) {
  $mistaken = " ";
} else {
  $mistaken = " AND status!='Mistaken' ";
}


if ( $_REQUEST[ 'delivery_status' ] != "" ) {
  $delivery_status = $_REQUEST[ 'delivery_status' ];
  if ( exists_in_db( "SELECT * FROM `order_status` WHERE parent IN('$delivery_status')" ) ) {
    $delivery_sql = "AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$delivery_status'))";

  } else {

    $delivery_sql = "AND status='$delivery_status'";
  }
}


if ( $_REQUEST[ 'courier_company' ] != "" ) {
  $courier_company = $_REQUEST[ 'courier_company' ];
  $courier_company_sql = "AND courier_company='$courier_company'";
}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
.special_column th {
    font-family: Jameel Noori Nastaleeq Regular;
    font-weight: bolder;
    font-size: 150%;
}
.vl {
    border-left: 3px solid red;
    height: 40px;
}
.special_border {
    height: 35px;
}
.class_bold td {
    text-align: right;
    width: 60%;
    margin-left: 34%;
}
tr td span {
    column-span: all;
}
</style>
</head>
<body>
<table style="margin-left: 10%;">
<tbody>
  <tr>
    <td><h3> <b>Order Summary Report </b><br>
        <?php
        if ( $_REQUEST[ 'seller' ] != "" ) {
          $seller_sql = "AND seller='$seller'";
          ?>
        <b> (<?php echo $seller.") "; echo showQuery("SELECT name FROM `user` WHERE email='$seller'"); ?></b><br>
        <?php
        }
        ?>
      </h3></td>
    </td>
    <td></td>
    <td><?php include ('logo.php');?>
<br>
</td>
<td></td>
</tr>
<tr>
  <td><strong>FROM :</strong><?php echo change_date_ddmmyyy( $date_start); ?></td>
  <td></td>
  <td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;">.</td>
  <td></td>
  <td><strong>To :</strong><?php echo change_date_ddmmyyy($date_end); ?></td>
</tr>
<tr>
  <td><hr style="width: 450%; border: 1px solid black"></td>
</tr>
<tr>
  <td></td>
</tr>
</table>
<center>
  <h3>Bird Eye Report</h3>
</center>
<table  style=" width: 100%;" border="1">
  <tr align="center">
    <th>Seller</th>
    <?php
    $sql_order_parents = "SELECT DISTINCT parent FROM `order_status` WHERE parent!='Preorder'";
    $query_order_parents = mysqli_query( $con, $sql_order_parents );
    while ( $row_order_parents = mysqli_fetch_array( $query_order_parents ) ) {
      ?>
    <th><?php echo $row_order_parents[0]; ?> Orders</th>
    <th><?php echo $row_order_parents[0]; ?> Amount</th>
    <?php
    }
    ?>
    <th  style="background-color: gray;">Total Order Count</th>
    <th>Advance Paid</th>
    <th>Order Amount
      </th>
    <th>Courier Cost</th>
    <th>Weight</th>
  </tr>
  <?php

  $sql_view = "SELECT seller,count(order_id),SUM(advance_paid),SUM(order_amount),sum(total_service_charges),sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken   GROUP BY seller";
  //echo $sql_view;
  $query = mysqli_query( $con, $sql_view );
  $sum1 = 0;
  $pre_seller = "";
  $pre_color = rand_color();
  $total_order = 0;
  while ( $row = mysqli_fetch_array( $query ) ) {
    if ( $pre_seller != $row[ 0 ] ) {
      $pre_seller = $row[ 0 ];
      $pre_color = rand_color();
    }
    ?>
  <tr style="background-color: <?php echo $pre_color; ?>"  align="center">
    <td   ><?php echo $row[0]."  "; echo showQuery("SELECT name FROM `user` WHERE email='$row[0]'"); ?></td>
    <?php

    $query_order_parents = mysqli_query( $con, $sql_order_parents );
    while ( $row_order_parents = mysqli_fetch_array( $query_order_parents ) ) {
      ?>
    <th><?php echo showQuery("SELECT count(*) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' AND seller='$row[0]' AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]'))  $courier_company_sql  $mistaken"); ; ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' AND seller='$row[0]' AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $courier_company_sql  $mistaken"); ; ?></th>
    <?php
    }
    ?>
    <td style="background-color: gray;"><?php echo $row[1];?></td>
    <td><?php echo $row[2];?></td>
    <td ><?php echo $row[3]; $total_order=$total_order+$row[1]; ?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $row[5];?></td>
  </tr>
  <?php  } ?>
  <tr bgcolor="grey">
    <th>Total Orders</th>
    <?php

    $query_order_parents = mysqli_query( $con, $sql_order_parents );
    while ( $row_order_parents = mysqli_fetch_array( $query_order_parents ) ) {
      ?>
    <th><?php echo showQuery("SELECT count(*) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?>
      </th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?></th>
    <?php
    }
    ?>
    <th><strong><?php echo $total_order; ?></strong></th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?></th>
    <th><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?></th>
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end'  AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$row_order_parents[0]')) $seller_sql $delivery_sql $courier_company_sql  $mistaken");  ?></th>
  </tr>
</table>
<center>
  <h3>Over All Report</h3>
</center>
<table  style=" width: 100%;" border="1">
  <tr align="center">
    <th>Seller</th>
    <th  style="background-color: gray;">Order Count</th>
    <th>Advance Paid</th>
    <th>Order Amount
      <o/th>
    <th>Courier Cost</th>
    <th>Weight</th>
  </tr>
  <?php

  $sql_view = "SELECT seller,count(order_id),SUM(advance_paid),SUM(order_amount),sum(total_service_charges),sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken   GROUP BY seller";
  //echo $sql_view;
  $query = mysqli_query( $con, $sql_view );
  $sum1 = 0;
  $pre_seller = "";
  $pre_color = rand_color();
  $total_order = 0;
  while ( $row = mysqli_fetch_array( $query ) ) {
    if ( $pre_seller != $row[ 0 ] ) {
      $pre_seller = $row[ 0 ];
      $pre_color = rand_color();
    }
    ?>
  <tr style="background-color: <?php echo $pre_color; ?>"  align="center">
    <td   ><?php echo $row[0]." "; echo showQuery("SELECT name FROM `user` WHERE email='$row[0]'"); ?></td>
    <td style="background-color: gray;"><?php echo $row[1];?></td>
    <td><?php echo $row[2];?></td>
    <td ><?php echo $row[3]; $total_order=$total_order+$row[1]; ?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $row[5];?></td>
  </tr>
  <?php  } ?>
  <tr bgcolor="grey">
    <th>Total Orders</th>
    <th><strong><?php echo $total_order; ?></strong></th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ")   ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
  </tr>
</table>
<br>
<br>
<center>
  <h3>Seller Wise Status Report</h3>
</center>
<table  style=" width: 100%;" border="1">
  <tr align="center">
    <th>Seller</th>
    <th>Status</th>
    <th  style="background-color: gray;">Order Count</th>
    <th>Advance Paid</th>
    <th>Order Amount
      <o/th>
    <th>Courier Cost</th>
    <th>Weight</th>
  </tr>
  <?php

  $sql_view = "SELECT seller,status,count(order_id),SUM(advance_paid),SUM(order_amount),sum(total_service_charges),sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken   GROUP BY seller,status";
  //echo $sql_view;
  $query = mysqli_query( $con, $sql_view );
  $sum1 = 0;
  $pre_seller = "";
  $pre_color = rand_color();
  $total_order = 0;
  while ( $row = mysqli_fetch_array( $query ) ) {
    if ( $pre_seller != $row[ 0 ] ) {
      $pre_seller = $row[ 0 ];
      $pre_color = rand_color();
    }
    ?>
  <tr  style="background-color: <?php echo $pre_color; ?>"  align="center">
    <td ><?php echo $row[0]; echo showQuery("SELECT name FROM `user` WHERE email='$row[0]'"); ?></td>
    <td ><?php echo $row[1];?></td>
    <td style="background-color: gray;"><?php echo $row[2];?></td>
    <td ><?php echo $row[3]; $total_order=$total_order+$row[2]; ?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $row[5];?></td>
    <td><?php echo $row[6];?></td>
  </tr>
  <?php  } ?>
  <tr bgcolor="grey">
    <th colspan="2">Total Orders</th>
    <th><strong><?php echo $total_order; ?></strong></th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
  </tr>
</table>
<br>
<br>
<br>
<center>
  <h3>Seller Wise Courier Comapny & Status Report</h3>
</center>
<table  style=" width: 100%;" border="1">
  <tr align="center">
    <th>Seller</th>
    <th>Status</th>
    <th>Courier Company</th>
    <th  style="background-color: gray;">Order Count</th>
    <th>Advance Paid</th>
    <th>Order Amount
      <o/th>
    <th>Courier Cost</th>
    <th>Weight</th>
  </tr>
  <?php

  $sql_view = "SELECT seller,status,courier_company,count(order_id),SUM(advance_paid),SUM(order_amount),sum(total_service_charges),sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken   GROUP BY seller,status,courier_company";
  $query = mysqli_query( $con, $sql_view );
  $sum1 = 0;
  $pre_seller = "";
  $pre_color = rand_color();
  $total_order = 0;
  while ( $row = mysqli_fetch_array( $query ) ) {
    if ( $pre_seller != $row[ 0 ] ) {
      $pre_seller = $row[ 0 ];
      $pre_color = rand_color();
    }
    ?>
  <tr style="background-color: <?php echo $pre_color; ?>" align="center">
    <td   ><?php echo $row[0]; echo showQuery("SELECT name FROM `user` WHERE email='$row[0]'"); ?></td>
    <td><?php echo $row[1];?></td>
    <td><?php echo $row[2];?></td>
    <td style="background-color: gray;"><strong><?php echo $row[3]; $total_order=$total_order+$row[3]; ?></strong></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $row[5];?></td>
    <td><?php echo $row[6];?></td>
    <td><?php echo $row[7];?></td>
  </tr>
  <?php  } ?>
  <tr bgcolor="grey">
    <th colspan="3">Total Orders</th>
    <th><strong><?php echo $total_order; ?></strong></th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ") ?></th>
  </tr>
</table>

</body>
</html>