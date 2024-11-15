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
?>
</div>

<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="col-sm-12">
      <form>
        <div class="row">
          <div class="col-sm-5">
            <label class="col-form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
          </div>
          <div class="col-sm-5">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
          </div>
          <div class="col-sm-2"> <br>
            <input type="submit" name="submit" class="btn btn-primary" value="Filter">
          </div>
        </div>
      </form>
      <?php include("fix_header.php"); ?>
          <th>Inquiry ID</th>
            <th>Type</th>
            <th>Step/Status</th>
            <th>Comment</th>
            <th>Time</th>
            <th>Seller</th>
            <th>Feedback By</th>
            <th>Contact Type</th>
            <th>Duration</th>
            <th>Call Status</th>
            <th>Medicine Status</th>
            <th>Patient Feedback</th>
          </tr>
          </thead>
          
          <tbody>
            <?php
            $sqlview = "SELECT type,status,time,allocated_to,allocated_by,order_no,comments,call_type,duration,inquiry_id,call_status,medicine_status,patient_feedback FROM `inquiry_status_history` WHERE type='Feedback' AND date(time) BETWEEN '$start_date' AND '$end_date'";
            //            echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview['inquiry_id']; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <?php echo $rowview['inquiry_id']; ?></td>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[6]; ?></td>
              <td><?php echo change_datetime_ddmmyyyhis($rowview[2]); ?></td>
              <td><?php echo $rowview[3]; ?></td>
              <td><?php echo $rowview[4]; ?></td>
              <td><?php echo $rowview['call_type']; ?></td>
              <td><?php echo $rowview['duration']; ?></td>
              <td><?php echo $rowview['call_status']; ?></td>
              <td><?php echo $rowview['medicine_status']; ?></td>
              <td><?php echo $rowview['patient_feedback']; ?></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>
</body></html>