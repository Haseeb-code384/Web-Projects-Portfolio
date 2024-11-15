<?php session_start();
include("config.php");
if(isset($_REQUEST['login']))
{
	 $username=$_REQUEST['username'];
$password=$_REQUEST['password'];
//$password=md5($password);
$sql="select * from user WHERE BINARY email='$username' AND password='$password' AND active=1";
	
 $query=mysqli_query($con,$sql) ;
	$row=mysqli_fetch_array($query);
$_SESSION['email']=$username;
$_SESSION['uid']=$row[0];
$_SESSION['u_type']=$row['u_type'];
if($row[0]!=NULL)
{
/*		
	if($row['u_type']==1)
	{
	header("Location: admin.php");	
	}
	else
	{
	if($row['email_confirmation']==0)
	{
	
	header("Location: confirmation.php");
			
	}else
		{
		
	header("Location: user.php");
				
		}
	}
*/ 	

	header("Location: index.php");

//echo("<script>alert('".$_SESSION['uid']."');</script>");
}
else
{
echo("<script>alert('Invalid Username or Password');</script>");}

	}
	

?>
<html lang="en" style="width: 100%; height:100%; overflow:hidden;">
  <head>
      <script>
      function myFunction() {
  var x = document.getElementById("inputPassword3");
  if (x.type === "password") {
      
      document.getElementById("showhide").classList.add("fa-eye-slash");
      document.getElementById("showhide").classList.remove("fa-eye");
    x.type = "text";
  } else {
    x.type = "password";
      
      document.getElementById("showhide").classList.remove("fa-eye-slash");
      document.getElementById("showhide").classList.add("fa-eye");
  }
}
      </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | <?php echo $project_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- Morris Charts CSS -->
    <!--     <link href="css/plugins/morris.css" rel="stylesheet"> -->

    <style type="text/css">
    	body{
    		background-image: url("img/bg1.png");
    		-webkit-background-size: cover;
	        -moz-background-size: cover;
			background-size: cover;
			width: 100%;
			height: 100%;
			min-height: 720px;
			background-repeat: no-repeat;
    	}
    	#btn{
    		border: none;
    	}
    	#btn:hover{
    		background: none;
    	}
    	@media (max-width: 650px){
    		.container{
    			width: 370px;
    		}.card-header img{
    			width: 140px;
    			height: 35px;
    		}
    	}
    </style>
    
  </head>

  <body >
  	
  

    <div class="container">
    <div style=" margin: 0 auto; margin-top: 20px;  " class="col-lg-5">
	    	<div class="card mb-4" style="background: rgba(0,0,0,0.5); color: #fff; border-radius: 20px;">
	    		<div class="card-header" style="text-align: center; background-color:transparent; padding: 20px">
	    	<h2><?php echo $project_name; ?></h2>
				</div>
				<center>
					<img src="img/mp_logo1.png" style="width: 50%;"></center>
	    		<div class="card-block" >
					
	    			<form class="form-horizontal" role="form" method="post">
                        <div class="form-group" >
                            <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" required="" style="background: rgba(0,0,0,0.5);color: #fff;border: 1px solid #fff" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                            <div class="input-group mb-2">
                            
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" required="" style="background: rgba(0,0,0,0.5);color: #fff;border: 1px solid #fff">
                                     <div class="input-group-prepend">
          <div class="input-group-text" onclick="myFunction()" style="height: 40px;"> <i class="fa fa-eye"  id="showhide"></i></div>
        </div>
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-12">
                                <div class="checkbox">
                                    <label class="">
                                        <input type="checkbox" class=""> Remember me</label>
                                </div>
                            </div>
                        </div>
               
                        <div class="form-group last text-center">
                            <div class="col-sm-offset-3 col-sm-12">
                                <input type="submit" name="login" class="btn-sm btn-success btn-sm" value="Sign in">
                                <button type="reset" class="btn-sm btn-info btn-sm">Reset</button>
                            </div>
                        </div>
                    </form>                
	    		</div>
            
	    	</div>
	    	
	    	
    </div>
	    	           
	</div>
	 <center>
    <div class="col-md-8"  style="background-color: ghostwhite;  font-size: 20pt; border-radius: 2000px;">
	  
		 <?php include('includes/footer.php'); ?>  	          
</div>
	  </center>
</html>