<?php

//$page = basename( parse_url( $_SERVER[ 'HTTP_REFERER' ], PHP_URL_PATH ) );
include( "config.php" );
include( "allFunctions.php" );
include( "preloader.php" );
$id = $_REQUEST[ 'id' ];
$sql_info = "SELECT * FROM `rubric` WHERE id='$id'";
$query_info = mysqli_query( $con, $sql_info );
$row_info = mysqli_fetch_array( $query_info );
// Get the previous page URL
$previousPage = isset( $_SERVER[ 'HTTP_REFERER' ] ) ? $_SERVER[ 'HTTP_REFERER' ] : '';

// Get the URL parameters
$params = isset( $_SERVER[ 'QUERY_STRING' ] ) ? $_SERVER[ 'QUERY_STRING' ] : '';

// Combine the previous page URL and parameters
//$previousPageWithParams = $previousPage . '?' . $params;
$previousPageWithParams = $previousPage;

// Output the result
$page = $previousPageWithParams;
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $page = $_REQUEST[ 'page' ];
  $id = $_REQUEST[ 'id' ];
  $name = $_REQUEST[ 'name' ];
  $parent = $_REQUEST[ 'parent' ];
  $active = $_REQUEST[ 'active' ];
  $description = $_REQUEST[ 'description' ];

  $sql = "UPDATE `rubric` SET name='$name', description='$description', active='$active', parent='$parent' WHERE id='$id'";
  $query = mysqli_query( $con, $sql );
  if ( $query ) {

    alertredirect( "Edited Successfully", $page );
  }

}
if ( isset( $_REQUEST[ 'formula_submit' ] ) ) {
  $rubric_id = $_REQUEST[ 'rubric_id' ];
  $formula_description = ucwords( $_REQUEST[ 'formula_description' ] );
  $formula = $_REQUEST[ 'formula' ];
  $remedy_type = $_REQUEST[ 'remedy_type' ];
  $recomended = $_REQUEST[ 'recomended' ];

  if ( $recomended == "Yes" ) {
    $sql = "INSERT INTO `medicine_formula` (`id`, `formula`, `description`, `rubric_id`, `recomended`, `remedy_type`) VALUES (NULL, '$formula', '$formula_description', '$rubric_id', '$recomended', '$remedy_type')";
    //        echo $sql;
  } else {
    $sql = "INSERT INTO `medicine_formula` (`id`, `formula`, `description`, `rubric_id`, `recomended`, `remedy_type`) VALUES (NULL, '$formula', '$formula_description', '$rubric_id', NULL, '$remedy_type')";
    //        echo $sql;
  }

  $page = "edit_rubric.php?id=" . $rubric_id;
  $query = mysqli_query( $con, $sql );
  if ( $query ) {

    alertredirect( "Formula Added", $page );
  }

}
?>
<!DOCTYPE html>
<html>
<head>
<?php
$currentPage = basename( $_SERVER[ 'PHP_SELF' ] );

if ( $currentPage === 'edit_rubric.php' ) {
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
.jqte {
    margin: 0 !important;
}
    .multiselect-container
    {
        will-change: unset !important;
        transform: translate3d(0px,-300px,0px) !important;
    }
</style>
</head>
<body>
<?php include("start.php"); ?>
<div class="content-wrapper" style="margin-top: -32px;">
  <div class="container-fluid">
      
    <div class="row" style="">
      <form>
        <div class="col-lg-12">
        <input type="hidden" name="id" value="<?php echo $row_info['id'] ?>">
        <input type="hidden" name="page" class="col-12" value="<?php echo $page; ?>">
        <div class="row">
          <div class="col-sm-6">
            <label>
     <strong>Description:</strong><a style="float: right;" href="view_rubric_info.php?id=<?php echo $id; ?>" class="btn-sm btn-success">Open In Book View</a></label>
            <textarea id="editor" name="description"><?php echo $row_info['description'] ?></textarea>
            
            <!--  <button id="saveBtn">Save</button>--> 
            
            <script>
    $(document).ready(function() {
      $('#editor').jqte();
    });   
  </script> 
          </div>
          <div class="col-sm-6">
          <div class="row">
              
          <div class="col-sm-6">
          
            <label class=""><strong>Parent:</strong></label>
            <select class="form-control" name="parent">
              <option value="<?php echo $row_info['parent'] ?>"><?php echo showQuery("SELECT name FROM `rubric` WHERE id='$row_info[parent]'")  ?></option>
              <option value="0">Make Parent</option>
              <?php
              include( "category_rubrik.php" );
              ?>
            </select>
              </div>
              <div class="col-sm-6">
            <label ><strong>Name:</strong></label>
            <input class="form-control "  value="<?php echo $row_info['name'] ?>" placeholder="Enter Category Name" type="text" name="name" required>
                  
              </div>
              <div class="col-sm-6">
            <label  ><strong>Active:</strong></label>
            <select name="active" class="form-select">
              <option value="1" <?php if($row_info['active']==1) {echo "selected"; } ?> >Yes</option>
              <option value="0" <?php if($row_info['active']==0) {echo "selected"; } ?>>No</option>
            </select>   </div>
              <div class="col-sm-6">
                  <br>
            <input type="submit" name="submit" class="btn-sm btn-primary col-sm-12">
          </div>
        </div>
        </div>
        <script>
            function capitalizeFirstLetterOfEachWord(string) {
  return string.split(' ').map(word => word[0].toUpperCase() + word.substring(1)).join(' ');
}
        function appendtextbox(y)
            {
              //  y=capitalizeFirstLetterOfEachWord(y);

//                                var dataoftext=document.querySelector('.formula').innerHTML+" "+y;
//            document.querySelector('.formula').innerHTML="";
//            document.querySelector('.formula').innerHTML=dataoftext;
                var typeElement = document.querySelector('input[name="type"]:checked');
var type = typeElement.value;
                if(type=="formula")
                    {
                        var old_data=document.getElementById('formula').value+" "+y;
                        document.getElementById('formula').value="";
                        document.getElementById('formula').value=old_data;
                        
                    }
                else
                    {
                        var dataoftext=document.querySelector('.jqte_editor').innerHTML+" "+y;
            document.querySelector('.jqte_editor').innerHTML="";
            document.querySelector('.jqte_editor').innerHTML=dataoftext;
                    }
//alert(type);
                
                
            }
        </script>
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
      </form>
      <?php include("remedy_table.php"); ?>
    <form>
      <div class="row"  style="border: 1px solid grey; background-color: cornsilk; margin-left: 1px; border-radius: 10px; width: inherit;">
      <div class="col-sm-6">
        <label><strong>Formula</strong></label>
        <textarea style="height: 180px;" id="formula" class="form-control"  name="formula" required></textarea>
      </div>
      <div class="col-sm-6">
        <label><strong>Description</strong></label>
        <input type="text" id="formula" class="form-control" name="formula_description" >
        <input type="hidden"  class="form-control" name="rubric_id" value="<?php echo $id; ?>" required>
        <label><strong>Remedy Type</strong></label>
        <select class="form-control" name="remedy_type" required>
          <?php populateDDsel("remedy_type","remedy_type","remedy_type",""); ?>
        </select>
          <div class="row" style="width: inherit; margin-left: 0;">
        <label><strong>Recomended By Dr. Omar Chughtai</strong></label>
        <select class="form-control col-sm-10" name="recomended" >
          <option value="Yes">Yes</option>
          <option value="">No</option>
        </select>
        <input type="submit" class="btn btn-primary col-sm-2" name="formula_submit">
        
          </div>
        </div>
    </form>
    <div class="col-sm-6">
          <input type="radio" id="form" name="type" value="formula" checked>
      <label for="form"><strong>Formula</strong></label>
      
      <input type="radio" id="editor" name="type" value="jqte_editor">
      <label for="editor"><strong>Description</strong></label>
    
      <label class="text-center col-sm-8" style="text-align: center;"><strong>Medicine</strong></label>
      <select id="example-getting-started" onFocus="document.getElementById('myinputbox').focus();"   style="height: 100px;" onChange="appendtextbox(capitalizeFirstLetterOfEachWord(this.value));">
        <?php populateDD("medicine_list","concat('<b>',abbreviation,'</b> | ',medicine_name)","medicine_name") ?>
      </select>
    </div>
    <div class="col-sm-1">
      <label><strong>Potency</strong></label>
      <select class="form-select"  onChange="appendtextbox(this.value);">
        <?php populateDDsel("medicine_potency ORDER BY sort ASC","potency","potency","") ?>
      </select>
    </div>
    <div class="col-sm-1">
      <label><strong>Type</strong></label>
      <select  class="form-select"  onChange="appendtextbox(this.value);">
        <?php populateDDsel("medicine_form_type ORDER BY sort ASC","form_type_name","form_type_name","") ?>
      </select>
    </div>
    <div class="col-sm-1">
      <label><strong>Form</strong></label>
      <select  class="form-select"  onChange="appendtextbox(this.value);">
        <?php populateDDsel("medicine_forms ORDER BY sort ASC","form_name","form_name","") ?>
      </select>
    </div>
    <div class="col-sm-1">
      <label><strong>Author</strong></label>
      <select  class="form-select"  onChange="appendtextbox('(Author: '+this.value+' )');">
        <?php populateDDsel("medicine_author ORDER BY sort ASC","author_name","author_name","") ?>
      </select>
    </div>  <div class="col-sm-1">
      <label><strong>Units</strong></label>
      <select  class="form-select"  onChange="appendtextbox('(Author: '+this.value+' )');">
        <?php populateDDsel("medicine_units ORDER BY sort ASC","medicine_units","medicine_units","") ?>
      </select>
    </div>
    <div class="col-sm-1"> <br>
      <span class="btn-sm btn-success" onClick="appendtextbox(' + ');">+</span></div>
  </div>
  </form>
</div>
</div>
</div>
</div>
</div>
<br>
<br>
<br>
</body>
</html>