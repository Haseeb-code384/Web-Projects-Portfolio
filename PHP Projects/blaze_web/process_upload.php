<?php 
require "templates/header.php";

?>
    <section id="content">
        <div class="container">
            <div class="upload-status">
                <h1>Upload status</h1>
                <div class="status-result">
                    <?php 
                    // making a directory where the file will be stored
                    $target_dir = "uploads/";
                    /* making the target file which will name the file by $_Files[] golbal vaiable, we catched the 
                    file and then in $_FILES["myFile"]["name"] , Name field which is also a key value in the array 
                    that will be maked, will differentiate by name, type, size, temp_name, and error. we can access 
                    values related to these
                      */
                    $target_file = $target_dir . basename($_FILES["myFile"]["name"]);
                    echo $target_file. '<br>';
                    // making a error which will be adjusted according to condtions
                    $error = 0;
                    /* This will tell us the file type by making a extension for the target file and will 
                    convet it to lower case through the strtolower() function*/

                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    echo $imageFileType. '<br>';
                    // echo $imageFileType; 

                    //Now applying the condition to check if the file is submitted
                    if(isset($_POST["submit"])){
                        // Now checking the image by image size by temporary name
                        $is_image = getimagesize($_FILES["myFile"]["tmp_name"]);
                        
                        // Now check if the type is image is present
                        if($is_image!== FALSE){
                            // $is_image["mime"], Here mime check the name and extension of the image
                            echo "This is an image file". $is_image["mime"];
                            $error=0;
                        }else{
                            echo "This is not an image file <br>";
                        
                            $error = 1;
                        }
                    }
                    echo "<br>";
                    // Now Check if the file already exists
                    if(file_exists($target_file)){
                        $random = rand(1,10);
                        $target_file = image .$random . "-" . basename($_FILES["myFile"]["name"]);
                        // echo "File already exist <br>";
                        $error =0;
                    }

                    // Check File size
                        // The size will be in bytes it mean 5kb = 5000
                    if($_FILES["myFile"]["size"]>= 500000){
                        echo "The file size should not be greater than 5KB <br>";
                        $error =1;
                    }
                    
                    // Check File Type
                    if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType !="png" &&
                    $imageFileType !="gif"){
                        echo "Invalid file type <br>";
                        $error =1;
                    }
                    // Now uploading the file if there are no errors
                    if($error==1){
                        echo "Sorry! Your file can not be uploaded <br>";
                    }else{
                        if(move_uploaded_file($_FILES["myFile"]["tmp_name"],$target_file )){
                            echo "The file  <strong>" . basename($_FILES["myFile"]["name"]) . "</strong> is uploaded <br>";
                        }
                        else{
                            echo "Sorry! There was an error. Uploading your file. If the issue persist. 
                            Please contact Server Administrator.<br>";
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>










<?php 
require "templates/footer.php";

?>