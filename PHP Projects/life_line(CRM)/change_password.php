<?php
include("start.php");
include('config.php');
$uid=$_SESSION['uid'];
$email=$_SESSION['email'];
$id=$_SESSION['email'];

if(isset($_REQUEST['submit']))
{
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$sqlupdate="update user set email='$email',password='$password' where email='$id'";
	$query=mysqli_query($con,$sqlupdate);
	echo "<script>alert('Account Information Changed Successfully!!');
	window.location.href='logout.php';
	</script>";
	header("Location: logout.php");		
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<script>
	function match()
	{
		var pw1=document.getElementById("pw1");
		var pw2=document.getElementById("pw2");
		var msg=document.getElementById("msg");
		if(pw1.value==pw2.value)
			{
				pw1.style.borderColor="green";
				pw2.style.borderColor="green";
				msg.style.visibility="hidden";
				pw1.style.backgroundColor="white";
				pw2.style.backgroundColor="white";
			}
		else
			{
				
				pw1.style.borderColor="red";
				pw2.style.borderColor="red";
				pw1.style.backgroundColor="pink";
				pw2.style.backgroundColor="pink";
				
				msg.style.visibility="visible";
			}
	}
	</script>


<title><?php echo $project_name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>	
<div class="content-wrapper">	
<!--slider menu-->
	
<div class="inner-block">

<div class="container-fluid">
    <div class="breadcrumb h1"><i class="fa fa-pencil"> </i> Update Account Information</div>

<form method="post" action="">
	<div class="row">
 <div class="col-sm-12 form-group">
 	 <label>Username</label>
	 <?php 
$sql="select * from user where email='$id'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
 ?>
        <input type="email" class="form-control" readonly name="email" value="<?php echo $row[1] ;?>" >             		</div>
                                <div class="col-sm-6 form-group" >
                                    <label>Password</label>
                                   <input id="pw1" type="password" class="form-control" value="<?php echo $row[2]; ?>">
                               
                                </div>
                                <div class="col-sm-6 form-group" >
                               <label>Confirm Password</label>
                                   <input id="pw2"  onKeyUp="match();"  type="password" name="password" class="form-control" value="<?php echo $row[2]; ?>">  
	</div>
	<p align="center" style="color: red; visibility: hidden;" id="msg" >Passwords didn't matched.</p>
					<br>
					
</div>
	<center><input type="submit" value="Update Account Info" name="submit" class="btn-sm btn-primary btn-lg"></center></form>
	</div>
</div>

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php 
		   include("footer.php");
		   ?>
<!--COPY rights end here-->
</div>
</div>
   <?php include("user_navbar.php"); ?>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                     