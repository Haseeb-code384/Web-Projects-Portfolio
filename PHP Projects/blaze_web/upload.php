<?php 
require "templates/header.php";

?>
<section id="content">
        <div class="container">
            <div class="upload-form">
                <h1>PHP File Upload</h1>
                <form action="process_upload.php" method="post" enctype="multipart/form-data">
                    <label for="fuile">Select image to upload:</label>
                    <input type="file" name="myFile" id="myFile">
                    <input type="submit" value="Upload Image" name="submit" class="submit-btn">
                </form>
            </div>
        </div>
    </section>
    
<?php 
require "templates/footer.php";

?>