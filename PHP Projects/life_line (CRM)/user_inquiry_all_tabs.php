<?php
require_once("config.php");
require_once("allFunctions.php");
$active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="view_user_inquiry_all.php";

//$page_names=;
//$count_pages=count($page_names);
?>

<form method="post">
  <div class="row">
  <div class="col-sm-2">
    <select name="order_status" class="form-select">
      <option value="order_status">Any Order</option>
      <?php
      //   for($i=0;$i<$count_pages;$i++)
      $sqlpg = "SELECT * FROM `order_status` Where sort <=20 ORDER BY sort ASC";
      $querypg = mysqli_query( $con, $sqlpg );
      while ( $page_names = mysqli_fetch_array( $querypg ) ) {
        $page_link = $this_page_name . "?order_status=" . $page_names[ 0 ];
        ?>
      <option  <?php if ( isset( $_REQUEST[ 'order_status' ] ) ) { if($_REQUEST[ 'order_status' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="col-sm-2">
    <select name="call_status" class="form-select">
      <option value="call_status">Any Call</option>
      <?php
      $sqlpg = "SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
      $querypg = mysqli_query( $con, $sqlpg );

      while ( $page_names = mysqli_fetch_array( $querypg ) ) {
        $page_link = $this_page_name . "?call_status=" . $page_names[ 0 ];
        ?>
      <option  <?php if ( isset( $_REQUEST[ 'call_status' ] ) ) { if($_REQUEST[ 'call_status' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="col-sm-2">
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
    <select name="phone1network" class="form-select ">
      <option value="phone1network">Any Network</option>
      <?php
      $sqlpg = "SELECT * FROM `network` order by network asc";
      $querypg = mysqli_query( $con, $sqlpg );

      while ( $page_names = mysqli_fetch_array( $querypg ) ) {
        $page_link = $this_page_name . "?network=" . $page_names[ 0 ];
        ?>
      <option  <?php if ( isset( $_REQUEST[ 'network' ] ) ) { if($_REQUEST[ 'network' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="col-sm-2">
    <select name="disease" class="form-select">
      <option value="disease">Any Disease</option>
      <?php
      $sqlpg = "SELECT * FROM `disease`  order by disease asc";
      $querypg = mysqli_query( $con, $sqlpg );

      while ( $page_names = mysqli_fetch_array( $querypg ) ) {
        $page_link = $this_page_name . "?disease=" . $page_names[ 0 ];
        ?>
      <option  <?php if ( isset( $_REQUEST[ 'disease' ] ) ) { if($_REQUEST[ 'disease' ]==$page_names[0])  {    echo 'selected'; } } ?> 
          ><?php echo $page_names[0]; ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="col-sm-2">
    <?php include("admin_selective_user_dropdown.php"); ?>
  </div>
  <input type="submit" value="Filter" class="btn-sm btn-primary col-sm-1">
</form>
