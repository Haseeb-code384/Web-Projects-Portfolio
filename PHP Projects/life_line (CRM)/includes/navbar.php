<?php
include("config.php");
function timeAgo($lastUpdated) {
    $lastUpdatedDateTime = new DateTime($lastUpdated);
    $currentDateTime = new DateTime();
    
    $interval = $lastUpdatedDateTime->diff($currentDateTime);
    
    $years = $interval->y;
    $months = $interval->m;
    $weeks = floor($interval->days / 7);
    $days = $interval->d;
    $minutes = $interval->i;
    $seconds = $interval->s;
    
    $output = '';
    
    if ($years > 0) {
        $output .= "$years Year" . ($years > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    if ($months > 0) {
        $output .= "$months Month" . ($months > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    if ($weeks > 0) {
        $output .= "$weeks Week" . ($weeks > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    if ($days > 0) {
        $output .= "$days Day" . ($days > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    if ($minutes > 0) {
        $output .= "$minutes Minute" . ($minutes > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    if ($seconds > 0) {
        $output .= "$seconds Second" . ($seconds > 1 ? 's' : '') . ' ';
        return $output . "Ago";
    }
    
    return 'Just Now';
}
$currentpage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$pg='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
mysqli_query($con,"INSERT INTO `user_activity` (`id`, `user_name`, `page`, `timestamp`, `ip`) VALUES (NULL, '$_SESSION[email]', '$pg', '$currentDateTime','$_SERVER[REMOTE_ADDR]')");

?>
<!doctype html>
<html>
<head>
    <style>
    #mover:hover
        {
            background-color: red;
            color: white;
        }
      
    </style>
    <meta charset="UTF-8">
	<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $project_name; ?></title>
      
</head>
<body class="fixed-nav sidenav-toggled" id="page-top">
<!-- Navigation-->
 
   
<nav class="navbar navbar-expand-lg navbar-light fixed-top"  style="border: 4px solid red; background-color: black; color: white; background-image: url(img/header.gif); background-size: contain;" id="mainNav">
    <a   id="navbrand" class="navbar-brand"  href="index.php" title="Home" style="color: white;"><?php echo $project_name; ?></a>
    
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="background-color: red;"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarResponsive" >
     
        <ul class="navbar-nav navbar-sidenav"  style=" margin-left: -3px; border-right: 4px solid red; border-left: 4px solid red;border-top: 4px solid red; background-color:black; overflow: hidden;" id="exampleAccordion">
       
			
			<?php
			
$uid=$_SESSION['uid'];
					$sql1="SELECT * FROM menu,menu_user_permissions WHERE parent_id=0 AND status='1' AND menu.menu_id=menu_user_permissions.menu_id AND menu_user_permissions.user_id='$uid' order by sort Asc";

					$query1=mysqli_query($con,$sql1);
					while($row1=mysqli_fetch_array($query1))
					{
						$parent_id=$row1[0];
						
						if($row1[0]==1)
						{
							?>
			<li class="nav-item" data-toggle="tooltip" data-placement="right"  title="Home" >
                <a   class="nav-link" href="index.php" id="cl" style="color: white;">
                    <i class="fa fa-home"></i>
                    <span class="nav-link-text">Home</span>
                </a>
            </li>
			<?php
						}
						else
						{
							$parentactive=mysqli_fetch_array(mysqli_query($con,"SELECT parent_id FROM `menu` WHERE link='$currentpage'"));
							
					?>
            <li class="nav-item " data-toggle="tooltip" data-placement="right" title="<?php echo $row1[1]; ?>">
                <a   class="nav-link nav-link-collapse collapsed <?php if($parentactive[0]==$row1[0]){echo 'bg-danger';} ?>"  title="<?php echo $row1['description']; ?>" data-toggle="collapse" href="#<?php echo $row1[0];  ?>" data-parent="#exampleAccordion" style="color: white;">
                    <i class="fa fa-fw <?php echo $row1[5]; ?>"></i>
                    <span class="nav-link-text"><?php echo $row1[1]; ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="<?php echo $row1[0];  ?>">
                    <?php
					$sql2="SELECT * FROM menu,menu_user_permissions WHERE parent_id=$parent_id AND status='1' AND menu.menu_id=menu_user_permissions.menu_id AND menu_user_permissions.user_id='$uid'  order by sort Asc";
					$query2=mysqli_query($con,$sql2);
					while($row2=mysqli_fetch_array($query2))
					{
					?>
					<li  class="<?php if($row2[3]==$currentpage){echo 'active';} ?>">
                        <a   id="mover" style="color: white;"  title="<?php echo $row2['description']; ?>" href="<?php echo $row2[3]; ?>"><i  class="fa fa-fw <?php echo $row2[5]; ?>"></i> <?php echo $row2[1]; ?></a>
                    </li>
				<?php 	} ?>
                   
                </ul>
            </li>
			<?php }
					}
			?>
        </ul>
        <ul class="navbar-nav sidenav-toggler bg-dark" style=" margin-left: -3px;">
            <li class="nav-item">
                <a target="new"  class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
						  
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" id="notification-trigger">
          <div class="dropdown nav-link text-white">
            <div id="notification-trigger" class="d-flex align-items-center notification-icon">
                <i class="fa fa-bell"></i>
                <span class="badge badge-danger ml-2">0</span>
            </div>
            <div class="dropdown-menu" aria-labelledby="notification-trigger">
                <a target="new"  class="dropdown-item" href="#">No Notifications</a>
            </div>
        </div>
            </li> 
          
            <li class="nav-item" id="notification-trigger">
          <div class="dropdown nav-link text-white">
            <div id="notification-trigger" class="d-flex align-items-center notification-icon" title="Online Users: &#013
                                                                                                      <?php
                                                                                                     $q_users=mysqli_query($con,"SELECT user_name,max(timestamp)
FROM user_activity
WHERE user_name!='' AND date(timestamp) = CURRENT_DATE
AND (timestamp >= NOW() - INTERVAL 1 HOUR) GROUP BY user_name  
ORDER BY `max(timestamp)` DESC;"); while($row_users=mysqli_fetch_array($q_users))
                                                                                                          {
                                                                                                          echo "&#013 ".$row_users[0];
                                                                                                      }
                                                                                                      ?>
                                                                                                      ">
                <i class="fa fa-users"></i>
              
                <span class="badge badge-success ml-2"><?php echo mysqli_num_rows($q_users); ?></span>
            </div>
            
        </div>
            </li>       
            
        
            
       
            
        
            <li class="nav-item">
                <a target="new"  title="<?php echo $_SESSION['email']; ?>" class="nav-link mr-lg-2" id="messagesDropdown" href="change_password.php">
                    <i class="fa fa-fw fa-user-circle text-white"></i>
                    <span class="text-white">Hi!  <?php echo strtok($_SESSION['email'], " "); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a target="new"  class="nav-link text-white" href="logout.php">
                    <i class="fa fa-fw fa-sign-out text-white"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav><!-- Navigation end -->
  
<?php include ("includes/footer.php")?>
