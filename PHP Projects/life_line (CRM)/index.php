<?php
include "allFunctions.php";
include "start.php";
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
</head>
<body>
<!--
    
<div class="content-wrapper" >
  <div class="container-fluid" >
    <div align="center"  class="col-lg-12" style="color:red; font-size: 30pt;"><img src="img/mp_logo1.png"><b><br>
      <?php echo"$project_name"; ?></b>
      </div>
  </div>
</div>
-->
    <?php 
//    include("user_activity_dashboard.php?email=$_SESSION['email']");
    ?>
    <script>
    window.location.href='user_activity_dashboard.php?email=<?php echo $_SESSION['email']; ?>';
    </script>
</body>
</html>