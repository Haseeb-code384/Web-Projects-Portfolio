<?php
require_once( "config.php" );
require_once( "allFunctions.php" );
$active = "";
$currentpage = basename( $_SERVER[ 'REQUEST_URI' ] );
$currentpage = str_replace( "%20", " ", $currentpage );
$this_page_name = "chart-of-account.php";

//$page_names=;
//$count_pages=count($page_names);
?>
<center>
<div class="col-sm-6">
<select class="form-control" onChange="window.location.href=this.value">
  <?php
  //   for($i=0;$i<$count_pages;$i++)
  if ( check_admin( $_SESSION[ 'email' ] ) ) {

    $sqlpg = "SELECT subhead_name,id,description FROM `account_subhead` order by head_name";
  } else {
    $sqlpg = "SELECT subhead_name,id,description  FROM `account_subhead` WHERE id IN (SELECT DISTINCT accounttype FROM `master_account` WHERE m_accountid IN(SELECT DISTINCT account_id FROM `m_account_permission`  WHERE username='$_SESSION[email]')) order by head_name";
  }

  $querypg = mysqli_query( $con, $sqlpg );
  ?>
  <option value="<?php echo $this_page_name; ?>" <?php if($currentpage==$this_page_name){    echo 'selected';} ?> >All</a> </option>
  <?php
  while ( $page_names = mysqli_fetch_array( $querypg ) ) {
    $page_link = $this_page_name . "?account_type=" . $page_names[ 1 ];
    ?>
  <option value="<?php echo $page_link; ?>" style="background-color: <?php echo $page_names[2] ?>;"  <?php if($currentpage==$page_link)
{
    echo 'selected';
} ?> ><?php echo $page_names[0]; ?></a> </option>
  <?php } ?>
</select>
</div>
</center>