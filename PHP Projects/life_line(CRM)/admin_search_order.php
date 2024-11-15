<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {

  $attrib = $_REQUEST[ 'attrib' ];
  $keyword = $_REQUEST[ 'keyword' ];
  $criteria = $_REQUEST[ 'criteria' ];
  if ( $criteria == "like" ) {
    $sqlview = "SELECT *,(SELECT color FROM `order_status` WHERE order_status=order_dispatch_info.status) AS 'color',(SELECT patient_id FROM `inquiry` WHERE id=order_patient_id) AS 'patient_id' FROM `order_dispatch_info` WHERE $attrib LIKE '%$keyword%'";
  }
  if ( $criteria == "exact" ) {
    $sqlview = "SELECT *,(SELECT color FROM `order_status` WHERE order_status=order_dispatch_info.status) AS 'color',(SELECT patient_id FROM `inquiry` WHERE id=order_patient_id) AS 'patient_id' FROM `order_dispatch_info` WHERE $attrib = '$keyword'";
  }


  include( "limit_record.php" );

}
?>
<!DOCTYPE html>
<html>
<head>
<script src="js/selectall.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<style>
textarea {
    width: 100%;
    height: 300px;
}
</style>
</head>
<body>
<?php include("start.php"); ?>
<div class="content-wrapper">
  <div class="container-fluid">
  <?php breadcrumb(); ?>
  <form>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-sm-3">
          <label><strong>Select Property:</strong></label>
          <select class="form-control" name="attrib">
            <?php
            $sqlcol = "desc `order_dispatch_info`";
            $querycol = mysqli_query( $con, $sqlcol );
            while ( $rowcol = mysqli_fetch_array( $querycol ) ) {
              ?>
            <option <?php if(isset($_REQUEST['attrib'])) { if($_REQUEST['attrib']==$rowcol[0]) { echo "selected"; }  } ?> value="<?php echo $rowcol[0]; ?>"><?php echo strtoupper( str_replace("_", " ", $rowcol[0])); ?></option>
            <?php
            }

            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <label><strong>Criteria:</strong></label>
          <select class="form-control" name="criteria">
            <option <?php if(isset($_REQUEST['criteria'])) { if($_REQUEST['criteria']=="exact") { echo "selected"; }  } ?> value="exact">Exact Match</option>
            <option  <?php if(isset($_REQUEST['criteria'])) { if($_REQUEST['criteria']=="like") { echo "selected"; }  } ?>  value="like">Contains (Resembles)</option>
          </select>
        </div>
        <div class="col-sm-3">
          <label><strong>Search Word:</strong></label>
          <input class="form-control input-lg" placeholder="Search..." type="text" name="keyword" value="<?php if(isset($_REQUEST['keyword'])) { echo $_REQUEST['keyword'];  } ?>" >
        </div>
        <div class="col-sm-3"> <br>
          <input type="submit" name="submit" value="Search" class="btn-sm btn-primary">
        </div>
      </div>
      <br>
    </div>
    </div>
  </form>
  <?php
  if ( isset( $_REQUEST[ 'keyword' ] ) ) {
    ?>
  <form method="post" action="process_inquiry_employee_allocation.php">
    <?php
    $queryview = mysqli_query( $con, $sqlview );
    echo mysqli_num_rows( $queryview );
    ?>
    Records Found</strong> Select
    <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50">
    Rows <span style="float: right;">
    <label>User:
      <select class="form-select-sm"  name="allocated_to">
        <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
      </select>
    </label>
    <input type="submit"  name="submit" value="Allocate" class="btn-sm btn-primary">
    </span>
    <?php
   
    include( "fix_header.php" );
    ?>
    <tr>
      <th style="width: 100px;">Actions</th>
      <th>Order ID</th>
      <th>Status</th>
      <th>Seller</th>
      <th>Order Inquiry Id</th>
      <th>Patient ID</th>
      <th>Order Date</th>
      <th>Total Orders</th>
      <th>Order Type</th>
      <th>Receiver Name</th>
      <th>Destination Contact</th>
      <th>Tracking ID</th>
      <th>Entered At</th>
      <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
      <?php
      // echo $sqlview;
      $queryview = mysqli_query( $con, $sqlview );
      while ( $rowview = mysqli_fetch_array( $queryview ) ) {
        ?>
      <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  style="background-color: <?php echo showQuery("SELECT color FROM `status_list` WHERE status_name='$rowview[call_status]'") ?>;" >
        <td>
            <input type="checkbox" name="emp[]" value="<?php echo $rowview[3]; ?>">
          <i title="More"  onClick="window.open('order_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <i title="Status History" onClick="window.open('order_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i> <a target="new" href="update_order_status.php?id=<?php echo $rowview[0]; ?>" title="Set Order Status"><i class="fa fa-reorder text-warning"></i></a> <a target="new" href="update_order_checklist.php?id=<?php echo $rowview[0]; ?>" title="Check List"><i class="fa fa-check-square-o text-info"></i></a> <a target="new" href="update_order_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a> 
          <!--
              <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
            
--></td>
        <td><?php echo $rowview[0]; ?></td>
        <td title="<?php echo $rowview[1] ?>"><span class="badge" style="color:black; background-color: <?php echo $rowview['color'] ?>;"><?php echo $rowview[1]; ?></span></td>
        <td title="<?php echo $rowview[2] ?>"><?php echo $rowview[2]; ?></td>
        <td title="<?php echo $rowview[3] ?>"><?php echo $rowview[3]; ?> <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[3]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i></td>
        <td style="background-color: <?php echo (empty($rowview['patient_id'])) ? 'red' :''; ?> !important;" title="<?php echo $rowview['patient_id'] ?>"><?php echo $rowview['patient_id']; ?></td>
        <td title="<?php echo $rowview[4] ?>"><?php echo change_date_ddmmyyy($rowview[4]); ?></td>
        <td><?php no_of_orders_inquiry($rowview[3]) ?></td>
        <td title="<?php echo $rowview['payment_method'] ?>"><?php echo $rowview['payment_method']; ?></td>
        <td title="<?php echo $rowview['receiver_name'] ?>"><?php echo $rowview['receiver_name']; ?></td>
        <td title="<?php echo $rowview['destination_contact'] ?>"><?php echo $rowview['destination_contact']; ?></td>
        <td title="<?php echo $rowview['tracking_id'] ?>"><?php echo $rowview['tracking_id']; ?></td>
        <td title="<?php echo change_datetime_ddmmyyyhis($rowview['entered_at']) ?>"><?php echo substr( change_datetime_ddmmyyyhis( $rowview['entered_at']),0,10); ?></td>
        <td><?php customer_feedback($rowview[3]); ?></td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
  </div>

  
    <?php } ?>
  </form>
</div>
</div>
<br>
<br>
<br>
</body>
</html>