<?php
session_start();
include ("../config.php");
echo $user_edit_id = $_REQUEST['user_edit_id'];
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
        <form method="post" action="update_checkbox.php?user_update_id=<?php echo $user_edit_id; ?>">
            </div>
            <div class="form-group row">
               
                <div class="col-sm-10">
                     <?php
                        $sql = "SELECT * FROM user where id = $user_edit_id";
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        $row = mysqli_fetch_array($result);
                        ?>

                        <h1><?php echo $row['name'];?></h1>
                  
                </div><br><br>
                 <div class="col-sm-10">
                    <?php
					 
					 
					 
                    $sql = "SELECT * FROM `menu` WHERE status='1'";
                    $query = mysqli_query($con,$sql) or die (mysqli_error($con));

                    if(mysqli_fetch_array($query) > 0)
                            {
                     foreach($query as $res)
                         {
                          ?>

                          <?php

                          ?>
                          <table border="1" width="20%">

                              <tr>
                                <td style="background-color: <?php if($res['parent_id']=="0") { echo "red;";} ?>;"><?php echo $res['menu_id'];?>
                                  <?php 
                $sql2 = "SELECT * FROM `menu_user_permissions` where user_id = $user_edit_id AND menu_id=".$res['menu_id'];
                          $query2 = mysqli_query($con,$sql2 ) or die (mysqli_error($con));
                          $row2 = mysqli_fetch_array($query2);


                                  ?>

                                </td>
                                  <td>
                           <input type="checkbox" <?php if($row2[0]!=''){echo "checked";} ?> name="brandslist[]" value="<?= $res['menu_id']; ?>" /><?= $res['menu_name']; ?> <br/>
                                   </td>

                            <?php
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                        }
                    ?>
            
                              </tr>
                          </table>
                </div>
            </div>
            <br>
            <input type="submit"  value="Update" name="update" class="btn-sm btn-outline-primary">
        </form>
    </div>
</div>
</body>
</html>