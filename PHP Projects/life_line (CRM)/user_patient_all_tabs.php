<?php
require_once("config.php");
require_once("allFunctions.php");
$active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="view_user_patient_all.php";

//$page_names=;
//$count_pages=count($page_names);
?>

        <select onChange="window.location.href=this.value" class="form-select col-6 offset-md-3">
              <option value="<?php echo $this_page_name; ?>" <?php if($currentpage==$this_page_name)
{
    echo 'selected';
} ?>>All</option>
   
            <option disabled>------Orders------</option>
            <?php
         //   for($i=0;$i<$count_pages;$i++)
            $sqlpg="SELECT * FROM `order_status` ORDER BY `order_status`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
            
    $page_link=$this_page_name."?cat=".$page_names[0];
            ?>
            
  
            
            <?php
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?order_status=".$page_names[0];
            ?>
  
           <option  <?php if($currentpage==$page_link)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Orders</option>
            <?php } 
            ?>
            <option disabled>------Calls------</option>
            <?php
             $sqlpg="SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
       
while($page_names=mysqli_fetch_array($querypg))
             {
    $page_link=$this_page_name."?call_status=".$page_names[0];
            ?>
  
           <option  <?php if($currentpage==$page_link)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Calls</option>
            <?php } 
            
            
            
            ?>
</select>
    