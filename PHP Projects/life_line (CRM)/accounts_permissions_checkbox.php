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
	var checkboxes = document.getElementsByName("brandlist_dr[]");
    for (var checkbox of checkboxes) {
        checkbox.checked="checked";
    }		
		}
	if(state==false)
		{			
	var checkboxes = document.getElementsByName("brandlist_dr[]");
    for (var checkbox of checkboxes) {
        checkbox.checked=false;
		}
}
}    function chkall_cr(x) {
	var state=x.checked;
	if(state==true)
		{
	var checkboxes = document.getElementsByName("brandlist_cr[]");
    for (var checkbox of checkboxes) {
        checkbox.checked="checked";
    }		
		}
	if(state==false)
		{			
	var checkboxes = document.getElementsByName("brandlist_cr[]");
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
    <div class="form-group row"> <br>
      <br>
      <div class="col-sm-10">
        <table border="1" width="80%">
          <tr>
            <th>  
              
                
                
              <button onClick="location.reload();"  title="Reset Last Permissions For User">Reset</button>
                Login ID
                  <br>
            </th><th>
                <label>Credit</label><input  type="checkbox" onClick="chkall_cr(this);" >
            </th><th>
                <label>Debit</label><input  type="checkbox" onClick="chkall(this);" >
            </th>
            <th> Name</th>
            <th>Position</th>
          </tr>
          <?php
          $my_list_dr = [];
          $my_list_cr = [];

          $sql2 = "SELECT username FROM `m_account_permission` WHERE account_id='$_REQUEST[user_edit_id]' AND type='Dr'";
//          echo $sql2;
          $query2 = mysqli_query( $con, $sql2 );
          while ( $row2 = mysqli_fetch_array( $query2 ) ) {
            $my_list_dr[] = $row2[ 0 ];
          }

          $sql2 = "SELECT username FROM `m_account_permission` WHERE account_id='$_REQUEST[user_edit_id]' AND type='Cr'";
          $query2 = mysqli_query( $con, $sql2 );
          while ( $row2 = mysqli_fetch_array( $query2 ) ) {
            $my_list_cr[] = $row2[ 0 ];
          }
          ?>
          <form method="post" action="update_account_permissions_checkbox.php?user_update_id=<?php echo $user_edit_id; ?>">
          
          <?php

          $sql = "SELECT email,name,position FROM `user` ";
          $query = mysqli_query( $con, $sql );

          while ( $res = mysqli_fetch_array( $query ) ) {

            ?>
          <tr>
            <td>
                
              <label for="<?php echo $res[0] ?>"><strong><?php echo $res[0]; ?></strong></label>
                </td><td align="center">
                <input type="checkbox" onClick="countsel('<?php echo $row[0] ?>')" class="<?php echo $row[0] ?>" <?php if(in_array($res[0], $my_list_cr)) {echo "checked";} ?> title="Allow Credit"  name="brandlist_cr[]" value="<?php echo  $res[0]; ?>" id="<?php echo  $res[0]; ?>" />
                
                </td><td align="center">
              <input type="checkbox"  title="Allow Debit" onClick="countsel('<?php echo $row[0] ?>')" class="<?php echo $row[0] ?>" <?php if(in_array($res[0], $my_list_dr)){echo "checked";} ?> title="Allow Debit" name="brandlist_dr[]" value="<?php echo  $res[0]; ?>" id="<?php echo  $res[0]; ?>" />
             
              
              </td>
            <td><?php echo $res['name']; ?></td>
            <td><?php echo $res['position']; ?></td>
            <?php
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