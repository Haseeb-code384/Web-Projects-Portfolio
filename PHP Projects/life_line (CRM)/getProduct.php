<?php
require_once("config.php");
if(!empty($_POST["keyword"])) {
    $k=$_POST["keyword"];
$sql ="SELECT name,item_id FROM `products` WHERE name LIKE '$k%' ORDER BY name";
$result = mysqli_query($con,$sql);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
while($row=mysqli_fetch_array($result)) 
      {
?>
<li onClick="selectValue('<?php echo $row[1]; ?>');"><?php echo $row[0]; ?></li>
<?php } ?>
</ul>
<?php } 
      
      } ?>