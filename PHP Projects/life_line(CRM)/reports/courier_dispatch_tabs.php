<?php
require_once( "config.php" );
require_once( "allFunctions.php" );
$active = "";
$currentpage = basename( $_SERVER[ 'REQUEST_URI' ] );
//$currentpage = str_replace( "%20", " ", $currentpage );
$this_page_name = "dispatch_courier.php";

//$page_names=;
//$count_pages=count($page_names);
?>
<ul class="nav nav-tabs">

  <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="dispatch_courier.php")
{
    echo 'active';
} ?>" aria-current="page" href="dispatch_courier.php">Dispatch Parcel</a> </li>
    
  <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="dispatch_courier_list.php")
{
    echo 'active';
} ?>" aria-current="page" href="dispatch_courier_list.php">View Date Wise Dispatch</a> </li>
 
    <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="dispatch_courier_list.php?start_date=1970-01-01&end_date=$date&submit=Filter")
{
    echo 'active';
} ?>" aria-current="page" href="dispatch_courier_list.php?start_date=1970-01-01&end_date=<?php echo $date; ?>&submit=Filter">View All Dispatch</a> </li>

</ul>
