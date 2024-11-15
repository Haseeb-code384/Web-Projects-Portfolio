<?php
require_once( "config.php" );
require_once( "allFunctions.php" );
$active = "";
$this_page_name = "view_inquiry.php";
if ( !isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $date;
  $end_date = $date;
}

?>

<script src="semester.js"></script> 
<form method="get">
  <script>
     function show_filters()           
{
    if ( document.getElementById("eye").classList.contains('fa-filter') )
        {
          document.getElementById("eye").classList.remove('fa-filter');
    document.getElementById("eye").classList.add('fa-times-circle-o');
document.getElementById("filters").style.display="flex";   
        }
    else
        {
            
    document.getElementById("eye").classList.remove('fa-times-circle-o');
          document.getElementById("eye").classList.add('fa-filter');
document.getElementById("filters").style.display="none";   
        }
   
}
        </script>
  <center>
    <i class="fa fa-2x fa-filter" title="Show Filters" id="eye" onClick="show_filters()"> Filter</i>
  </center>
  <div class="row" id="filters" style="display: none;">
    <div class="col-sm-2">
      <label><strong>Date Type</strong></label>
      <select class="form-select" name="date_type">
        <option  value="date_type">Any Date</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(created_at)")  {    echo 'selected'; } } ?>  value="date(created_at)" >Created At</option>
        <option  <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(allocated_at)")  {    echo 'selected'; } } ?>  value="date(allocated_at)">Allocated At</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(order_confirmed_at)")  {    echo 'selected'; } } ?> value="date(order_confirmed_at)">Order Confirmed At</option>
        <option  <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(last_updated_at)")  {    echo 'selected'; } } ?>  value="date(last_updated_at)">Last Updated At</option>
        <option   <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="expected_reorder_date")  {    echo 'selected'; } } ?> value="expected_reorder_date">Expected Reorder Date</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="patient_since")  {    echo 'selected'; } } ?>  value="patient_since">Patient Since</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(appointment_at)")  {    echo 'selected'; } } ?>  value="date(appointment_at)">Appointment At</option>  
          <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(recall_date)")  {    echo 'selected'; } } ?>  value="date(recall_date)">Recall Date</option> 
          <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="record_date")  {    echo 'selected'; } } ?>  value="record_date">Record Date</option>
      </select>
    </div>
    <div class="col-sm-2">
      <label><strong>Start Date</strong></label>
      <input type="date" class="form-control" name="start_date" value="<?php echo $start_date ?>">
    </div>
    <div class="col-sm-2">
      <label><strong>End Date</strong></label>
      <input type="date" class="form-control" name="end_date"  value="<?php echo $end_date ?>">
    </div>
    <div class="col-sm-2">
      <label><strong>Order Status</strong></label>
      <select name="order_status" class="form-select">
        <option value="order_status">Any Order</option>
        <?php
        //   for($i=0;$i<$count_pages;$i++)
        $sqlpg = "SELECT * FROM `order_status` Where sort <=20 ORDER BY sort ASC";
        $querypg = mysqli_query( $con, $sqlpg );
        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          $page_link = $this_page_name . "?order_status=" . $page_names[ 0 ];
          ?>
        <option style="background-color: <?php echo $page_names['color'] ?>"  <?php if ( isset( $_REQUEST[ 'order_status' ] ) ) { if($_REQUEST[ 'order_status' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col-sm-2">
      <label><strong>Call Status</strong></label>
      <select name="call_status" class="form-select">
        <option value="call_status">Any Call</option>
        <?php
        $sqlpg = "SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          $page_link = $this_page_name . "?call_status=" . $page_names[ 0 ];
          ?>
        <option style="background-color: <?php echo $page_names['color'] ?>"  <?php if ( isset( $_REQUEST[ 'call_status' ] ) ) { if($_REQUEST[ 'call_status' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col-sm-2">
      <label><strong>Gender</strong></label>
      <select name="gender" class="form-select ">
        <option value="gender">Any Gender</option>
        <?php
        $sqlpg = "SELECT DISTINCT gender FROM `inquiry` WHERE gender IN ('Male','Female')";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          $page_link = $this_page_name . "?gender=" . $page_names[ 0 ];
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'gender' ] ) ) { if($_REQUEST[ 'gender' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col-sm-2">
      <label><strong>Phone 1 Network</strong></label>
      <select name="phone1network" class="form-select ">
        <option value="phone1network">Any Network</option>
        <?php
        $sqlpg = "SELECT * FROM `network` order by network asc";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'phone1network' ] ) ) { if($_REQUEST[ 'phone1network' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>   
         <div class="col-sm-2">
      <label><strong>Phone 2 Network</strong></label>
      <select name="phone2network" class="form-select ">
        <option value="phone2network">Any Network</option>
        <?php
        $sqlpg = "SELECT * FROM `network` order by network asc";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'phone2network' ] ) ) { if($_REQUEST[ 'phone2network' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>      
    <div class="col-sm-2">
      <label><strong>Disease</strong></label>
      <select name="disease" class="form-select">
        <option value="disease">Any Disease</option>
        <option>IS NULL</option>
        <?php
        $sqlpg = "SELECT * FROM `disease_category`  order by disease_category asc";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  style="background-color: <?php echo $page_names['color'] ?>"   <?php if ( isset( $_REQUEST[ 'disease' ] ) ) { if($_REQUEST[ 'disease' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
      <div class="col-sm-2">
      <label><strong>Source</strong></label>
      <select name="source" class="form-select ">
        <option value="source">Any Source</option>
        <?php
        $sqlpg = "SELECT * FROM `source_platform` ORDER BY source_platform";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'source' ] ) ) { if($_REQUEST[ 'source' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>    
      
      <div class="col-sm-2">
      <label><strong>Record Type</strong></label>
      <select name="record_type" class="form-select ">
        <option value="record_type">Any Source</option>
        <?php
        $sqlpg = "SELECT * FROM `patient_record_type`";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'record_type' ] ) ) { if($_REQUEST[ 'record_type' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>     
      <div class="col-sm-2">
      <label><strong>Age</strong></label>
      <select name="age" class="form-select ">
        <option value="age">Any Age</option>
        <?php
        $sqlpg = "SELECT DISTINCT age FROM `inquiry`  WHERE age!=''  ORDER BY `inquiry`.`age` ASC";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'age' ] ) ) { if($_REQUEST[ 'age' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>        
      
      <div class="col-sm-2">
      <label><strong>Committed Amount</strong></label>
      <select name="committed_amount" class="form-select ">
        <option value="committed_amount">Any Committed Amount</option>
        <?php
        $sqlpg = "SELECT DISTINCT committed_amount FROM `inquiry`  WHERE committed_amount!='' ORDER BY `inquiry`.`committed_amount` ASC";
        $querypg = mysqli_query( $con, $sqlpg );

        while ( $page_names = mysqli_fetch_array( $querypg ) ) {
          ?>
        <option  <?php if ( isset( $_REQUEST[ 'committed_amount' ] ) ) { if($_REQUEST[ 'committed_amount' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>   
   
       <div class="col-sm-2">
          <label class=""><strong>Province</strong></label>
          <select name="province" id="province"  onChange="change_dist(this.value);"  class="form-select">
              <option value="province">Any Province</option>
            <?php populateDDdistinctSel("province","tehsils",$_REQUEST['province']) ?>
          </select>
        </div>
        <div class="col-sm-2">
          <label class=""><strong>District</strong></label>
          <select name="district" onChange="change_Tehsil(this.value);" id="district"  class="form-select">
            <option value="district">Any District</option>
            <?php populateDDdistinct("district","tehsils",$_REQUEST['district']) ?>
          </select>
        </div>
      <div class="col-sm-2">
          <label class=""><strong>Tehsil</strong></label>
          <select name="tehsil" id="tehsil"  class="form-select">
            <option  value="tehsil">Any Tehsil</option>
            <?php populateDDdistinct("tehsil","tehsils",$_REQUEST['tehsil']) ?>
          </select>
        </div>
      
      
    <div class="col-sm-2">
      <label><strong>Record Limit</strong></label>
      <input title="Limit" type="text" class="form-control" name="limit" value="<?php echo $_REQUEST['limit']; ?>">
    </div>
    <div class="col-sm-2">
      <?php include("admin_selective_user_dropdown.php"); ?>
    </div>
    <input type="submit" value="Filter" class="btn-sm btn-primary col-sm-12">
  </div>
</form>
