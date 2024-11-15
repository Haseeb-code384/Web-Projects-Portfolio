<?php
session_start();
include( "config.php" );
$user_edit_id = $_REQUEST[ 'user_edit_id' ];
?>
<!doctype html>
<html lang="en">
<head>
<script>
    function selall(x,name) {
	var state=x.checked;
	if(state==true)
		{
	var checkboxes = document.getElementsByClassName(name);
    for (var checkbox of checkboxes) {
        checkbox.checked="checked";
    }		
		}
	if(state==false)
		{			
	var checkboxes = document.getElementsByClassName(name);
    for (var checkbox of checkboxes) {
        checkbox.checked=false;
		}
}
}
    function chkall(x) {
	var state=x.checked;
	if(state==true)
		{
	var checkboxes = document.getElementsByName("brandslist[]");
    for (var checkbox of checkboxes) {
        checkbox.checked="checked";
    }		
		}
	if(state==false)
		{			
	var checkboxes = document.getElementsByName("brandslist[]");
    for (var checkbox of checkboxes) {
        checkbox.checked=false;
		}
}
}
    
     function countsel(id) {
    var num=0;
	var checkboxes = document.getElementsByClassName(id);
    for (var checkbox of checkboxes) {
        var state=checkbox.checked;
        if(state==true)
		{
            num++;
        }
    }
         if(num>0)
             {
                 document.getElementById(id).checked="checked";
             }
         else
             {
                 document.getElementById(id).checked=false;
             }
     }
    </script>
<meta charset="UTF-8">
<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>User Permissions</title>
    <style>
    input[type="checkbox"] {
    width : 20px;
    height : 20px;
        
    vertical-align: bottom;

}
        
    </style>
</head>
<body>
<div class="container-fluid" align="center">
  <div class="col-md-8 align-content-center">
      
      
      <div class="form-group row">
        <div class="col-sm-10">
          <?php
          $sql = "SELECT * FROM user where id = $user_edit_id";
          $result = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );
          $row = mysqli_fetch_array( $result );
          ?>
          <h1><?php echo $row['name'];?></h1>
        </div>
          
        <br>
        <br>
        <div class="col-sm-10">
          <table border="1" width="80%">
            <tr>
              <th>ID</th>
              <th> <input type="checkbox" onClick="chkall(this);" style="float: left;"><button onClick="location.reload();" style="float: left;" title="Reset Last Permissions For User">Reset</button>Page Name</th>

              <th>Page Description</th>
            </tr>
            <?php
            $sqlparent = "select * from menu where parent_id='0' and status='1' order by sort";
            $queryparent = mysqli_query( $con, $sqlparent );
            while ( $rowparent = mysqli_fetch_array( $queryparent ) ) {
              ?>
            <tr style="background-color: <?php if($rowparent['parent_id']=="0") { echo "grey";} ?>;">
             
                <td>
                    <?php echo $rowparent['menu_id'];?>
                <?php
                $sql2 = "SELECT * FROM `menu_user_permissions` where user_id = $user_edit_id AND menu_id=" . $rowparent[ 'menu_id' ];
                $query2 = mysqli_query( $con, $sql2 )or die( mysqli_error( $con ) );
                $row2 = mysqli_fetch_array( $query2 );
                ?>
                </td>
                 <form method="post" action="update_checkbox.php?user_update_id=<?php echo $user_edit_id; ?>">
    
              <td>
                  <input type="checkbox" id="<?php echo $rowparent['menu_id'] ?>" <?php if($row2[0]!=''){echo "checked";} ?> name="brandslist[]" value="<?= $rowparent['menu_id']; ?>" onClick="selall(this,'<?php echo $rowparent['menu_id'] ?>')" />
                <label for="<?php echo $rowparent['menu_id'] ?>"><?php echo $rowparent['menu_name']; ?></label>
                </td>
                
              <td><?php echo $rowparent['description']; ?></td>
              <?php


              ?>
            </tr>
            <?php


            $sql = "SELECT * FROM `menu` WHERE status='1' AND parent_id='$rowparent[0]'";
            $query = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );

            if ( mysqli_fetch_array( $query ) > 0 ) {
              foreach ( $query as $res ) {
                ?>
            <?php

            ?>
            <tr>
              <td style="background-color: <?php if($res['parent_id']=="0") { echo "red;";} ?>;"><?php echo $res['menu_id'];?>
                <?php
                $sql2 = "SELECT * FROM `menu_user_permissions` where user_id = $user_edit_id AND menu_id=" . $res[ 'menu_id' ];
                $query2 = mysqli_query( $con, $sql2 )or die( mysqli_error( $con ) );
                $row2 = mysqli_fetch_array( $query2 );


                ?></td>
              <td><input type="checkbox" onClick="countsel('<?php echo $rowparent['menu_id'] ?>')" class="<?php echo $rowparent['menu_id'] ?>" <?php if($row2[0]!=''){echo "checked";} ?> name="brandslist[]" value="<?php echo  $res['menu_id']; ?>" id="<?php echo  $res['menu_id']; ?>" />
                  <label for="<?php echo $res['menu_id'] ?>"><?php echo $res['menu_name']; ?></label></td>
              <td><?php echo $res['description']; ?></td>
              <?php
              }
              }
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