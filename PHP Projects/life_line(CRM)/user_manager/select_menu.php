<?php
session_start();
include ("../config.php");


echo $_SESSION['email'];

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
                <label for="" class="col-sm-4 col-form-label">Select User</label><br><br>
                <div class="col-sm-10">
                    <select required name="user_id" id="cat_name" class="form-control">
                        <option>Select User</option>
                        <?php
                        $sql = "SELECT * FROM user";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_array($result)) { ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div><br><br>
                 <div class="col-sm-10">
                    <?php
                    $sql = "SELECT * FROM `menu`";
                    $query = mysqli_query($con,$sql) or die (mysqli_error($con));
                    if(mysqli_fetch_array($query) > 0)
                            {
                     foreach($query as $res)
                         {
                          ?>
                          <table border="1" width="20%">
                              <tr>
                                  <td>
                                       <input type="checkbox" name="brandslist[]" value="<?= $res['menu_id']; ?>" /><?= $res['menu_name']; ?> <br/>
                                   </td>
                            <?php
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                        }
                    ?>
                                  </td>
                              </tr>
                          </table>
                </div>
            </div>
            <br>
            <input type="submit"  name="btn" class="btn-sm btn-outline-primary">
        </form>
    </div>
</div>
</body>
</html>