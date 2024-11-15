<?php
include("config.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
	<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $project_name; ?></title>
</head>
<body class="fixed-nav" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#"><?php echo $project_name; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            
			
			<?php
					$sql1="SELECT * FROM `menu` WHERE parent_id=0 AND status='1'";
					$query1=mysqli_query($con,$sql1);
					while($row1=mysqli_fetch_array($query1))
					{
						$parent_id=$row1[0];
						
						if($row1[0]==1)
						{
							?>
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-dashboard"></i>
                    <span class="nav-link-text">Home</span>
                </a>
            </li>
			<?php
						}
						else
						{
					?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="<?php echo $row1[1]; ?>">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#<?php echo $row1[0];  ?>" data-parent="#exampleAccordion">
                    <i class="fa fa-fw <?php echo $row1[5]; ?>"></i>
                    <span class="nav-link-text"><?php echo $row1[1]; ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="<?php echo $row1[0];  ?>">
                    <?php
					$sql2="SELECT * FROM `menu` WHERE parent_id=$parent_id AND status='1'";
					$query2=mysqli_query($con,$sql2);
					while($row2=mysqli_fetch_array($query2))
					{
					?>
					<li>
                        <a href="<?php echo $row2[3]; ?>"><i class="fa fa-fw <?php echo $row2[5]; ?>"></i> <?php echo $row2[1]; ?></a>
                    </li>
				<?php 	} ?>
                   
                </ul>
            </li>
			<?php }
					}
			?>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link mr-lg-2" id="messagesDropdown" href="#">
                    <i class="fa fa-fw fa-user-circle text-white"></i>
                    <span class="text-white">Welcome  </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">
                    <i class="fa fa-fw fa-sign-out text-white"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav><!-- Navigation end -->
<?php include ("includes/footer.php")?>
