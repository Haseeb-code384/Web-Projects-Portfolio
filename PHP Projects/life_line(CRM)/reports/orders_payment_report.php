<?php
session_start();
include( "../config.php" );
include( "../allFunctions.php" );
$date_start = $_REQUEST[ 'date_start' ];
$date_end = $_REQUEST[ 'date_end' ];
$seller = $_REQUEST[ 'seller' ];
$seller_sql = "";
$delivery_sql = "";
$courier_company_sql = "";

$mistaken = "";
$detailed_payments = "";
?>
<style>
thead {
    position: sticky;
    top: 0;
}
</style>
<table width="100%">
  <tr>
    <td><strong>FROM :</strong><?php echo change_date_ddmmyyy( $date_start); ?></td>
    <td><strong>To :</strong><?php echo change_date_ddmmyyy( $date_end); ?></td>
    <?php

    echo " <th  align='right'>Delivery Status</th><td>";
    if ( $_REQUEST[ 'delivery_status' ] != "" ) {
      $delivery_status = $_REQUEST[ 'delivery_status' ];
      if ( exists_in_db( "SELECT * FROM `order_status` WHERE parent IN('$delivery_status')" ) ) {
        $delivery_sql = "AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$delivery_status'))";

      } else {

        echo "$delivery_status</td>";
        $delivery_sql = "AND status='$delivery_status'";


      }
    } else {
      echo "Any Status</td>";
    }


    echo "<th  align='right'>Courier Company</th>
        <td>";
    if ( $_REQUEST[ 'courier_company' ] != "" ) {
      $courier_company = $_REQUEST[ 'courier_company' ];
      $courier_company_sql = "AND courier_company='$courier_company'";
      echo "$courier_company</td>";
    } else {
      echo "Any Company</td>";
    }

    ?>
    <th align='right'>Mistaken</th>
    <td><?php
    if ( $_REQUEST[ 'show_mistaken' ] == "show" ) {
      echo " Included </td>";
      $mistaken = " ";
    } else {
      $mistaken = " AND status!='Mistaken' ";
      echo "Not-Included </td><th align='right'>Detailed Payments</th>
        <td>";
    }
    if ( $_REQUEST[ 'show_detailed_payment' ] == "show" ) {
      echo " Included </td>";
      $detailed_payments = "Yes";
    } else {
      echo "Not-Included </td>";
    }
    ?>
  </tr>
</table>
<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
table {
    font-size: 9pt;
}
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
<h3 align="center">
<b>Orders Payment Report </b>
<?php include ('logo.php');?>
</h3>
<br>
<?php
if ( $_REQUEST[ 'seller' ] != "" ) {
  $seller_sql = "AND seller='$seller'";
  ?>
<center>
  <b>Seller (<?php echo "Seller".$seller.") "; echo showQuery("SELECT name FROM `user` WHERE email='$seller'"); ?></b><br>
</center>
<?php
}
?>
<hr style="width: 110%; border: 1px solid black">
<table width="100%"  border="1">
  <thead>
    <tr align="center" bgcolor="grey">
      <th>OrderID</th>
      <th>TrackingID</th>
      <th>Delivery Status</th>
      <th>Payment Status</th>
      <th>Finished</th>
      <th>Receiver Name</th>
      <th width="70">Order Date</th>
      <th>Courier Company</th>
      <th>Payment Receiving Id</th>
      <th>Payment Receiving Date</th>
      <th>Weight</th>
      <th>Advance Paid</th>
      <th>Unbilled COD Amount</th>
      <th>Billed COD Amount</th>
      <th>Receivable</th>
      <th>Consultency Fee</th>
      <th style="border-right: 2px solid black;">Total Freight Charges</th>
      <?php
      if ( $_REQUEST[ 'seller' ] == "" ) {
        echo "<th>Seller</th>";
      }
      if ( $detailed_payments != "" ) {
        ?>
      <th>Courier Service Charges</th>
      <th>Discount</th>
      <th>Fuel Adjustment</th>
      <th>Fuel Surcharge</th>
      <th>Fuel Factor</th>
      <th>GST Amount</th>
      <th>Hnd Oth Charges</th>
      <th>Price Adjustment</th>
      <th>Cmi Charges</th>
      <th>Insurance Charges</th>
      <th>Other Charges</th>
      <?php } ?>
    </tr>
  </thead>
  <?php

  $sql_view = "SELECT * FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken  ORDER BY payment_status='Payment Received' DESC,payment_status='Return Received' DESC,payment_status='Return Payment Received' DESC,payment_status,order_id";
  //  echo $sql_view;
  $query = mysqli_query( $con, $sql_view );
  $sum1 = 0;
  $sum_recv = 0;

  while ( $row = mysqli_fetch_array( $query ) ) {
    $recv = 0;
    ?>
  <tr align="center"  bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row[payment_status]'"); ?>">
    <td><a href="#" onClick="window.open('../order_details.php?id=<?php  echo $row['order_id']; ?>')" ><?php echo $row['order_id'];?></a><a href="../flowchart.php?order_id=<?php echo $row['order_id'];?>" target="new">
      <button>Stages</button>
      </a>
      <!--
              <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $row[0]; ?>'" class="fa fa-trash text-danger"></i>
            
--></td>
    <td bgcolor="<?php echo (empty($row['tracking_id'])) ? 'red' :''; ?>"><?php echo strtoupper( $row['tracking_id']);?></td>
    <td><?php echo $row['status'];?></td>
    <td><?php  echo (empty($row['payment_status'])) ? "No Receiving Detail" : $row['payment_status'];?></td>
    <td><?php echo $row['finished'];  
      
    $rid = $row[ 'payment_receiving_id' ];
      if (!exists_in_db( "SELECT finished FROM `order_dispatch_info` WHERE order_id='$row[0]' " ) )
       {
          if($rid!='')
          {
      ?>
        <br><button onClick='this.style.visibility="hidden";this.parentElement.innerHTML="Finished";window.open("../process_order_finished.php?order_id=<?php echo $row[0]; ?>", "myWindow", "width=600,height=1000,scrollbars=yes");  '>Finished</button>
        <?php  }}?>
      
      </td>
    <td><?php echo $row['receiver_name'];?></td>
    <td><?php echo change_date_ddmmyyy( $row['order_date']);?></td>
    <td  bgcolor="<?php echo (empty($row['courier_company'])) ? 'red' :''; ?>"><?php echo $row['courier_company'];?></td>
    <?php
    $rid = $row[ 'payment_receiving_id' ];
    ?>
    <td  title="Cheque amount <?php echo showQuery("SELECT cheque_amount FROM `order_courier_bill_receivings` WHERE id='$row[payment_receiving_id]'")  ?>"><span style="color: darkblue; text-decoration: underline;"  onClick='window.open("../print_payment_receiving_bill.php?id=<?php echo $rid; ?>", "myWindow", "width=600,height=1000,scrollbars=yes");
'><?php echo $row['payment_receiving_id'];?></span>
      <?php
      if ( $row[ 'payment_receiving_id' ] != '' ) {
        if ( !exists_in_db( "SELECT admin_verified FROM `m_account_detail` WHERE type='$row[0]'  
ORDER BY `m_account_detail`.`admin_verified` DESC" ) ) {
          if ( $_SESSION[ 'email' ] == "Doctor Omar Chughtai" ) {
            ?>
      <br>
      <button onClick='this.style.visibility="hidden";this.parentElement.innerHTML="Verified";window.open("../process_order_admin_verification.php?order_id=<?php echo $row[0]; ?>", "myWindow", "width=600,height=1000,scrollbars=yes");  '>Verify</button>
      <?php
      }
      } else {
        echo "<br>Verified";
      }
      }
       ?>
        
      </td>
    <?php
    $cheque_date = showQuery( "SELECT cheque_date FROM `order_courier_bill_receivings` WHERE id='$row[payment_receiving_id]'" );

    ?>
    <td bgcolor="<?php echo showQuery("SELECT 'yellow' FROM `order_dispatch_info` WHERE '$cheque_date' NOT BETWEEN '$date_start' AND '$date_end' AND '$cheque_date' != '' LIMIT 1") ?>" ><?php echo $cheque_date; ?></td>
    <td><?php echo $row['package_weight'];?></td>
    <td><?php echo $row['advance_paid'];?></td>
    <?php
    if ( $row[ 'payment_receiving_id' ] < 1 ) {
      echo "<td>" . $row[ 'order_amount' ] . "</td><td></td><td></td>";
    } else {

      echo "<td></td><td>" . $row[ 'order_amount' ] . "</td>";
      ?>
    <td><?php
    if ( $row[ 'courier_company' ] == "POST OFFICE " && $row[ 'payment_status' ] == "Payment Received" ) {
      $recv = $row[ 'order_amount' ];
    } else if ( $row[ 'payment_status' ] == "Payment Received" ) {

      $recv = $row[ 'order_amount' ] - $row[ 'total_service_charges' ];
    } else {
      if ( $row[ 'courier_company' ] != "POST OFFICE " ) {

        $recv = -$row[ 'total_service_charges' ];
      }
    }
    echo $recv;
    $sum_recv = $sum_recv + $recv;
    ?></td>
    <?php
    }
    ?>
    <td  ><?php echo $row['customer_feedback'];?></td>
    <td  style="border-right: 2px solid black;"><?php echo $row['total_service_charges'];?></td>
    <?php
    if ( $_REQUEST[ 'seller' ] == "" ) {
      ?>
    <td><?php echo $row['seller'];?></td>
    <?php
    }
    if ( $detailed_payments != "" ) {
      ?>
    <td><?php echo $row['courier_cost'];?></td>
    <td><?php echo $row['discount'];?></td>
    <td><?php echo $row['fuel_adjustment'];?></td>
    <td><?php echo $row['fuel_surcharge'];?></td>
    <td><?php echo $row['fuel_factor'];?></td>
    <td><?php echo $row['gst_amount'];?></td>
    <td><?php echo $row['hnd_oth_charges'];?></td>
    <td><?php echo $row['price_adjustment'];?></td>
    <td><?php echo $row['cmi_charges'];?></td>
    <td><?php echo $row['insurance_charges'];?></td>
    <td><?php echo $row['other_charges'];?></td>
    <?php } ?>
  </tr>
  <?php  } ?>
  <tr align="center" bgcolor="grey">
    <th colspan="10" rowspan="2">Total <?php echo mysqli_num_rows($query); ?>Records</th>
    <th>Weight</th>
    <th>Advance Paid</th>
    <th>Unbilled COD Amount</th>
    <th>Billed COD Amount</th>
    <th  >Total Receivable</th>
    <th  >Consultency Fee</th>
    <th  style="border-right: 2px solid black;">Total Freight Charges</th>
    <?php
    if ( $_REQUEST[ 'seller' ] == "" ) {
      ?>
    <th>Total Sellers</th>
    <?php
    }
    if ( $detailed_payments != "" ) {
      ?>
    <th>Courier Service Charges</th>
    <th>Discount</th>
    <th>Fuel Adjustment</th>
    <th>Fuel Surcharge</th>
    <th>Fuel Factor</th>
    <th>GST Amount</th>
    <th>Hnd Oth Charges</th>
    <th>Price Adjustment</th>
    <th>Cmi Charges</th>
    <th>Insurance Charges</th>
    <th>Other Charges</th>
    <?php
    }
    ?>
  </tr>
  <tr bgcolor="grey">
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id IS null") ?></th>
    <th ><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id>=1") ?></th>
    <th><?php echo $sum_recv; ?></th>
    <th ><?php echo showQuery("SELECT sum(customer_feedback) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th  style="border-right: 2px solid black;"><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <?php
    if ( $_REQUEST[ 'seller' ] == "" ) {
      ?>
    <th><?php echo showQuery("SELECT count(distinct seller) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <?php
    }
    if ( $detailed_payments != "" ) {
      ?>
    <th><?php echo showQuery("SELECT sum(courier_cost) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(discount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(fuel_adjustment) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(fuel_surcharge) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(fuel_factor) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(gst_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(hnd_oth_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(price_adjustment) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(cmi_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(insurance_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(other_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <?php } ?>
  </tr>
</table>
<br>
<div style="page-break-after: always;"></div>
<table width="100%">
  <tr>
    <td><strong>FROM :</strong><?php echo change_date_ddmmyyy( $date_start); ?></td>
    <td><strong>To :</strong><?php echo change_date_ddmmyyy( $date_end); ?></td>
    <?php

    echo " <th  align='right'>Delivery Status</th><td>";
    if ( $_REQUEST[ 'delivery_status' ] != "" ) {
      $delivery_status = $_REQUEST[ 'delivery_status' ];

      if ( exists_in_db( "SELECT * FROM `order_status` WHERE parent IN('$delivery_status')" ) ) {
        $delivery_sql = "AND payment_status IN (SELECT order_status FROM `order_status` WHERE parent IN('$delivery_status'))";


      } else {

        $delivery_sql = "AND payment_status='$delivery_status'";
        echo "$delivery_status</td>";

      }
    } else {
      echo "Any Status</td>";
    }


    echo "<th  align='right'>Courier Company</th>
        <td>";
    if ( $_REQUEST[ 'courier_company' ] != "" ) {
      $courier_company = $_REQUEST[ 'courier_company' ];
      $courier_company_sql = "AND courier_company='$courier_company'";
      echo "$courier_company</td>";
    } else {
      echo "Any Company</td>";
    }

    ?>
    <th align='right'>Mistaken</th>
    <td><?php
    if ( $_REQUEST[ 'show_mistaken' ] == "show" ) {
      echo " Included </td>";
      $mistaken = " ";
    } else {
      $mistaken = " AND status!='Mistaken' ";
      echo "Not-Included </td><th align='right'>Detailed Payments</th>
        <td>";
    }
    if ( $_REQUEST[ 'show_detailed_payment' ] == "show" ) {
      echo " Included </td>";
      $detailed_payments = "Yes";
    } else {
      echo "Not-Included </td>";
    }
    ?>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <th colspan="6"  bgcolor="grey">Summary</th>
  </tr>
  <tr>
    <th>UnBilled Parcels</th>
    <th><?php echo showQuery("SELECT count(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id IS null") ?></th>
    <th>Billed Parcels</th>
    <th colspan="2"><?php echo showQuery("SELECT count(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id>=1") ?></th>
  </tr>
  <tr>
    <th>UnBilled Parcels Amount</th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id IS null") ?></th>
    <th>Billed Parcels Amount</th>
    <th colspan="2"><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken AND payment_receiving_id>=1") ?></th>
  </tr>
  <tr  bgcolor="pink">
    <th colspan="2">Total Amount</th>
    <th colspan="3"><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken ") ?></th>
  </tr>
  <th colspan="5" style="background-color: black; color: white;">Payment Status Summary</th>
  <tr bgcolor="grey">
    <th>Status Name</th>
    <th>Count</th>
    <th>Total COD Amount</th>
    <th>Total Freight Charges</th>
    <th>Receivable</th>
  </tr>
  <?php
  $sql_summary = "SELECT payment_status,count(*),sum(order_amount),sum(total_service_charges),sum(order_amount)-sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken  GROUP BY payment_status ORDER BY payment_status='Payment Received' DESC,payment_status='Return Received' DESC,payment_status='Return Payment Received' DESC, `count(*)` DESC;";
  // echo $sql_summary;
  $query_sumary = mysqli_query( $con, $sql_summary );
  while ( $row_summary = mysqli_fetch_array( $query_sumary ) ) {
    ?>
  <tr bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_summary[0]'"); ?>">
    <th><?php  echo (empty($row_summary[0])) ? "No Receiving Detail" : $row_summary[0]; ?></th>
    <th><?php echo $row_summary[1] ?></th>
    <th><?php echo $row_summary[2] ?></th>
    <th><?php echo $row_summary[3] ?></th>
    <th><?php
    if ( $courier_company == "POST OFFICE " ) {
      echo $row_summary[ 2 ];
    } else if ( $row_summary[ 0 ] == "Return Received" || $row_summary[ 0 ] == "Return Payment Received" ) {
      echo "-" . $row_summary[ 3 ];

    } else {
      echo $row_summary[ 4 ];
    }
    ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th colspan="5" style="background-color: black; color: white;">Delivery Status Summary</th>
  </tr>
  <tr bgcolor="grey">
    <th>Status Name</th>
    <th>Count</th>
    <th>Total COD Amount</th>
    <th>Total Freight Charges</th>
    <th>Receivable</th>
  </tr>
  <?php
  $sql_summary = "SELECT status,count(*),sum(order_amount),sum(total_service_charges),sum(order_amount)-sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken  GROUP BY status ORDER BY status='Payment Received' DESC,status='Return Received' DESC,status='Return Payment Received' DESC, `count(*)` DESC;";
  // echo $sql_summary;
  $query_sumary = mysqli_query( $con, $sql_summary );
  while ( $row_summary = mysqli_fetch_array( $query_sumary ) ) {
    ?>
  <tr bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_summary[0]'"); ?>">
    <th><?php echo $row_summary[0] ?></th>
    <th><?php echo $row_summary[1] ?></th>
    <th><?php echo $row_summary[2] ?></th>
    <th><?php echo $row_summary[3] ?></th>
    <th><?php
    if ( $courier_company == "POST OFFICE " ) {
      echo $row_summary[ 2 ];
    } else if ( $row_summary[ 0 ] == "Return Received" || $row_summary[ 0 ] == "Return Payment Received" ) {
      echo "-" . $row_summary[ 3 ];

    } else {
      echo $row_summary[ 4 ];
    }
    ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th colspan="5" style="background-color: black; color: white;">Delivery Status & Payment Status Wise Summary</th>
  </tr>
  <tr bgcolor="grey">
    <th>Status Name</th>
    <th>Count</th>
    <th>Total COD Amount</th>
    <th>Total Freight Charges</th>
    <th>Receivable</th>
  </tr>
  <?php
  $sql_summary = "SELECT status,count(*),sum(order_amount),sum(total_service_charges),sum(order_amount)-sum(total_service_charges),payment_status FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken  GROUP BY status,payment_status ;";
  // echo $sql_summary;
  $query_sumary = mysqli_query( $con, $sql_summary );
  while ( $row_summary = mysqli_fetch_array( $query_sumary ) ) {
    ?>
  <tr bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_summary[0]'"); ?>">
    <th><?php echo $row_summary[0]." , ";
    echo( empty( $row_summary[ 5 ] ) ) ? "No Receiving Detail" : $row_summary[ 5 ];
    ?></th>
    <th><?php echo $row_summary[1] ?></th>
    <th><?php echo $row_summary[2] ?></th>
    <th><?php echo $row_summary[3] ?></th>
    <th><?php
    if ( $courier_company == "POST OFFICE " ) {
      echo $row_summary[ 2 ];
    } else if ( $row_summary[ 0 ] == "Return Received" || $row_summary[ 0 ] == "Return Payment Received" ) {
      echo "-" . $row_summary[ 3 ];

    } else {
      echo $row_summary[ 4 ];
    }
    ?></th>
  </tr>
  <?php } ?>
  <tr>
    <th colspan="5" style="background-color: black; color: white;">Courier Company Summary</th>
  </tr>
  <tr bgcolor="grey">
    <th>Company Name</th>
    <th>Count</th>
    <th>Total COD Amount</th>
    <th>Total Freight Charges</th>
    <th>Receivable</th>
  </tr>
  <?php
  $sql_summary = "SELECT courier_company,count(*),sum(order_amount),sum(total_service_charges),sum(order_amount)-sum(total_service_charges),payment_status FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken  GROUP BY courier_company ;";
  // echo $sql_summary;
  $query_sumary = mysqli_query( $con, $sql_summary );
  while ( $row_summary = mysqli_fetch_array( $query_sumary ) ) {
    ?>
  <tr bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_summary[0]'"); ?>">
    <th><?php echo $row_summary[0];
    ?></th>
    <th><?php echo $row_summary[1] ?></th>
    <th><?php echo $row_summary[2] ?></th>
    <th><?php echo $row_summary[3] ?></th>
    <th><?php
    if ( $courier_company == "POST OFFICE " ) {
      echo $row_summary[ 2 ];
    } else if ( $row_summary[ 0 ] == "Return Received" || $row_summary[ 0 ] == "Return Payment Received" ) {
      echo "-" . $row_summary[ 3 ];

    } else {
      echo $row_summary[ 4 ];
    }
    ?></th>
  </tr>
  <?php } ?>
</table>
</body>
</html>