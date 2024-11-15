<?php
include "allFunctions.php";
include "config.php";

//include "print_header.php";
$id = $_REQUEST[ 'id' ];
$sql_deposit = "SELECT * FROM `order_courier_dispatch` WHERE id='$id'";
$query_deposit = mysqli_query( $con, $sql_deposit );
$row_deposit = mysqli_fetch_array( $query_deposit );
echo "<h1 align='center'>Courier Dispatch $id </h1>";

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
    <style>
    .black_header
        {
            background-color:black; color: white;
        }
    </style>
</head>
<body>

        <table border="1" width="100%">
        <tr>
      
            <th class="black_header"><label>Dispatch Date</label></th>    
        <th><label>  <?php echo change_date_ddmmyyy( $row_deposit['cheque_date']); ?></label></th>  
            <th class="black_header"><label>Courier Company</label></th>    
        <th><label>  <?php echo $row_deposit['courier_company']; ?></label></th>    
        </tr> 
        
        </table>

<table border="1" width="100%">
  <tr class="black_header"> 
    
          <th>SN</th>
          <th>Order ID</th>
          <th>Tracking ID</th>
          <th>Order Date</th>
          <th>Receiver Name</th>
          <th>Courier Company</th>
          <th>Payment Method</th>
          <th>COD Amount</th>
          <th>Total Freight Charges</th>
          <th>Receivable</th>
          <th>Parcel Weight</th>
          <th>Parcel Status</th>
          <th>Payment Status</th>
    <!--
          <th>Head Office Invoice#</th>
          <th>Payment Clearance Date</th>
          <th>Status</th>
--> 
  </tr>
  </thead>
  
  <tbody>
    <?php
    $sql_view = "SELECT * FROM `order_dispatch_info` WHERE dispatch_id='$id' ";
//                        echo $sql_view;
    $query_view = mysqli_query( $con, $sql_view );
    $i = 0;
        $sum1 = 0;
  $sum_recv = 0;
    while ( $row_view = mysqli_fetch_array( $query_view ) ) {
           $recv=0;
      ?>
    <tr align="center " bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_view[status]'"); ?>"> 
      
            <td><?php echo $i+1; ?></td>
            <td>
              <span style="color: darkblue; text-decoration: underline;"  onClick="window.open('order_details.php?id=<?php  echo $row_view['order_id']; ?>')"><?php echo $row_view['order_id']; ?></span>  
          </td>
            <td><?php echo strtoupper( $row_view['tracking_id']); ?></td>
            <td><?php echo change_date_ddmmyyy($row_view['order_date']); ?></td>
            <td><?php echo $row_view['receiver_name']; ?></td>
            <td><?php echo $row_view['courier_company']; ?></td>
            <td><?php echo $row_view['payment_method']; ?></td>
            <td><?php echo $row_view['order_amount']; ?></td>
            <td><?php echo $row_view['total_service_charges']; ?></td>
            <td><?php
        if($row_view['status']=="Payment Received")
        {
            
        $recv=$row_view[ 'order_amount' ]-$row_view['total_service_charges'];
        }
        else
        {
            
        $recv=-$row_view['total_service_charges'];
        }
        echo $recv;
        $sum_recv=$sum_recv+$recv; ?></td>
            <td><?php echo $row_view['package_weight']; ?></td>
            <td><?php echo $row_view['status']; ?></td>
            <td><?php echo $row_view['status']; ?></td>
   
    </tr>
    <?php $i++; } ?>
    <tr class="h6">
      <th colspan="2" ><?php echo $i; ?> Records</th>
      
      <th colspan="5" ></th>
        <th><?php echo showQuery("SELECT SUM(order_amount) FROM `order_dispatch_info` WHERE dispatch_id='$id' ") ?></th>
        <th><?php echo showQuery("SELECT SUM(total_service_charges) FROM `order_dispatch_info` WHERE dispatch_id='$id' ") ?></th>
<!--        <th><?php echo showQuery("SELECT SUM(order_amount)-SUM(total_service_charges) FROM `order_dispatch_info` WHERE dispatch_id='$id' ") ?></th>-->
        <th><?php echo $sum_recv; ?></th>
        <th><?php echo showQuery("SELECT SUM(package_weight) FROM `order_dispatch_info` WHERE dispatch_id='$id' ") ?></th>
        <th></th>
    </tr>
  </tbody>
</table>
    <table width="100%" border="1">
        <tr>
       
            <th class="black_header"><label>Created At</label></th>    
        <th><label>  <?php echo change_date_ddmmyyy( $row_deposit['created_at']); ?></label></th>  
            <th class="black_header"><label>Created By</label></th>    
        <th><label>  <?php echo $row_deposit['created_by']; ?></label></th>    
        </tr>
    </table>
    <br>
    <table width="100%" border="1">
        <tr>
        <th class="black_header"><label>Total Billed COD Amount</label></th>    
        <th><label> 
        <?php echo showQuery("SELECT SUM(order_amount) FROM `order_dispatch_info` WHERE dispatch_id='$id' ") ?></label></th> 
        </tr>
    </table>
    
<table width="100%" border="1">
  <tr>
    <th colspan="6"  bgcolor="grey">Summary</th>
  </tr>
   
  <tr  bgcolor="grey">
    <th>Status Name</th>
    <th>Count</th>
    <th>Total COD Amount</th>
    <th>Total Freight Charges</th>
    <th>Receivable</th>
  </tr>
  <?php
  $sql_summary = "SELECT status,count(*),sum(order_amount),sum(total_service_charges),sum(order_amount)-sum(total_service_charges) FROM `order_dispatch_info` WHERE dispatch_id='$id'   GROUP BY status ORDER BY status='Payment Received' DESC,status='Return Received' DESC,status='Return Payment Received' DESC, `count(*)` DESC;";
  //        echo $sql_summary;
  $query_sumary = mysqli_query( $con, $sql_summary );
  while ( $row_summary = mysqli_fetch_array( $query_sumary ) ) {
    ?>
  <tr bgcolor="<?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_summary[0]'"); ?>">
    <th><?php echo $row_summary[0] ?></th>
    <th><?php echo $row_summary[1] ?></th>
    <th><?php echo $row_summary[2] ?></th>
    <th><?php echo $row_summary[3] ?></th>
    <th><?php 
        if($row_summary[0]=="Return Received"||$row_summary[0]=="Return Payment Received")
        {
            echo "-".$row_summary[3];
                
        }
      else
      {
        echo $row_summary[4];  
      }
         ?></th>
  </tr>
  <?php } ?>
</table>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
</body>
</html>