<?php
require_once( "config.php" );
if($currentPage!="view_tasks.php")
{
require_once( "allFunctions.php" );
}
$id = $_REQUEST[ 'id' ];
$sql = "SELECT * FROM `inquiry` WHERE id='$id'";
$queryview = mysqli_query( $con, $sql );
$rowview = mysqli_fetch_array($queryview);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    .mybg
        {
            background-color: bisque;
        }
    </style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>

<body>
<?php
    if($currentPage!="view_tasks.php")
{
include "start.php";
    }
?>
</div>
    <?php 
    if($currentPage!="view_tasks.php")
{
    ?>
    
<div class="content-wrapper">
    <?php
}
    ?>
  <div class="container-fluid">
  <div class="row" style="">
<!--  <h1 align="center">FIRST INFORMATION FORM</h1>-->
  <?php
  if ( $rowview[ 'name' ] != "" && $rowview[ 'address1' ] != "" && $rowview[ 'phone1' ] != "" && $rowview[ 'record_type' ] == "Patient" ) {
    ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert"> This Record Is Complete.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
  </div>
  <?php } else { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert"> This Record Is Incomplete <a target="new" class="alert-link" href="update_inquiry_form.php?id=<?php echo $id; ?>">Click Here To Edit</a>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
  </div>
  <!--  <div class="alert alert-danger" role="alert">  </div>-->
  <?php } ?>
  <body>
      
  <div class="table-responsive">
<!--
      
  <table border="1" width="100%">
    <thead align="center">
      <tr>
        <th colspan="7">Prescription</th>
      </tr>
      <tr align="center" class="mybg">
        <th>SN</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Comments</th>
        <th>Date</th>
      </tr>
    </thead>
    <?php
    $sql_predata = "SELECT * FROM `product_prescription` WHERE inquiry_no='$id' ORDER by id ASC";
    $query_predata = mysqli_query( $con, $sql_predata );
    $i = 1;
    while ( $row_predata = mysqli_fetch_array( $query_predata ) ) {
      ?>
    <tr>
      <th><a href="del.php?delprescription=<?php echo $row_predata[0]; ?>&id=<?php echo $id; ?>">
        <button>X</button>
        </a><?php echo $i; ?></th>
      <th><?php echo $row_predata[1]; ?></th>
      <th><?php echo showQuery("SELECT name FROM `products` WHERE item_id='$row_predata[1]'"); ?></th>
      <th><?php echo $row_predata['prescribed_quantity']; ?></th>
      <th><?php echo $row_predata['comments']; ?></th>
      <th><?php echo $row_predata['created_at']; ?></th>
    </tr>
    <?php $i++; } ?>
  </table>
      
-->
  <table border="1" width="100%">
    <thead align="center">
      <tr>
        <th colspan="7">Diseases</th>
      </tr>
      <tr align="center" class="mybg">
        <th>SN</th>
        <th>Disease</th>
        <th>Active</th>
        <th>Time</th>
        <th>User</th>
      </tr>
    </thead>
    <?php
    $sql_predata = "SELECT * FROM `inquiry_disease` WHERE inquiry_id='$id' ORDER by id ASC";
    $query_predata = mysqli_query( $con, $sql_predata );
    $i = 1;
    while ( $row_predata = mysqli_fetch_array( $query_predata ) ) {
      ?>
    <tr> 
      <!--
        
<th><a href="del.php?delprescription=<?php echo $row_predata[0]; ?>&id=<?php echo $id; ?>"><button>X</button></a><?php echo $i; ?></th>
-->
      
      <th><?php echo $i; ?></th>
      <th><?php echo $row_predata['disease']; ?></th>
      <th><?php echo $row_predata['active']; ?></th>
      <th><?php echo $row_predata['timestamp']; ?></th>
      <th><?php echo $row_predata['user']; ?></th>
    </tr>
    <?php $i++; } ?>
  </table>
  <table class="table-bordered table-hover" width="100%">
    <thead align="center">
      <tr align="center" class="mybg">
        <th>ID</th>
        <th>Given By</th>
        <th>Source</th>
        <th class="<?php if($rowview['name']=="") 
{ 
    echo 'text-danger'; 
} ?> " >Name</th>
        <th>Gender</th>
        <th>Province</th>
        <th>District</th>
        <th>Tehsil</th>
        <th>Area</th>
      </tr>
    </thead>
    <tr align="center">
      <td><?php echo $rowview[0]; ?></td>
      <td><?php echo $rowview[1]; ?></td>
      <td><?php echo $rowview[2]; ?></td>
      <td><?php echo $rowview[3]; ?></td>
      <td><?php echo $rowview['gender']; ?></td>
      <td><?php echo $rowview[4]; ?></td>
      <td><?php echo $rowview[5]; ?></td>
      <td><?php echo $rowview[6]; ?></td>
      <td><?php echo $rowview[7]; ?></td>
    </tr>
  </table>
  <table  class="table-bordered table-hover" width="100%">
    <thead>
      <tr align="center" class="mybg">
        <th class="<?php if($rowview[8]=="") 
{ 
    echo 'text-danger'; 
} ?> " >Address 1</th>
        <th>Address 2</th>
        <th  class="<?php if($rowview[10]=="") 
{ 
    echo 'text-danger'; 
} ?> " >Phone 1</th>
        <th>Phone 2</th>
        <th  class="<?php if($rowview[14]=="") 
{ 
    echo 'text-danger'; 
} ?> ">WhatsApp</th>
        <th>Profile</th>
        <th  class="<?php if($rowview['record_type']!="Patient") 
{ 
    echo 'text-danger'; 
} ?> ">Record Type</th>
      </tr>
    </thead>
    <tr align="center">
      <td  <?php echo $rowview[8]; ?>
      
      </td>
      <td><?php echo $rowview[9]; ?></td>
      <td><?php echo $rowview[10]; ?> 
        <?php show_network_img($rowview['phone1network']); ?>
        </td>
      <td><?php echo $rowview[12]; ?>
        
        <?php show_network_img($rowview['phone2network']); ?>
        </td>
      <td><?php echo $rowview[14];
      if ( $rowview[ 14 ] != "" ) {
        ?><br>
        <a href="whatsapp_handler.php?number=<?php echo "$rowview[14]&inqury_id=$rowview[0]"; ?>" target="new">
        <i class="fa fa-whatsapp text-success"></i>
        </a>
        <?php
        }
        ?></td>
      <td><?php
      if ( $rowview[ 15 ] != "" ) {
        ?>
        <a href="<?php echo $rowview[15]; ?>" target="new">
        <button>Visit Link</button>
        </a>
        <?php } ?></td>
      <td ><?php echo $rowview['record_type']; ?></td>
    </tr>
  </table>
  <table  class="table-bordered table-hover" width="100%">
    <thead>
      <tr align="center" class="mybg">
        <th>CNIC</th>
        <th>Referral</th>
        <th>Age</th>
        <th>Height</th>
        <th>Weight</th>
        <th>Marital Status</th>
        <th>Children</th>
        <th>Education</th>
        <th>Occupation</th>
      </tr>
    </thead>
    <tr align="center">
      <td><?php echo $rowview['cnic']; ?></td>
      <td><?php echo $rowview['referral']; ?></td>
      <td><?php echo $rowview['age']; ?></td>
      <td><?php echo $rowview['height']; ?></td>
      <td><?php echo $rowview['weight']; ?></td>
      <td><?php echo $rowview['marital_status']; ?></td>
      <td><?php echo $rowview['children']; ?></td>
      <td><?php echo $rowview['education']; ?></td>
      <td><?php echo $rowview['occupation']; ?></td>
    </tr>
  </table>
<!--
      
  <table  class="table-bordered table-hover" width="100%">
    <thead>
      <tr align="center" class="mybg">
        <th colspan="3" >Symptoms</th>
      </tr>
      <tr>
        <th>SN</th>
        <th>Symptom</th>
        <th>Description</th>
      </tr>
    </thead>
    <?php
    $i = 1;
    $sqlsymp = "SELECT symptom_name,description FROM `symptom_inquiry` WHERE inquiry_id='$id'";
    $querysymp = mysqli_query( $con, $sqlsymp );
    while ( $rowsymp = mysqli_fetch_array( $querysymp ) ) {

      ?>
    <tr align="center">
      <td><?php echo $i; ?></td>
      <td><?php echo $rowsymp[0]; ?></td>
      <td><?php echo $rowsymp[1]; ?></td>
    </tr>
    <?php $i++; } ?>
  </table>
      
-->
  <form method="post" action="update_inquiry.php">
      <input type="hidden" name="page" value="<?php echo $currentPage ?>">
    <input type="hidden" name="id" value="<?php echo $rowview[0]; ?>">
    <table  class="table-bordered table-hover" width="100%">
      <thead>
        <tr align="center" class="mybg">
          <th>Call Status</th>
          <th>Called At</th>
          <th>Recall Date</th>
          <th>Order Status</th>
          <th>Order Confirmed At</th>
          <th>Committed Amount</th>
<!--          <th>Appointment At</th>-->
        </tr>
      </thead>
      <tr align="center">
        <td><?php echo $rowview[16]; ?>
          <select name="call_status" class="form-select" required>
            <?php populateDDsel("status_list  ORDER BY status_name='Pending' DESC , status_name='Scammer' ASC,status_name='Died' ASC,status_name='Personal Relation' ASC,status_name='Non-Serious' ASC,status_name='Bargaining' ASC;","status_name","status_name","$rowview[16]") ?>
          </select></td>
        <td><?php echo $rowview[17]; ?></td>
        <td><input type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" max="<?php echo date('Y-m-d\TH:i', strtotime('+10 day')); ?>" required name="recall_date" class="form-control" ></td>
        <td><select name="order_status"  class="form-select">
            <?php populateDDsel("order_status WHERE sort <= 10 ORDER BY sort","order_status","order_status","$rowview[19]") ?>
            <?php
            if ( $rowview[ 'name' ] != "" && $rowview[ 'address1' ] != "" && $rowview[ 'phone1' ] != "" && $rowview[ 'record_type' ] == "Patient" ) {
              if ( check_admin( $_SESSION[ 'email' ] ) ) {
                ?>
            <option <?php if($rowview['order_status']=="Agreed To Order") { echo " Selected"; } ?>>Agreed To Order</option>
            <?php } } ?>
          </select></td>
             <datalist id="suggestions">
            <?php
             populateDD("status_suggestions","suggestion","suggestion");
             ?>
            </datalist>
        <td><input type="datetime-local" name="order_confirmed_at"  class="form-control"  value="<?php echo $rowview[20]; ?>"></td>
        <td><input type="number" name="committed_amount"  class="form-control"  value="<?php echo $rowview['committed_amount']; ?>"></td>
<!--        <td><input type="datetime-local" name="appointment_at"  class="form-control"  value="<?php echo $rowview[21]; ?>"></td>-->
      </tr>
        <tr>
        
          <td align="center"  class="mybg"  colspan="12"><strong>Comment</strong></th>
        </tr>
        <tr>
            
         <td colspan="12">
             <?php   echo $rowview[22] ?>
             <input type="text" placeholder="Comment" required name="comments" class="form-control" id="myTextarea" list="suggestions"></textarea>
      
          </td>
        </tr>
    </table>
    <table  class="table-bordered table-hover" width="100%">
      <thead>
        <tr align="center" class="mybg" >
          <th>Allocated To</th>
          <th>Allocated At</th>
          <th>Created By</th>
          <th>Created At</th>
          <th>Last Activity</th>
        </tr>
      </thead>
      <tr align="center">
        <td><?php echo $rowview[23]; ?></td>
        <td><?php echo $rowview[24]; ?></td>
        <td><?php echo $rowview[25]; ?></td>
        <td><?php
        if ( check_admin( $_SESSION[ 'email' ] ) ) {
          echo $rowview[ 26 ];
        }
        ?></td>
        <td><?php echo $rowview[27]; ?></td>
      </tr>
    </table>
</div>
    <div class="col-12 text-center"> <br>
      <input type="submit" name="submit" value="Save Changes" class="btn-sm btn-primary">
      <input type="reset" class="btn-sm btn-secondary" value="Clear All">
    </div>
    </div>
    </div>
  </form>
</div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>