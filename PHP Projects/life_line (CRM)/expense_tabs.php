<?php
require_once( "config.php" );
require_once( "allFunctions.php" );
$active = "";
$currentpage = basename( $_SERVER[ 'REQUEST_URI' ] );
$currentpage = str_replace( "%20", " ", $currentpage );
$this_page_name = "view_expenses.php";

//$page_names=;
//$count_pages=count($page_names);
?>
<ul class="nav nav-tabs">
  <?php
  //   for($i=0;$i<$count_pages;$i++)
  $sqlpg = "SELECT DISTINCT expense_category FROM `expenses` ORDER BY expense_category ASC";
  $querypg = mysqli_query( $con, $sqlpg );
  ?>
  <li class="nav-item "> <a class="nav-link  <?php if($currentpage==$this_page_name)
{
    echo 'active';
} ?>" aria-current="page" href="<?php echo $this_page_name; ?>">All</a> </li>
  <li class="nav-item "> <a class="nav-link text-danger" aria-current="page" href="view_deleted_expenses.php">Deleted Expenses</a> </li>
  <?php
  while ( $page_names = mysqli_fetch_array( $querypg ) ) {
    $page_link = $this_page_name . "?cat=" . $page_names[ 0 ];
    ?>
  <li class="nav-item "> <a class="nav-link  <?php if($currentpage==$page_link)
{
    echo 'active';
} ?>" aria-current="page" href="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?></a> </li>
  <?php }  ?>
</ul>
