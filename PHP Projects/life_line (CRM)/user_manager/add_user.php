<?php
include ("../config.php");

if (isset($_POST['add_product'])) {


    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $position = $_POST['position'];
    $date = date("Y-m-d H:i:s");


    $sql = "INSERT INTO `user`(`id`, `email`, `password`, `name`, `country`, `u_type`, `created_at`, `active`, `position`) VALUES (NULL, '$email','$pass','$full_name','','', '$date', '', '$position')";
    $query = mysqli_query($con,$sql)or die(mysqli_error($con));
    if ($query){
     header("location:view_user.php");
    }
    else{
        echo ("Not Inserted");
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  
</head>
<body>
    
<div class="container-fluid">
    <div class="col-md-8 align-content-center">
        <form method="post" enctype="multipart/form-data" action="">
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" name="full_name" class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Position</label>
                <div class="col-sm-10">
                    <input type="text" name="position" class="form-control">
                </div>
            </div>
                <br>
            <input type="submit" value="Add Product" name="add_product" class="btn-sm btn-outline-primary">
        </form>
    </div>
</div>



</html>