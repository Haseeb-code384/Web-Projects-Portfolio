<?php
include("config.php");
?>
	<option value="">Choose Ledger</option>
	<?php
	$sql = "SELECT head_name FROM `account_head` order by sort";
	$result = mysqli_query( $con, $sql );
	while ( $row = mysqli_fetch_array( $result ) ) 
	{
		?>

	<optgroup label="<?php echo $row['head_name'];?>">
		<?php 
			$sql2="SELECT id,subhead_name FROM `account_subhead` WHERE head_name='$row[0]'";
			$query2=mysqli_query($con,$sql2);
			while($row2=mysqli_fetch_array($query2))
			{
				
			  ?>
		<optgroup label="&nbsp;&nbsp;&nbsp; <?php echo $row2[1]; ?>">
			<?php
			$sql3 = "SELECT m_accountid,account FROM `master_account` WHERE accounttype='$row2[0]' order by account";
			echo $sql3;
			$query3 = mysqli_query( $con, $sql3 );
			while ( $row3 = mysqli_fetch_array( $query3 ) ) {
				?>
			<option value="<?php echo $row3[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo  $row3[1] ?> </option>
			<?php } ?>
		</optgroup>
		<?php 
			}
															 ?>
	</optgroup>
	<?php
	}
	?>
