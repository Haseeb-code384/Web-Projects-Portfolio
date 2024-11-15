<?php 
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $name = $_REQUEST[ 'name' ];
  $parent = $_REQUEST[ 'parent' ];
  $active = $_REQUEST[ 'active' ];
  $description = $_REQUEST[ 'description' ];

  $sql = "INSERT INTO `rubric` (`id`, `name`, `description`, `active`, `parent`) VALUES (NULL, '$name', '$description', '$active', '$parent')";
  $query = mysqli_query( $con, $sql );
}
$sql = "SELECT * FROM `rubric` WHERE id='$id'";
$query = mysqli_query( $con, $sql );
$row = mysqli_fetch_array( $query );
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="js/bookstyle.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<style>
   #myUL a
    {
        color: black !important;
    }
    </style>
    </head>
<?php include("start.php"); 
    
include( "preloader.php" );
    ?>
    
<div class="content-wrapper"  >
<?php

$parent = $row[ 'parent' ];
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

    if ( $parentId > 0 ) {
      $parentHierarchy = getCategoryHierarchy( $parentId, $con );
      return $parentHierarchy . "<li class='breadcrumb-item'><a href='view_rubric_info.php?id=$parentId'>" . $categoryName . "</a></li>";
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

    $nextsibling=showQuery("SELECT
    parent.id+1 AS parent_id,
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
    parent.description
");
       $prevsibling=showQuery("SELECT
    parent.id-1 AS parent_id,
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
    parent.description
");
    
?>
<div class="container-fluid"> 
  <div class="col-sm-12">
<center style="margin-top: -17px;">
      <button  class="btn-sm btn-primary" onClick="previousPage(<?php echo $prevsibling; ?>);"><i class="fa fa-arrow-left"></i> Previous Page</button>

  <a  href="manage_rubric.php?id=<?php echo $row[4]; ?>">
  <button  class="btn-sm btn-warning">Create Sibling</button>
  </a> <a href="manage_rubric.php?id=<?php echo $id; ?>">
  <button class="btn-sm btn-info">Create Child</button>
  </a> <a href="edit_rubric.php?id=<?php echo $id; ?>">
  <button class="btn-sm btn-success">Edit</button>
  </a> <a href="del.php?delete_rubric=<?php echo $id; ?>" onClick="return confirm('Do You Want To Delete Rubric?')">
  <button class="btn-sm btn-danger">Delete</button>
  </a>
      <button class="btn-sm btn-success" onClick="nextPage(<?php echo $nextsibling; ?>);">Next Page <i class="fa fa-arrow-right"></i></button>

</center>
      <div class="row">
      <div class="col-sm-9">
<div id="book">
  <div id="page-1" class="page">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Heading: <?php echo $row[1] ?></div>
      <br>
      <?php echo $row[2] ?> </div>
  </div>
  <div id="page-2" class="page"> </div>
</div>

<br>
<br>
          <h3>Remedies</h3>
          <?php include("remedy_table.php"); ?>
    </div>
          
    <div class="col-sm-3">
          <h3><i class="fa fa-list"></i> Table of Content</h3>
            <?php   include("rubric_tree.php"); ?>
<!--          <select class="form-select" multiple style="width: 100%; height: 80vh;" onChange="nextPage(this.value)">-->
          <?php   //include("category_rubrik.php"); ?>
<!--              </select>-->
    </div>
    </div>
        
    </div>
</body>
<script src="js/bookscript.js"></script>
</html>