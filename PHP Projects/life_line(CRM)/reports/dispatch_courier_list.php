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
      <?php include("courier_dispatch_tabs.php"); ?>
   
        
      
  
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
          <th>Dispatch#</th>
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
              $sqlview = "SELECT * FROM `order_courier_dispatch` WHERE date(created_at) BETWEEN '$start_date' AND '$end_date'";
//            echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview['id']; ?>
                </td>
              <td><?php echo change_date_ddmmyyy( $rowview['cheque_date']); ?></td>
              <td><?php echo $rowview['courier_company']; ?></td>
              <td><?php echo change_datetime_ddmmyyyhis($rowview['created_at']); ?></td>
              <td><?php echo $rowview['created_by']; ?></td>
                 <th style="font-size: 6pt;" ><?php
          $sql_status="SELECT order_id,status FROM `order_dispatch_info` WHERE dispatch_id='$rowview[id]' ";
          $query_status=mysqli_query($con,$sql_status);
          while($row_status=mysqli_fetch_array($query_status))
           {
                 ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[status]'"); ?>">
                <?php
              echo $row_status[0]."<br>";
              ?></span>
                    <?php
          }
          ?></th>    <th style="font-size: 6pt;" ><?php
          $sql_status="SELECT tracking_id,status FROM `order_dispatch_info` WHERE dispatch_id='$rowview[id]' ;";
          $query_status=mysqli_query($con,$sql_status);
          while($row_status=mysqli_fetch_array($query_status))
          {
                 ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[status]'"); ?>">
                <?php
              echo $row_status[0]."<br>";
              ?></span>
                    <?php
          }
          ?></th>   
                
                <th style="font-size: 8pt;" ><?php
          $sql_status="SELECT status,count(*) FROM `order_dispatch_info` WHERE dispatch_id='$rowview[id]' GROUP BY status;";
          $query_status=mysqli_query($con,$sql_status);
          while($row_status=mysqli_fetch_array($query_status))
          { 
              ?>
                <span  style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$row_status[status]'"); ?>">
                <?php
              echo $row_status[0]." ($row_status[1])<br>";
              ?></span>
                    <?php
          }
          ?></th>
              <td><span class="h5">
                  <?php echo showQuery("SELECT count(*) FROM `order_dispatch_info` WHERE dispatch_id='$rowview[id]'");
                  $rid=$rowview['id'];
                  ?>
                  </span></td><td align="center">
                <a class="btn btn-primary text-white" target="new"  onClick='window.open("print_parcel_dispatch.php?id=<?php echo $rid ?>", "myWindow", "width=600,height=1000,scrollbars=yes");
'>View</a>
<!--                  <a onClick="return confirm('Do You Want To Edit Receiving Id <?php echo $rid ?>?');" href="edit_receive_courier_payment.php?id=<?php echo $rid ?>" class="btn btn-success">Edit</a>-->
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