<?php
include ("../config.php");

$sql = "select * from user";
$query = mysqli_query($con,$sql) or die (mysqli_error($con));

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .
    </style>
</head>
<body>
<!-- Begin Page Content -->
<div class="container-fluid" align="center">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View User Information</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0" border="1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($query)){?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                   
                        <td><?php echo $row['country'];?></td>
                        <td>
                            <a class="a" href="edit_user.php?user_id=<?php echo $row['id'];?>"><input type="button" class="btn-sm btn-success btn-sm" value="Edit"/></a> |
                            <a class="a" href="delete_user.php?user_id=<?php echo $row['id'];?>"><input type="button" class="btn-sm btn-danger btn-sm" value="Delete"/></a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>