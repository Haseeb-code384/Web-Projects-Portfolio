<?php
include('config.php');
include('allFunctions.php');
$page_head="Account Head";
$page_name="Account Sub Head";
if($_REQUEST['subhead'])
{
	$subhead=$_REQUEST['subhead'];
	$sql="SELECT * FROM `account_subhead` WHERE id='$subhead' ";
		$query=mysqli_query($con,$sql);
		
if(isset($_REQUEST['submit']))
{
	$bgroup=$_REQUEST['bgroup'];
	$subheadname=$_REQUEST['subheadname'];
	$desc=$_REQUEST['desc'];
	$sql="UPDATE `account_subhead` SET head_name='$bgroup', subhead_name='$subheadname', description='$desc' WHERE id='$subhead'";
	$query=mysqli_query($con,$sql);
    	if($query)
    {
        alertredirect("Saved Successfully","manage_account_subhead.php");
    }
    else
    {
        alertredirect("Something Went Wrong!!!","manage_account_subhead.php");
    }
    
	
?>
<script> window.close();</script>

<?php 
}

}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
</head>


<body>
<?php include('start.php'); ?>
<center>
<form method="post">
	<h1>Edit <?php echo ucfirst($page_name); ?></h1>
	<br><strong>
		<label ><?php echo ucfirst($page_name); ?> ID</label></strong>
	<br>
	<input type="text" readonly required name="subhead" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Name"  value="<?php $row=mysqli_fetch_array($query); echo $row[0]; ?>" >
	<strong>
		<label><?php echo $page_head; ?></label></strong>
	<br>
	<select name="bgroup" required class="form-control col-2">
		<?php populateDDsel("account_head","head_name","head_name",$row[1]) ?>
	</select>
	<br>
	
	<strong>
		<label ><?php echo ucfirst($page_name); ?> Name</label></strong>
	<br>
	<input type="text" required name="subheadname" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Sort"  value="<?php  echo $row[2] ?>" >
	<br>
	<strong>
		<label ><?php echo ucfirst($page_name); ?> Description</label></strong>
	<br>
	<input type="text" name="desc" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Sort"  value="<?php  echo $row[3] ?>" >
	<br>
	<input type="submit" name="submit" value="Update Now" class="btn-sm btn-lg form-group btn-primary col-2">

	<br>
	<br>
	<br>
	<br>
</form>
    
</body>
</html>
