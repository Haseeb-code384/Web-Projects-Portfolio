<?php
require_once("config.php");
require_once("allFunctions.php");
$active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="view_user_inquiry_date.php";
 if(isset($_REQUEST['start_date']))
    {
        $start_date=$_REQUEST['start_date'];
    $end_date=$_REQUEST['end_date'];
    }
    else
    {
         $start_date=date("Y-m-01");
    $end_date=$date;
    }
    
//$page_names=;
//$count_pages=count($page_names);
?>
<script>
function refreshpage(x)
    {
       // alert(x);
         var s_date=document.getElementById("start_date").value;
        var e_date=document.getElementById("end_date").value;
         if(x=="view_user_inquiry_date.php")
            {
                window.location.href=x+"?start_date="+s_date+"&end_date="+e_date;
            }
        else
            {
              
        window.location.href=x+"&start_date="+s_date+"&end_date="+e_date; 
            }
        
    }
</script>
    <form>
<div class="row">
    <div class="col-4">
        Start Date
        <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
    </div> 
    <div class="col-4">
        End Date
        <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
    </div>
     <div class="col-4">
         Filter
        <select onChange="refreshpage(this.value);" class="form-select">
            <option value="#" selected>Select</option>
              <option value="<?php echo $this_page_name; ?>" <?php if(!isset($_REQUEST['order_status'])||!isset($_REQUEST['call_status']))
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
            
  
            
            <?php $i=0;
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?order_status=".$page_names[0];
    $order_status="";
  if(isset($_REQUEST['order_status']))
  {
      $order_status=$_REQUEST['order_status'];
  }
            ?>
  
           <option  <?php if($page_names[0]==$order_status)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?></option>
            <?php $i++; } 
            ?>
            <option disabled>------Calls------</option>
            <?php
             $sqlpg="SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
       
while($page_names=mysqli_fetch_array($querypg))
             {
    $page_link=$this_page_name."?call_status=".$page_names[0];
     $call_status="";
  if(isset($_REQUEST['call_status']))
  {
      $call_status=$_REQUEST['call_status'];
  }
            ?>
  
           <option  <?php if($page_names[0]==$call_status)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?></option>
            <?php } 
            
            
            
            ?>
</select>
    </div>
    
<!--
  <div class="col-3">
        .
        <input type="submit" class="form-control btn-primary" value="Filter">
    </div>
-->
 </form>
   
    </div>