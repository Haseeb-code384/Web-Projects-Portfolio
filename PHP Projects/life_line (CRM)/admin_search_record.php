<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {

  $attrib = $_REQUEST[ 'attrib' ];
  $keyword = $_REQUEST[ 'keyword' ];
  $criteria = $_REQUEST[ 'criteria' ];
  if ( $criteria == "like" ) {
    $sqlview = "SELECT * FROM `inquiry` WHERE $attrib LIKE '%$keyword%'";
  }
  if ( $criteria == "exact" ) {
    $sqlview = "SELECT * FROM `inquiry` WHERE $attrib = '$keyword'";
  }


  include( "limit_record.php" );

}
?>
<!DOCTYPE html>
<html>
<head>
<script src="js/selectall.js"></script> 
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
  <div class="container-fluid">
  <?php breadcrumb(); ?>
  <form>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-sm-3">
          <label><strong>Select Property:</strong></label>
          <select class="form-control" name="attrib">
            <?php
            $sqlcol = "desc `inquiry`";
            $querycol = mysqli_query( $con, $sqlcol );
            while ( $rowcol = mysqli_fetch_array( $querycol ) ) {
              ?>
            <option <?php if(isset($_REQUEST['attrib'])) { if($_REQUEST['attrib']==$rowcol[0]) { echo "selected"; }  } ?> value="<?php echo $rowcol[0]; ?>"><?php echo strtoupper( str_replace("_", " ", $rowcol[0])); ?></option>
            <?php
            }

            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <label><strong>Criteria:</strong></label>
          <select class="form-control" name="criteria">
            <option <?php if(isset($_REQUEST['criteria'])) { if($_REQUEST['criteria']=="exact") { echo "selected"; }  } ?> value="exact">Exact Match</option>
            <option  <?php if(isset($_REQUEST['criteria'])) { if($_REQUEST['criteria']=="like") { echo "selected"; }  } ?>  value="like">Contains (Resembles)</option>
          </select>
        </div>
        <div class="col-sm-3">
          <label><strong>Search Word:</strong></label>
          <input class="form-control input-lg" placeholder="Search..." type="text" name="keyword" value="<?php if(isset($_REQUEST['keyword'])) { echo $_REQUEST['keyword'];  } ?>" >
        </div>
        <div class="col-sm-3"> <br>
          <input type="submit" name="submit" value="Search" class="btn-sm btn-primary">
        </div>
      </div>
      <br>
    </div>
    </div>
  </form>
  <?php
  if ( isset( $_REQUEST[ 'keyword' ] ) ) {
    ?>
  <form method="post" action="process_inquiry_employee_allocation.php">
    <?php
    $queryview = mysqli_query( $con, $sqlview );
    echo mysqli_num_rows( $queryview );
    ?>
    Records Found</strong> Select
    <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50">
    Rows <span style="float: right;">
    <label>User:
      <select class="form-select-sm"  name="allocated_to">
        <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
      </select>
    </label>
    <input type="submit"  name="submit" value="Allocate" class="btn-sm btn-primary">
    </span>
    <?php
    include( "fix_header.php" );
    include( "inquiry_table.php" );

    ?>
    <?php } ?>
  </form>
</div>
</div>
<br>
<br>
<br>
</body>
</html>