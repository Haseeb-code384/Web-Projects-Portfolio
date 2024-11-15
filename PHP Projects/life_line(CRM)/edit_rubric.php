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
  $potency = $_REQUEST[ 'potency' ];
  $units = $_REQUEST[ 'units' ];
  $formula_type = $_REQUEST[ 'formula_type' ];
  $formula_form = $_REQUEST[ 'formula_form' ];
  $author = ucwords( $_REQUEST[ 'author' ] );
  $remedy_no = $_REQUEST[ 'remedy_no' ];
  $potency_variation = $_REQUEST[ 'potency_variation' ];

  if ( $recomended == "Yes" ) {
    $sql = "INSERT INTO `medicine_formula` (`id`, `formula`, `description`, `rubric_id`, `recomended`, `remedy_type`, `potency`, `units`, `formula_type`, `formula_form`, `author`, `remedy_no`) VALUES (NULL, '$formula', '$formula_description', '$rubric_id', '$recomended', '$remedy_type', '$potency', '$units', '$formula_type', '$formula_form', '$author', '$remedy_no')";
    //        echo $sql;
  } else {
    $sql = "INSERT INTO `medicine_formula` (`id`, `formula`, `description`, `rubric_id`, `recomended`, `remedy_type`, `potency`, `units`, `formula_type`, `formula_form`, `author`, `remedy_no`) VALUES (NULL, '$formula', '$formula_description', '$rubric_id', NULL, '$remedy_type', '$potency', '$units', '$formula_type', '$formula_form', '$author', '$remedy_no')";
    //        echo $sql;
  }
  foreach ( $potency_variation as $potency ) {

    executeQuery( "INSERT INTO `medicine_rubric_variation` (`rubrik_id`, `formula_number`, `variation_potency`) VALUES ('$rubric_id', '$remedy_no', '$potency')" );
  }
  executeQuery( "INSERT INTO `medicine_author` (`author_name`, `sort`) VALUES ('$author', '50')" );
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
.hide_item {
    background-color: red;
    width: 100%;
    color: white;
    text-align: center;
    padding: 0;
}
textarea {
    width: 100%;
    height: 300px;
}
.jqte {
    margin: 0 !important;
    height: 108px;
}
.multiselect-container {
    will-change: unset !important;
    transform: translate3d(0px, -300px, 0px) !important;
}
.col-sm-12 {
    padding-left: 0px !important;
    padding-right: 0px !important;
}
</style>
</head>
<body>
<?php include("start.php"); ?>
<div class="content-wrapper" style="margin-top: -32px;">
  <div class="container-fluid">
    <div class="row" style="">
      <form>
      <script>
               function show_main_form(element,section)           
{
    if ( element.classList.contains('fa-eye') )
        {
          element.classList.remove('fa-eye');
    element.classList.add('fa-eye-slash');
document.getElementById(section).style.display="contents";   
        }
    else
        {
            
    element.classList.remove('fa-eye-slash');
          element.classList.add('fa-eye');
document.getElementById(section).style.display="none";   
        }
   
}
          </script>
      <div class="col-lg-12">
      <i class="hide_item fa fa-eye"  onClick="show_main_form(this,'main_form');"> Main Form</i>
      <section id="main_form" style="display: none;">
      <input type="hidden" name="id" value="<?php echo $row_info['id'] ?>">
      <input type="hidden" name="page" class="col-12" value="<?php echo $page; ?>">
      <div class="row">
      <div class="col-sm-6">
        <label> <strong>Description:</strong><a style="float: right;" href="view_rubric_info.php?id=<?php echo $id; ?>" class="">Open In Book View</a></label>
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
          <div class="col-sm-7">
            <label class=""><strong>Parent:</strong></label>
            <select class="form-control" name="parent">
              <option value="<?php echo $row_info['parent'] ?>"><?php echo showQuery("SELECT name FROM `rubric` WHERE id='$row_info[parent]'")  ?></option>
              <option value="0">Make Parent</option>
              <?php
              include( "category_rubrik.php" );
              ?>
            </select>
          </div>
          <div class="col-sm-3">
            <label><strong>Active:</strong></label>
            <select name="active" class="form-select">
              <option value="1" <?php if($row_info['active']==1) {echo "selected"; } ?> >Yes</option>
              <option value="0" <?php if($row_info['active']==0) {echo "selected"; } ?>>No</option>
            </select>
          </div>
          <div class="col-sm-2"> <br>
            <input type="submit" name="submit" class="btn-sm btn-primary col-sm-12">
          </div>
          <div class="col-sm-12">
            <label ><strong>Name:</strong></label>
            <input class="form-control "  value="<?php echo $row_info['name'] ?>" placeholder="Enter Category Name" type="text" name="name" required>
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
        });  $('#example-getting-started2').multiselect({
            enableResetButton: true,
            enableFiltering: true,
            includeSelectAllOption: true, 
            buttonWidth: '100%',
        });
    });
</script>
      </form>
      </section>
      <i class="hide_item fa fa-eye"  onClick="show_main_form(this,'formula_form');"> Formula Form</i>
      <section id="formula_form" style="display: none;">
        <form>
          <div class="row"  style="border: 1px solid grey; background-color: cornsilk; margin-left: 1px; border-radius: 10px; width: inherit;">
          <div class="col-sm-6">
            <label><strong>Formula</strong></label>
            <textarea style="height: 17px;" id="formula" class="form-control"  name="formula" required></textarea>
          </div>
          <div class="col-sm-1">
            <label><strong>Potency</strong></label>
            <select class="form-select" name="potency" >
              <?php populateDDsel("medicine_potency ORDER BY sort ASC","potency","potency","") ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>Units</strong></label>
            <select  class="form-select" name="units">
              <?php populateDDsel("medicine_units ORDER BY sort ASC","medicine_units","medicine_units","") ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>Type</strong></label>
            <select  class="form-select" name="formula_type">
              <?php populateDDsel("medicine_form_type ORDER BY sort ASC","form_type_name","form_type_name","") ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>Form</strong></label>
            <select  class="form-select" name="formula_form" >
              <?php populateDDsel("medicine_forms ORDER BY sort ASC","form_name","form_name","") ?>
            </select>
          </div>
          <div class="col-sm-2">
            <label><strong>Author</strong></label>
            <input type="text" class="form-control" name="author" list="author">
            <!--      <select  class="form-select"  onChange="appendtextbox('(Author: '+this.value+' )');">   </select>-->
            <datalist id="author">
              <?php
              populateDDdistinct( "author", "medicine_formula" );
              ?>
            </datalist>
          </div>
          <div class="col-sm-4">
            <label><strong>Description</strong></label>
            <textarea class="form-control" name="formula_description" style="height: 17px;"></textarea>
            <input type="hidden"  class="form-control" name="rubric_id" value="<?php echo $id; ?>" required>
          </div>
          <div class="col-sm-4" >
            <input type="radio" id="form" name="type" value="formula" checked>
            <label for="form"><strong>Formula</strong></label>
            <input type="radio" id="editor" name="type" value="jqte_editor">
            <label for="editor"><strong>Description</strong></label>
            <label class="text-center" style="text-align: center; "><strong>Suggestion Medicine</strong><span style="margin-left: 5px; " class="btn-sm btn-success" onClick="appendtextbox(' + ');">+</span></label>
            <select id="example-getting-started" onFocus="document.getElementById('myinputbox').focus();"   style="height: 100px;" onChange="appendtextbox(capitalizeFirstLetterOfEachWord(this.value));" class="form-select-sm">
              <?php populateDD("medicine_list","concat(abbreviation,' | ',medicine_name,' | ',roman_name,' | ',scientific_name,' | ',urdu_name)","concat(abbreviation,' | ',medicine_name,' | ',roman_name,' | ',scientific_name,' | ',urdu_name)","medicine_name") ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>RemedyType</strong></label>
            <select class="form-control" name="remedy_type" required>
              <?php populateDDsel("remedy_type","remedy_type","remedy_type",""); ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label class="text-center" style="text-align: center;"><strong>Variation</strong></label>
            <select id="example-getting-started2" multiple="multiple" name="potency_variation[]"  style="height: 100px;" class="form-select-sm">
              <?php populateDDsel("medicine_potency ORDER BY sort ASC","potency","potency","") ?>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>Recomended</strong></label>
            <select class="form-select" name="recomended" >
              <option value="Yes">Yes</option>
              <option value="">No</option>
            </select>
          </div>
          <div class="col-sm-1">
            <label><strong>Remedy#</strong></label>
            <select class="form-select" name="remedy_no" required>
              <?php populateDDdistinct("remedy_no","medicine_formula WHERE rubric_id='$id'"); ?>
              <option value="<?php echo showQuery("SELECT CASE WHEN MAX(remedy_no) IS NULL THEN 1 ELSE MAX(remedy_no) + 1 END AS next_remedy_no FROM `medicine_formula` WHERE rubric_id='$id'") ?>">New Remedy</option>
            </select>
          </div>
          <div class="col-sm-6">
            <input type="submit" class="btn btn-primary" name="formula_submit">
          </div>
        </form>
        </div>
        </form>
      </section>
      <i class="hide_item fa fa-eye"  onClick="show_main_form(this,'remedy_table');"> Remedy Table</i>
      <section id="remedy_table" style="display: none;">
        <?php include("remedy_table.php"); ?>
      </section>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active"> <a class="nav-link" href="medicine_list.php" target="new">All Medicines</a> </li>
      <li class="nav-item active"> <a class="nav-link" href="medicine_list.php?type=Herbal" target="new">Herbal Medicines</a> </li>
      <li class="nav-item active"> <a class="nav-link" href="medicine_list.php?type=Homeopathic" target="new">Homeopathic Medicines</a> </li>
    </ul>
  </div>
</nav>
</div>
</div>
<br>
<br>
<br>
</body>
</html>