<?php
require_once("config.php");
require_once("allFunctions.php");
$active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="manage_symptoms.php";

//$page_names=;
//$count_pages=count($page_names);
//   for($i=0;$i<$count_pages;$i++)

            $sqlpg="SELECT DISTINCT category FROM `symptoms` ORDER BY category";
$querypg=mysqli_query($con,$sqlpg);
            ?>

<div class="row" align="center">
    <h3 align="center">Filter</h3>
        <select onChange="window.location.href=this.value" class="form-select col-6 offset-md-3">        
    <option value="<?php echo $this_page_name; ?>" <?php if($currentpage==$this_page_name)
{
    echo 'selected';
} ?>>All</option>
  
            
            <?php
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?cat=".$page_names[0];
            ?>
  
    <option  <?php if($currentpage==$page_link)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> </option>

            <?php }  ?>
</select>
    </div>