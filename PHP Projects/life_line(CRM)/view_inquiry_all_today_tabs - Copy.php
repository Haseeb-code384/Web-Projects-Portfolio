<?php
require_once("config.php");
require_once("allFunctions.php");
$active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="view_inquiry_today.php";

//$page_names=;
//$count_pages=count($page_names);
?>
        <ul class="nav nav-tabs">
            <?php
         //   for($i=0;$i<$count_pages;$i++)
            $sqlpg="SELECT * FROM `order_status` ORDER BY `order_status`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
            ?>
            <li class="nav-item ">
                
    <a class="nav-link  <?php if($currentpage==$this_page_name)
{
    echo 'active';
} ?>" aria-current="page" href="<?php echo $this_page_name; ?>">All</a>
  </li>
  
            
            <?php
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?order_status=".$page_names[0];
            ?>
  <li class="nav-item ">
    <a class="nav-link  <?php if($currentpage==$page_link)
{
    echo 'active';
} ?>" aria-current="page" href="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Orders</a>
  </li>
            <?php } 
            
             $sqlpg="SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
       
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?call_status=".$page_names[0];
            ?>
  <li class="nav-item ">
    <a class="nav-link  <?php if($currentpage==$page_link)
{
    echo 'active';
} ?>" aria-current="page" href="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Calls</a>
  </li>
            <?php } 
            
            
            
            ?>
</ul>