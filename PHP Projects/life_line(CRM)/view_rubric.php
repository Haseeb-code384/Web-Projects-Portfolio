<?php

include( "config.php" );
include( "allFunctions.php" );
include( "preloader.php" );
$sql = "SELECT
    parent.id AS parent_id,
    parent.name AS parent_name,
    parent.description AS parent_description,
    COUNT(subcategory.id) AS subcategory_count
FROM
    rubric AS parent
LEFT JOIN
    rubric AS subcategory ON parent.id = subcategory.parent
WHERE
    parent.parent =0
GROUP BY
    parent.id,
    parent.name,
    parent.description  
ORDER BY `parent_name` ASC
";

if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $name = $_REQUEST[ 'name' ];
  $parent = $_REQUEST[ 'parent' ];
  $active = $_REQUEST[ 'active' ];
  $description = $_REQUEST[ 'description' ];

  $sql = "INSERT INTO `rubric` (`id`, `name`, `description`, `active`, `parent`) VALUES (NULL, '$name', '$description', '$active', '$parent')";
  $query = mysqli_query( $con, $sql );
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
<?php include("start.php"); ?>
<div class="content-wrapper">
<div class="container-fluid">
  <?php
  breadcrumb();
  ?>
  <?php
  if ( isset( $_REQUEST[ 'parent' ] ) ) {
    $parent = $_REQUEST[ 'parent' ];
    $sql = "SELECT
    parent.id AS parent_id,
    parent.name AS parent_name,
    parent.description AS parent_description,
    COUNT(subcategory.id) AS subcategory_count
FROM
    rubric AS parent
LEFT JOIN
    rubric AS subcategory ON parent.id = subcategory.parent
WHERE
    parent.parent ='$parent'
GROUP BY
    parent.id,
    parent.name,
    parent.description;
";

    // Function to retrieve the category hierarchy
    function getCategoryHierarchy( $categoryId, $con ) {
      $query = "SELECT id, name, parent FROM rubric WHERE id = $categoryId";
      $result = mysqli_query( $con, $query );

      if ( mysqli_num_rows( $result ) > 0 ) {
        $row = mysqli_fetch_assoc( $result );
        $categoryName = $row[ 'name' ];
        $parentId = $row[ 'parent' ];

        if ( $parentId !== null ) {
          $parentHierarchy = getCategoryHierarchy( $parentId, $con );
          return $parentHierarchy . "<li class='breadcrumb-item'><a href='view_rubric.php?parent=$parentId'>" . $categoryName . "</a></li>";
        } else {
          return "<li class='breadcrumb-item'><a href='view_rubric.php'>" . $categoryName . "</a></li>";
        }
      }

      return '';
    }

    // Current category ID (replace with your desired category ID)
    $currentCategoryId = $parent;

    // Generate the category hierarchy as Bootstrap breadcrumbs
    $categoryHierarchy = getCategoryHierarchy( $currentCategoryId, $con );

    // Output the breadcrumbs
    echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">' . $categoryHierarchy . '</ol></nav>';
  }
  ?>
  <input type="text" id="filterInput" placeholder="Filter...">
  <ol class="list-group list-group-numbered" id="list">
    <?php
    if ( isset( $parent ) ) {
      ?>
    <a  href="manage_rubric.php?id=<?php echo $parent; ?>">
    <button style="float: right;" class="btn-sm btn-warning">Create Sibling</button>
    </a>
    <?php
    } else {
      ?>
    <a  href="manage_rubric.php?id=0">
    <button style="float: right;" class="btn-sm btn-warning">Create Sibling</button>
    </a>
    <?php
    }
    ?>
    <div > </div>
    <!--  <a href="#" class="list-group-item list-group-item-action list-group-item-primary">A simple primary list group item</a>-->
    
    <?php
    $query = mysqli_query( $con, $sql );
    while ( $row = mysqli_fetch_array( $query ) ) {
      if ( $row[ 3 ] > 0 ) {
        ?>
    <a href="view_rubric.php?parent=<?php echo $row[0] ?>" style="display: block; text-decoration: none; color: #495057;">
    <li style="background-color: lightgray;" class="list-group-item d-flex list-group-item-action justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold"><?php echo $row[1] ?></div>
        <?php    echo $row[2];
        ?>
      </div>
      <div>
      <?php
      if ( $row[ 3 ] > 0 ) {
        ?>
      <a href="view_rubric.php?parent=<?php echo $row[0] ?>"><span class="badge bg-primary rounded-pill"><?php echo $row[3] ?></span></a>
      <?php
      }
      ?>
      <a href="view_rubric_info.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-primary">Open</button>
      </a> <a href="edit_rubric.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-success">Edit</button>
      </a> <a href="manage_rubric.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-info">Create Child</button>
      </a> <a href="del.php?delete_rubric=<?php echo $row[0]; ?>" onClick="return confirm('Do You Want To Delete Rubric?')">
      <button class="btn-sm btn-danger">Delete</button>
      </a> </li>
    </a>
    <?php
    } else {
      ?>
    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold"><?php echo $row[1] ?></div>
        <?php
        echo $row[ 2 ];
        ?>
      </div>
      <div>
      <?php
      if ( $row[ 3 ] > 0 ) {
        ?>
      <a href="view_rubric.php?parent=<?php echo $row[0] ?>"><span class="badge bg-primary rounded-pill"><?php echo $row[3] ?></span></a>
      <?php
      }
      ?>
      <a href="view_rubric_info.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-primary">Open</button>
      </a> <a href="edit_rubric.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-success">Edit</button>
      </a> <a href="manage_rubric.php?id=<?php echo $row[0]; ?>">
      <button class="btn-sm btn-info">Create Child</button>
      </a> <a href="del.php?delete_rubric=<?php echo $row[0]; ?>" onClick="return confirm('Do You Want To Delete Rubric?')">
      <button class="btn-sm btn-danger">Delete</button>
      </a> </li>
    <?php
    }

    }
    ?>
  </ol>
</div>
<br>
<br>
<br>
<script>
   const searchInput = document.getElementById('searchInput');
const listItems = document.getElementById('list').getElementsByTagName('li');

searchInput.addEventListener('input', filterList);

function filterList() {
  const searchValue = searchInput.value.toLowerCase();

  for (let i = 0; i < listItems.length; i++) {
    const listItem = listItems[i];
    const listItemText = listItem.textContent.toLowerCase();

    if (listItemText.includes(searchValue)) {
      listItem.style.display = 'block'; // Show matching item
    } else {
      listItem.style.display = 'none'; // Hide non-matching item
    }
  }
}

    </script>
</body>
</html>