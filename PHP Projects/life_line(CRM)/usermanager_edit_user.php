<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $id = $_REQUEST[ 'id' ];
  $email = $_REQUEST[ 'email' ];
  $password = $_REQUEST[ 'password' ];
  $name = $_REQUEST[ 'name' ];
  $position = $_REQUEST[ 'position' ];

  $contact = $_REQUEST[ 'contact' ];
  $official_phone = $_REQUEST[ 'official_phone' ];
  $preffered_network = $_REQUEST[ 'preffered_network' ];
  $disease_category = $_REQUEST[ 'disease_category' ];
  $is_seller = $_REQUEST[ 'is_seller' ];
  $user_group = $_REQUEST[ 'user_group' ];
  $department = $_REQUEST[ 'department' ];

  $sql_update = "UPDATE `user` SET email='$email', password='$password', name='$name', position='$position',contact='$contact' , official_phone= '$official_phone', preffered_network= '$preffered_network' , disease_category='$disease_category' , is_seller='$is_seller' , user_group='$user_group', department='$department'  WHERE id='$id';";
//    echo $sql_update;
  mysqli_query( $con, $sql_update );
  alertredirect( "New Information Saved Successfully", "usermanager_viewusers.php" );

}
$user_id = $_REQUEST[ 'user_id' ];
$sql = "select * from user where id=$user_id";
$query = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );

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
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <form>
      <div class="card-body">
        <?php include("fix_header.php"); ?>
              <tr align="center">
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $row = mysqli_fetch_array( $query );
              ?>
              <tr>
                <td><input type="text" class="form-control" readonly required value="<?php echo $row['id'];?>" name="id"></td>
                <td><input type="text" class="form-control" readonly required value="<?php echo $row['email'];?>" name="email"></td>
                <td><div class="input-group mb-2">
                    <input type="password" class="form-control col-10" id="inputPassword3" required value="<?php echo $row['password'];?>" name="password">
                    <div class="input-group-prepend">
                      <div class="input-group-text" onclick="myFunction()" style="height: 40px;"> <i class="fa fa-eye"  id="showhide"></i></div>
                    </div>
                  </div></td>
                <td><input type="text" class="form-control" required value="<?php echo $row['name'];?>" name="name"></td>
              </tr>
              <tr align="center">
                <th>Position</th>
                <th>Contact #</th>
                <th class="text-danger">Official Phone</th>
<!--                <th class="text-danger">Preffered Network</th>-->
              </tr>
              <tr>
                <td><input type="text" class="form-control"  value="<?php echo $row['position'];?>" name="position"></td>
                <td><input type="number" name="contact" class="form-control" value="<?php echo $row['contact'];?>"></td>
                <td><input type="number" name="official_phone" value="<?php echo $row['official_phone'];?>" required class="form-control"></td>
<!--
                <td><select name="preffered_network" required class="form-select">
                    <?php
                    populateDDsel( "network", "network", "network", $row[ 'preffered_network' ] )
                    ?>
                  </select></td>
-->
              </tr>
              <tr align="center">
                <th>Department</th>
                <th>User Group</th>
                <th>Is Seller?</th>
                <th>Primary Disease Category</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" required  value="<?php echo $row['department'];?>" name="department"></td>
                '
                <td><select  name="user_group" required   class="form-control">
                    <option>Default</option>
                  </select></td>
                '
                <td align="center"><label>Yes</label>
                  <input type="radio"  name="is_seller" value="Yes" required <?php echo ($row['is_seller'] === "Yes") ? 'checked' : ''; ?>  >
                  <br>
                  <label>No</label>
                  <input type="radio" name="is_seller" value="No" <?php echo ($row['is_seller'] === "No") ? 'checked' : ''; ?>></td>
                <td>
                    <select  name="disease_category" required  class="form-control">
                    <?php
                        
populate_parent_child_dd("SELECT DISTINCT parent FROM `disease_category`","disease_category","disease_category","disease_category","parent",$row['disease_category']);
                       ?>
                  </select>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </div>
      <!--				content-->
      <input type="submit" name="submit" value="Save" class="btn-sm btn-success">
    </form>
  </div>
</div>
<br>
<br>
</body>
</html>