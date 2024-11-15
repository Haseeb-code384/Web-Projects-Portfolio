<?php
include("config.php");
  // Retrieve the content from the AJAX request
  $content = $_POST['content'];

  // Sanitize the content (optional)
  //$content = filter_var($content, FILTER_SANITIZE_STRING);

  // Insert the content into the database
  $sql = "INSERT INTO `rubric` (`id`, `name`, `description`, `active`, `parent`) VALUES (NULL, 'abdomenssssss', '$content', '1', '0')";
  if (mysqli_query($con, $sql)) {
    echo "Text saved successfully!";
  } else {
    echo "Error: " . mysqli_error($con);
  }
?>
