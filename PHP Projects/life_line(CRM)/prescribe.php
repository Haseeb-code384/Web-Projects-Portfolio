<title>Prescribe Medicine</title>
<?php
include("config.php");
$id=$_REQUEST['id'];
?>

<img src="img/rx.jpg">
<form action="process_prescribe.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>"
  
    <?php include("search_product_box.php"); ?>
    <input type="text" name="quantity" placeholder="Quantity">
    <br>
    <textarea  name="comments" placeholder="Dosage/Comments"></textarea>
    <br>
    <input type="submit" value="Add" name="submit">
</form>
<?php 
include("inquiry_details.php");
 ?>