<?php 
require "data_base.php";
$title_page="INotes App";
require "templates/header_bootstrap.php";


?>

<style>
    *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    
    }
    body{
    width: 100%;
    height: 100%;
    }
    .form-container{
        width: 70%;
        margin: 30px 40px;
        
    }
    .form-field{
    width: 100%;
    margin: 10px auto;
    font-size: 20px;

    }
    .form-field label{
    font-size: 30px;
    }
    input, textarea{
    width: 600px;
    padding: 20px;
    }

</style>
<h2>ADD A NOTE HERE</h2>
<div class="form-container">
    <form action="">
        <div class="form-field">
            <label for="title">Title </label><br>
                <input type="text" name="title" id="title" placeholder="Put Your Title Here">
            
        </div>

        <div class="form-field">
            <label for="desc">Description </label><br>
                <textarea class="desc" name="desc" id="desc" placeholder="Put Your Description Here" rows="3"></textarea>
            
        </div>
        <input type="button" value="Add Note">
    </form>
</div>
<div class="note-container">
    <?php 
    
    
    
    ?>
</div>








<?php 
require "templates/footer.php";

?>