<?php
session_start();
include ("../config.php");


/*if (isset($_POST['btn'])) {
    
   
}*/


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>
<body>
<div class="container-fluid" align="center">
    <div class="col-md-8 align-content-center">
        <form method="post" action="code.php">
            </div>
            <div class="form-group row">
                <h1 for="" class="col-sm-4 col-form-label">Edit User Menu's</h1><br><br>
                <div class="col-sm-10">
                  <table border="1" width="25%">
                    <tbody>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Action</th>
                      <?php
                        $sql = "SELECT * FROM user";
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td>
                            <a href="user_with_checkbox.php?user_edit_id=<?php echo $row['id']?>">Edit</a>
                          </td>
                      </tr>
                          <?php }   ?>
                    </tbody>
                  </table>
                </div>
            </div>
      
        </form>
    </div>
</div>
</body>
</html>