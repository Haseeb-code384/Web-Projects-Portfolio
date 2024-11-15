<?php
include("../config.php");
	$files1 = scandir("../");
	$cfile=count($files1);


?>
<!doctype html>
<html>
<head>
	<script type="application/javascript">
	function sbmt()
		{
			document.getElementById("myForm").submit();
		}
	</script>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

<meta charset="utf-8">
<title>Nav Editor</title>
	
</head>

<body style="width: 95%;">
	
	<button><a href="fa_helper.php" target="new">FA Helper</a>
	</button><button>
	<a href="add_menu_item.php" target="new">Add Menu Item</a></button>
<div  style="width: 95%;">
			<table>
		<tr align="center">
		<td>Delete</td>	
		<td>id</td>	
		<td>name</td>	
		<td>pid</td>	
		<td>link</td>	
		<td>status</td>	
		<td>Sort</td>	
		<td>fa</td>	
		</tr>
			<form action="update.php" id="myForm">
			<?php
				$sqlpar="select * from menu where parent_id='0'  order by sort Asc";
	$querpar=mysqli_query($con,$sqlpar);
	while($rowpar=mysqli_fetch_array($querpar))
	{
	$menu_id_par=$rowpar[0];
			
			?>
				<tr>
				<th colspan="7" align="center" style="background-color: grey;"><h3><?php echo $rowpar[1]; ?></h3></th></tr>
			<tr height="30" <?php if($rowpar[2]=="0"){echo ("bgcolor='brown'"); } ?>>
				<td><a href="del_item.php?id=<?php echo $rowpar[0];?>">Delete</a></td>
				<td><input type="text" name="id[]" value="<?php echo $rowpar[0]; ?>"></td>
				<td><input type="text" value="<?php echo $rowpar[1]; ?>"  name="v[]" ></td>
				<td>
				<select  name="p[]">
					<option><?php echo $rowpar[2]; ?></option>
					<option style="background-color: brown;">0 Make Parent</option>
					<?php $sqlp="select menu_id,menu_name from menu";
					$queryp=mysqli_query($con,$sqlp);
				
		while($rowp=mysqli_fetch_array($queryp))
		{
					?>
					<option value="<?php echo $rowp[0];?> "><?php echo $rowp[0]." | ".$rowp[1]; ?></option>
					<?php } ?>
				</select>
				</td>
				<td>
<!--					<input type="text" value="<?php echo $rowpar[3]; ?>"  name="l[]" >-->
			
	<select name="l[]" onChange="sbmt();">
		<option>#</option>
		
		<?php for($i=0;$i<$cfile;$i++){ ?>
		
	<option <?php if($rowpar[3]==$files1[$i]){ echo "selected"; } ?>>
		<?php echo $files1[$i]; ?></option>
		
		<?php } ?>
	</select>
	
				</td>
				<td><input style="background-color: <?php if($rowpar[4]==0) echo 'red'; ?>" type="text" value="<?php echo $rowpar[4]; ?>"  name="s[]" ></td>
				<td><input  type="text" value="<?php echo $rowpar[6]; ?>"  name="srt[]" ></td>
				<td style="background-color: white;"> <i class="fa fa-2x <?php echo $rowpar[5]; ?>"></i>
				<a href="fa_changer.php?id=<?php echo $rowpar[0]; ?>">Change Icon</a>
				</td>
					
				</tr>
			<?php  
				
	 $sql="select * from menu where parent_id='$menu_id_par' " ;
			$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query))
		{
			?>
			<tr height="30" <?php if($row[2]=="0"){echo ("bgcolor='brown'"); } ?>>
				
				<td><a href="del_item.php?id=<?php echo $row[0];?>">Delete</a></td>
				<td><input type="text" name="id[]" value="<?php echo $row[0]; ?>"></td>
				<td><input type="text" value="<?php echo $row[1]; ?>"  name="v[]" ></td>
				<td>
				<select  name="p[]">
					<option><?php echo $row[2]; ?></option>
					<option style="background-color: brown;">0 Make Parent</option>
					<?php $sqlp="select menu_id,menu_name from menu";
					$queryp=mysqli_query($con,$sqlp);
				
		while($rowp=mysqli_fetch_array($queryp))
		{
					?>
					<option value="<?php echo $rowp[0];?> "><?php echo $rowp[0]." | ".$rowp[1]; ?></option>
					<?php } ?>
				</select>
				</td>
				<td>
<!--
					<input type="text" value="<?php echo $row[3]; ?>"  name="l[]" >
					
-->
					<select name="l[]"  onChange="sbmt();">
		<option>#</option>
		<?php for($i=0;$i<$cfile;$i++){ ?>
		
	<option <?php if($row[3]==$files1[$i]){ echo "selected"; } ?>>
		<?php echo $files1[$i]; ?></option>
		
		<?php } ?>
	</select>
				</td>
				<td><input  style="background-color: <?php if($row[4]==0) echo 'red'; ?>"  type="text" value="<?php echo $row[4]; ?>"  name="s[]" ></td>
				
				<td><input  type="text" value="<?php echo $row[6]; ?>"  name="srt[]" ></td>
				<td style="background-color: white;"> <i class="fa fa-2x <?php echo $row[5]; ?>"></i>
				<a href="fa_changer.php?id=<?php echo $row[0]; ?>">Change Icon</a>
				</td>
					
				</tr>
			<?php } 
	}
	?>
				<input type="submit" name="submit" value="update all">
				</form>
		</table>

	</div>
	
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
</body>
</html>
