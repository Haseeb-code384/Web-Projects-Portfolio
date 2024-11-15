<?php
// Assuming you have a database connection in $con

// Retrieve data from the "rubric" table
$query = "SELECT * FROM rubric WHERE active='1'";
$result = mysqli_query($con, $query);

// Create an associative array to store the rubric items
$rubricItems = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rubricItems[$row['id']] = $row;
}

// Function to generate the <select> options with indentation
function generateSelectOptions($rubricItems, $parentId = 0, $indent = '') {
    $options = '';
    foreach ($rubricItems as $itemId => $item) {
        if ($item['parent'] == $parentId) {
            $name = $indent . $item['name'];
            $currentPage = basename($_SERVER['PHP_SELF']);

            if($itemId==$_REQUEST['id'] && $currentPage != 'edit_rubric.php')
            {
            $options .= "<option title='{$name}' selected value='{$itemId}'>{$name}</option>";
            }
            else
            {
            $options .= "<option title='{$name}' value='{$itemId}'>{$name}</option>";
            }
            $options .= generateSelectOptions($rubricItems, $itemId, $indent . '&nbsp;&nbsp;&nbsp;&nbsp;');
        }
    }
    return $options;
}

// Generate the <select> options with proper indentation
$selectOptions = generateSelectOptions($rubricItems);

// Generate the HTML <select> element
$selectElement = $selectOptions;

// Output the <select> element
echo $selectElement;
?>
