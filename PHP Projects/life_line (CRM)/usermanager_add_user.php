<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_POST[ 'add_product' ] ) ) {


  $full_name = $_POST[ 'full_name' ];
  $email = $_POST[ 'email' ];
  $pass = $_POST[ 'pass' ];
  $position = $_POST[ 'position' ];
  $contact = $_POST[ 'contact' ];
  $official_phone = $_POST[ 'official_phone' ];
  $preffered_network = $_POST[ 'preffered_network' ];
  $date = date( "Y-m-d H:i:s" );


  $sql = "INSERT INTO `user`(`id`, `email`, `password`, `name`, `country`, `u_type`, `created_at`, `active`, `position`, `contact`, `official_phone`, `preffered_network`) VALUES (NULL, '$email','$pass','$full_name','Pakistan','0', '$date', '1', '$position','$contact','$official_phone','$preffered_network')";
  $query = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );
  if ( $query ) {
    alertredirect( "User Added Successfully", "usermanager_viewusers.php" );
  } else {
    echo( "Not Inserted" );
  }

}
?>
<!DOCTYPE html>
<html>
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
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
<div class="container-fluid">
  <?php breadcrumb(); ?>
  <div class="row" style="">
    <form method="post" enctype="multipart/form-data" action="">
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Full Name</label>
        <div class="col-sm-10">
          <input type="text" name="full_name" class="form-control" placeholder="">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" name="email" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Password</label>
        <div class="input-group col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pass" required="" style="background: rgba(0,0,0,0.5);color: #fff;border: 1px solid #fff">
          <div class="input-group-prepend">
            <div class="input-group-text" onclick="myFunction()" style="height: 40px;"> <i class="fa fa-eye"  id="showhide"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Position</label>
        <div class="col-sm-10">
          <input type="text" name="position" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Contact #</label>
        <div class="col-sm-10">
          <input type="number" name="contact" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label text-danger">Official Phone Number</label>
        <div class="col-sm-10">
          <input type="number" name="official_phone" required class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label text-danger">Preffered Network</label>
        <div class="col-sm-10">
          <select name="preffered_network" required class="form-select">
            <?php
            populateDD( "network", "network", "network" )
            ?>
          </select>
        </div>
      </div>
      <br>
      <input type="submit" value="Add User" name="add_product" class="btn-sm btn-outline-primary">
    </form>
  </div>
</div>
<br>
<br>
<br>
</body>
</html>