<?php 
require "data_base.php";
$title_page="Ajax Example with PHP";
require "templates/header_bootstrap.php";

?>
    <div class="container t-margin table-responsive">
    <table class="table align-middle table-bordered table-striped mt-5 table-hover ">
        <?php
        $sql_s = "SELECT * FROM users";
        // $sql_s = "SELECT * FROM users ORDER BY user_name DESC LIMIT 7 OFFSET 2";
        // ORDER BY can fetch the data in specific order mean ascending or descending--- ASC for ascending
        //LImit will show us the given no of rows 
        // OFFSet will skip the given no of rows and will show the rows after the given no
        // Shortcut for LIMIT==> LIMIT 2, 4 means --> offset 2 records and show 4 records
        $result = $connection -> query($sql_s);


        ?>

        <thead  class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Country</th>
                <th scope="col">Registered Date</th>
                <th scope="col">Action</th>

                
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if($result->num_rows > 0){
                // echo $result->num_rows;
                while($row = $result->fetch_assoc()){
                    $user_id = $row["user_id"];
                    $user_name = $row["user_name"];
                    $user_email = $row["user_email"];
                    $user_password = $row["user_password"];
                    $user_country = $row["user_country"];
                    $register_date = $row["register_date"];

            ?>

            <tr>
                <th scope="row"><?php echo $row["user_id"]?></th>
                <td><?php echo $row["user_name"]?></td>
                <td><?php echo $row["user_email"]?></td>
                <td><?php echo $row["user_password"]?></td>
                <td><?php echo $row["user_country"]?></td>
                <td><?php echo $row["register_date"]?></td>
                <td>
                    <a href="javascript:" onclick= "loadUser(<?php echo $user_id ?>)" class="btn_data">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row["user_id"]?>&confirm=false" class="btn_data" style="margin-left: 5px;">Delete</a>
                </td>
                <!-- <td><a href="user_detail.php">Edit</a> &nbsp; <a href="delete_user.php">Delete</a></td> -->
            </tr>
            <?php } }else{ ?>
                <tr>
                    <th scope="row">No Record Found</th>
                </tr>
            <?php } ?>

            
        </tbody>
    </table>
    </div>
    <div id="UserDetail">

    </div>
    <i onclick="closeUser()" class="ico fa-solid fa-xmark" style="display:none;"></i>


    
<?php 
require "templates/footer.php";

?>