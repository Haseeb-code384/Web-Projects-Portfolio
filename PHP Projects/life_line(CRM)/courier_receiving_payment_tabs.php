<?php
require_once( "config.php" );
require_once( "allFunctions.php" );
$active = "";
$currentpage = basename( $_SERVER[ 'REQUEST_URI' ] );
//$currentpage = str_replace( "%20", " ", $currentpage );
$this_page_name = "view_products.php";

//$page_names=;
//$count_pages=count($page_names);
?>
<ul class="nav nav-tabs">

  <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="receive_courier_payment.php")
{
    echo 'active';
} ?>" aria-current="page" href="receive_courier_payment.php">Receive Parcel Payment</a> </li>
    
  <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="receiver_courier_payment_list.php")
{
    echo 'active';
} ?>" aria-current="page" href="receiver_courier_payment_list.php">View Date Wise Receivings</a> </li>
 
    <li class="nav-item "> <a class="nav-link  <?php if($currentpage=="receiver_courier_payment_list.php?start_date=1970-01-01&end_date=$date&submit=Filter")
{
    echo 'active';
} ?>" aria-current="page" href="receiver_courier_payment_list.php?start_date=1970-01-01&end_date=<?php echo $date; ?>&submit=Filter">View All Receivings</a> </li>

</ul>
