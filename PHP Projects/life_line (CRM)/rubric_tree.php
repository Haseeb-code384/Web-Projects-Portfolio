<?php 
    function getparent_ids( $categoryId, $con ) {
  $query = "SELECT id, name, parent FROM rubric WHERE id = $categoryId";
  $result = mysqli_query( $con, $query );

  if ( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $categoryName = $row[ 'id' ];
    $parentId = $row[ 'parent' ];

    if ( $parentId > 0 ) {
      $parentHierarchy = getparent_ids( $parentId, $con );
      return $parentHierarchy .",".$categoryName;
    } else {
      return $categoryName;
    }
  }

  return '';
}
function countref($ref)
{
	include('config.php');
	
	$sql="SELECT count(id) FROM `rubric` WHERE parent='$ref'";
	$query=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($query);
	return $row[0];
}
function find_parent($x,$y,$class)
{

// Convert the list of values to an array.
$y_list = explode(",", $y);

// Find the value in the list.
$result = in_array($x, $y_list);

// Print the result.
if ($result) {
  echo $class;
} 

}

function referal($ref,$i,$sel)
{
	
	include("config.php");
	$i++;
	
$parent_list=  getparent_ids($_REQUEST['id'],$con);
	$sql="SELECT * FROM `rubric` WHERE parent='$ref' order by name";
	$query=mysqli_query($con,$sql);

	while($row=mysqli_fetch_array($query))
	{
	$people=countref($row[0]);		
		if($people>0)
		{
			
?>
  <li><span class="caret <?php find_parent($row[0],$parent_list,"bg-warning");  ?> "><a href="view_rubric_info.php?id=<?php echo $row[0];?>"><?php echo $row[1];?></a></span>
	  <ul class="nested <?php find_parent($row[0],$parent_list," active");  ?>">
	<?php 
		  referal($row[0],$i,$sel); 	
			 ?>
	  </ul>
<?php			 
		}
		else
		{
			?>
	  <li style="margin-left: 20px; list-style-type: square;"><a class="<?php find_parent($_REQUEST['id'],$row[0]," bg-warning") ?>"  href="view_rubric_info.php?id=<?php echo $row[0];?>"><?php echo $row[1];?></a></li>
	  <?php
		}
		?>
	  </li>
	  <?php
		
		
	}
	?>

	  <?php
		
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
</head>

<ul id="myUL">
<?php referal(0,0,"5080"); ?>
	</ul>

<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>

</html>
