<?php
include ("../config.php");

$user_id = $_GET['user_id'];

if (isset($_POST['update'])) {


    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $date = date("Y-m-d H:i:s");


    $sql="UPDATE `user` SET `email`= '$email',`name`= '$full_name',`country`= '$country',`created_at`= '$date' WHERE id = $user_id";
    $query=mysqli_query($con,$sql) or die(mysqli_error($con));
    if ($query){
        header("location:view_user.php");
    }
    else{

        echo "<script>alert('Something went wrong')</script>";
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
            <?php
            $sql = "select * from user where id = $user_id";
            $query = mysqli_query($con,$sql) or die (mysqli_error($con));
            $row = mysqli_fetch_array($query) or die(mysqli_error($con));
            ?>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" name="full_name" class="form-control" value="<?php echo $row['name']?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" value="<?php echo $row['email']?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Country</label>
                <div class="col-sm-10">
                    <input type="text" name="country" class="form-control" value="<?php echo $row['country']?>">
                </div>
            </div>
                <br>
            <input type="submit" value="Update" name="update" class="btn-sm btn-outline-primary">
        </form>
    </div>
</div>



</html>