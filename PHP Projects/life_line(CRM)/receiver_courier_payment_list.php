<?php
include( "config.php" );
include( "allFunctions.php" );
$start_date = $date;
$end_date = $date;
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $end_date = $_REQUEST[ 'end_date' ];
}
?>
<!DOCTYPE html>
<?php
include "start.php";
include "preloader.php";
?>
</div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="col-lg-12"> 
      <?php include("courier_receiving_payment_tabs.php"); ?>
   
        
      
  
        <form>
            <div class="row">
            <div class="col-sm-5">
                <label class="col-form-label">Start Date</label>
              <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
            </div> <div class="col-sm-5">
                <label>End Date</label>
              <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
            </div>
                <div class="col-sm-2">
                   <br>
                <input type="submit" name="submit" class="btn btn-primary" value="Filter">
                </div>
            </div>
      
        </form>
      <?php include("fix_header.php"); ?>
          <th>Receiving#</th>
            <th>Cheque Number</th>
            <th>Cheque Amount</th>
            <th>Cheque Date</th>
            <th>Courier Company</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Order IDs</th>
            <th>Tracking IDs</th>
            <th>Status Count</th>
            <th>Parcels</th>
            <th>Actions</th>
          </tr>
          </thead>
          
          <tbody>
            <?php
              $sqlview = "SELECT * FROM `order_courier_bill_receivings` WHERE date(created_at) BETWEEN '$start_date' AND '$end_date'";
//            echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview['id']; ?>
                </td>
              <td><?php echo $rowview['cheque_number']; ?></td>
              <td><?php echo $rowview['cheque_amount']; ?></td>
              <td><?php echo change_date_ddmmyyy( $rowview['cheque_date']); ?></td>
              <td><?php echo $rowview['courier_company']; ?></td>
              <td><?php echo change_datetime_ddmmyyyhis($rowview['created_at']); ?></td>
              <td><?php echo $rowview['created_by']; ?></td>
                 <th style="font-size: 6pt;" ><?php
                 $sql_orders="SELECT DISTINCT order_id FROM `order_dispatch_info_history` WHERE payment_receiving_id='$rowview[id]' ";
                
                $query_orders=mysqli_query($con,$sql_orders);
                while($row_orders=mysqli_fetch_array($query_orders))
                {
          $sql_status="SELECT order_id,payment_status,tracking_id FROM `order_dispatch_info_history` WHERE payment_receiving_id='$rowview[id]' AND order_id='$row_orders[0]'  
ORDER BY `order_dispatch_info_history`.`entered_at`  DESC LIMIT 1 ";
//                    echo $sql_status;
          $query_status=mysqli_query($con,$sql_status);
          while($row_status=mysqli_fetch_array($query_status))
           {
                 ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[payment_status]'"); ?>">
                <?php
              echo $row_status[0]."<br>";
              ?></span>
                    <?php
          }
                }
          ?></th>    <th style="font-size: 6pt;" ><?php   $query_orders=mysqli_query($con,$sql_orders);
                while($row_orders=mysqli_fetch_array($query_orders))
                {
          $sql_status="SELECT tracking_id,payment_status FROM `order_dispatch_info_history` WHERE payment_receiving_id='$rowview[id]' AND order_id='$row_orders[0]'  
ORDER BY `order_dispatch_info_history`.`entered_at`  DESC LIMIT 1 ";
//                    echo $sql_status;
          $query_status=mysqli_query($con,$sql_status);
          while($row_status=mysqli_fetch_array($query_status))
           {
                 ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[payment_status]'"); ?>">
                <?php
              echo $row_status[0]."<br>";
              ?></span>
                    <?php
          }}
          ?></th>   
                
                <th style="font-size: 8pt;" ><?php
                $data=[];
                    $i=0;
                $query_orders=mysqli_query($con,$sql_orders);
                while($row_orders=mysqli_fetch_array($query_orders))
                {
                    
                
          $sql_status="SELECT * FROM `order_dispatch_info_history` WHERE payment_receiving_id='$rowview[id]' AND order_id='$row_orders[0]'  
ORDER BY `order_dispatch_info_history`.`entered_at`  DESC LIMIT 1";
//                echo $sql_status;
          $query_status=mysqli_query($con,$sql_status);
                   
          while($row_status=mysqli_fetch_array($query_status))
          { 
              ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[payment_status]'"); ?>">
                <?php
              $data[$i]=$row_status['payment_status'];
//              echo "$row_status[1]<br>";
              ?></span>
                    <?php
           
          }
              $i++;     }

$status_counts = [];

for ($i = 0; $i < count($data); $i++) {
  $current_status = $data[$i];
  if (!isset($status_counts[$current_status])) {
    $status_counts[$current_status] = 0;
  }
  $status_counts[$current_status]++;
}

// Print the results (status, count)
foreach ($status_counts as $status => $count) {
  echo $status . " ($count) <br>" ;
}

          ?></th>
              <td><span class="h5">
                  <?php echo   showQuery("SELECT count(DISTINCT order_id) FROM `order_dispatch_info_history` WHERE payment_receiving_id='$rowview[id]'");
                  $rid=$rowview['id'];
                  ?>
                  </span></td><td align="center">
           
                <a class="btn btn-primary text-white" target="new"  onClick='window.open("print_payment_receiving_bill.php?id=<?php echo $rid ?>", "myWindow", "width=600,height=1000,scrollbars=yes");
'>View</a>
                  <a onClick="return confirm('Do You Want To Edit Receiving Id <?php echo $rid ?>?');" href="edit_receive_courier_payment.php?id=<?php echo $rid ?>" class="btn btn-success">Edit</a>
                <?php if($rowview['cheque_payment']=="Pending")
                  {
                ?>
                        <a onClick="return confirm('Do You Want To Clear Payment of Receiving Id <?php echo $rid ?>?');" href="receive_courier_clear_cheque_payment.php?id=<?php echo $rid ?>" class="btn btn-sm btn-warning">Clear Payment</a>
                <?php } ?>
                </td>
          
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<br>
<br>
<br>

<script src="vendor/jquery/jquery.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="vendor/datatables/jquery.dataTables.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</body>
</html>