<?php
include("config.php");
include("allFunctions.php");

	$name=$_REQUEST['name'];
$sqlview="SELECT * FROM `symptoms` WHERE symptom_name='$name'";
							$queryview=mysqli_query($con,$sqlview);
$rowview=mysqli_fetch_array($queryview);
							
if(isset($_REQUEST['submit']))
{
		$symptom_name=$_REQUEST['symptom_name'];
	$sort=$_REQUEST['sort'];
	$active=$_REQUEST['active'];
	$for_inquiry=$_REQUEST['for_inquiry'];
    
		$category=strtoupper($_REQUEST['category']);
	


	$old_name=$_REQUEST['old_name'];

	$sql="UPDATE `symptoms` SET `symptom_name` = '$symptom_name', `category` = '$category', `sort` = '$sort', `active` = '$active', `for_inquiry` = '$for_inquiry' WHERE `symptoms`.`symptom_name` = '$old_name'";
//	echo $sql;
	$query=mysqli_query($con,$sql);
header("Location: manage_symptoms.php");	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="background-color: grey">
			
		
			<form>
                <input type="hidden" value="<?php echo $rowview[0]; ?>" name="old_name">
			<div class="border col-lg-12">
				<div class="form-group vAlign">
						<label><strong>Symptom Name:</strong> <input class="form-control input-lg" placeholder="Enter Symptom Name" type="text" value="<?php echo $rowview[0]; ?>" name="symptom_name" required> </label>
                    <br/>
					<br/>
                    <label><strong>Category:</strong> <input class="form-control input-lg" placeholder="Enter Category Name" type="text" value="<?php echo $rowview['category']; ?>" name="category" required> </label>
					
					<br/>
					<br/>
					<label class=""><strong>Sorting:</strong> 
                    <select name="sort" class="form-select">
                        
                        <option><?php echo $rowview[1] ?></option>
                        <option value="0">Top</option>
                        <option value="1">Normal</option>
                    </select>
                        <br/>
					
					<label class=""><strong>Active:</strong> 
                    <select name="active" class="form-select">
                        
                        <option value="<?php echo $rowview[2]; ?>"><?php echo showbool($rowview[2]); ?></option>
                        <option value="1" >Yes</option>
                        <option value="0">No</option>
                    </select>
                    </label>
                        <br/>
					<br/>
					<label class=""><strong>Use In Inquiry:</strong> 
                    <select name="for_inquiry" class="form-select">
                        
                        <option  value="<?php echo $rowview[3]; ?>"><?php echo showbool($rowview[3]) ?></option>
                        <option value="1" >Yes</option>
                        <option value="0">No</option>
                    </select>
                    </label>
					<br/>
					<br/>
					<br>
					<br>
					<input type="submit" value="Update" name="submit" class="btn-sm btn-success">
				</div>
			</div>
		</div>
			</form>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>