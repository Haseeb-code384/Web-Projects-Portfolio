<?php
include("config.php");
include("allFunctions.php");
include("preloader.php");

$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Get the URL parameters
$params = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

// Combine the previous page URL and parameters
//$previousPageWithParams = $previousPage . '?' . $params;
$previousPageWithParams = $previousPage ;

// Output the result
$page= $previousPageWithParams;
if(isset($_REQUEST['submit']))
{
    
     $page = $_REQUEST['page'];
     $name = $_REQUEST['name'];
     $parent = $_REQUEST['parent'];
     $active = $_REQUEST['active'];
     $description = $_REQUEST['description'];
    
	$sql="INSERT INTO `rubric` (`id`, `name`, `description`, `active`, `parent`) VALUES (NULL, '$name', '$description', '$active', '$parent')";
	$query=mysqli_query($con,$sql);
    if($query)
    {
        alertredirect("Data Inserted Successfully",$page);
    }
	
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
  $currentPage = basename($_SERVER['PHP_SELF']);

  if ($currentPage === 'manage_rubric.php') {
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
  } else {
    echo '<script src="vendor/jquery/jquery.min.js"></script>';
  }
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
    <style>
    textarea {
      width: 100%;
      height: 300px;
    }
  </style>
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluids">
		<div class="row" style="">
			
		
			<?php breadcrumb(); ?>
			<form>
                
                <input type="hidden" name="page" class="col-12" value="<?php echo $page; ?>">
			<div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-4">
                    <label><strong>Select Parent:</strong></label> 
                       <select class="form-control" name="parent">
                        <option value="">Make Parent</option>
                    <?php
                    include("category_rubrik.php");
                    ?>
                    
                    </select>

                    </div>
                    <div class="col-sm-4">
                    <label><strong>Category Name:</strong></label> 
                        <input class="form-control input-lg" placeholder="Enter Category Name" type="text" list="cat" name="name" required> 
                        <datalist id="cat">
                            <?php populateDD("rubric","name","name") ?>
                        </datalist>
                    </div>  
                    <div class="col-sm-4">
                    <label><strong>Active:</strong></label> 
                           <select name="active" class="form-select">
                        
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select> 
                    </div>
                    <div class="col-sm-12">
                    <label><strong>Description:</strong></label> 
                        
<!--
                      <textarea name="description" class="form-control"></textarea>
                        
--> <textarea id="editor" name="description"></textarea>
                        
<!--  <button id="saveBtn">Save</button>-->

  <script>
    $(document).ready(function() {
      $('#editor').jqte();

//      $('#saveBtn').click(function() {
//        var content = $('#editor').val();
//        $.ajax({
//          url: 'save.php',
//          type: 'POST',
//          data: { content: content },
//          success: function(response) {
//            alert('Text saved successfully!');
//          },
//          error: function(xhr, status, error) {
//            alert('An error occurred while saving the text.');
//            console.log(error);
//          }
//        });
//      });
    });
  </script></div>
                    
                </div>
				    
                  <br>
                 
                  
					
				</div>
			</div>
		</div>
        
    <h4>Remedies Suggestions</h4>
        <script>
        function appendtextbox(y)
            {
                //var a=document.querySelector('.jqte_editor').innerHTML;
                var dataoftext=document.querySelector('.jqte_editor').innerHTML+" "+y;
            document.querySelector('.jqte_editor').innerHTML="";
            document.querySelector('.jqte_editor').innerHTML=dataoftext;
//                var x=a.toString();
//                a=x+"1111";
                
                
            }
        </script>
        <select id="example-getting-started"   style="height: 100px;" onChange="appendtextbox(this.value);">
   <?php populateDD("medicine_list","concat(abbreviation,' | ',medicine_name)","medicine_name") ?>
</select>

</center>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            enableResetButton: true,
            enableFiltering: true,
            includeSelectAllOption: true, 
            buttonWidth: '100%',
        });
    });
</script>
    <input type="submit" name="submit" class="btn-sm btn-primary">
			</form>
			</div>
	</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</body>
</html>