<?php 
//session_start();
//$current_user=$_SESSION['email'];
include( "config.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
	
	$dtk_time=$_REQUEST['dtk_time'];
	
	executeQuery("UPDATE restrictions SET value='$dtk_time' WHERE name='dtk_time';");
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

	<?php 
include "start.php"; ?>
	</div>

	<div class="content-wrapper">
		<div class="container-fluid">
			
					
			<?php breadcrumb(); ?>
			<div class="row" style="">
				<form method="post">
					<div class="border col-lg-12">

						<div class="row">
							<div class="col-6">
									
								<label><strong  class="text-danger">DTK Time:</strong></label>
								<input type="time" class="form-control" required value="<?php echo showQuery("SELECT value FROM `restrictions` WHERE name='dtk_time'"); ?>" name="dtk_time">
							</div>
							</div>




						<div class="col-12 text-center">
							<br>
							<input type="submit" name="submit" class="btn-sm btn-success" value="Update">
						</div>

					</div>
			</div>
			</form>
			
		</div>
	</div>
	<br>
	<br>
	<br>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>

	<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>