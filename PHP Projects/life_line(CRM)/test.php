<?php
include("allFunctions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Editor</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
  <style>
    textarea {
      width: 100%;
      height: 500px;
    }
  </style>
</head>
<body>
   <?php echo showQuery("SELECT description FROM `rubric` order BY id DESC LIMIT 1"); ?>
    
  <textarea id="editor" name="content"> <?php echo showQuery("SELECT description FROM `rubric` order BY id DESC LIMIT 1"); ?></textarea>
  <button id="saveBtn">Save</button>

  <script>
    $(document).ready(function() {
      $('#editor').jqte();

      $('#saveBtn').click(function() {
        var content = $('#editor').val();
        $.ajax({
          url: 'save.php',
          type: 'POST',
          data: { content: content },
          success: function(response) {
            alert('Text saved successfully!');
          },
          error: function(xhr, status, error) {
            alert('An error occurred while saving the text.');
            console.log(error);
          }
        });
      });
    });
  </script>
</body>
</html>
