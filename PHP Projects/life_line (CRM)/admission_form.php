<?php

include("config.php");
include("allFunctions.php");

if (isset($_REQUEST['btn'])){
    echo $a = $_FILES['file']['size'];
    echo $b = $a/1024;
    $pic = $_FILES['file']['name'];
    echo $ex = pathinfo($pic,PATHINFO_EXTENSION);
    $dt = date("Y-m-d h-i-s");
if($pic!="")
    $path = "images/".getNextId("admission_no","student").".".$ex;
else
	$path="";
    move_uploaded_file($_FILES['file']['tmp_name'],$path);

	$roll_no=$_REQUEST['roll_no'];
    $name = $_REQUEST['student_name'];
    $f_name = $_REQUEST['father_name'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $student_class = $_REQUEST['board'];
    $section = $_REQUEST['semester'];
    $year = $_REQUEST['year'];
    $residential_addr = $_REQUEST['residential_address'];
    $fee = $_REQUEST['fee'];
    $nadra_reg_no = $_REQUEST['nadra_reg_no'];
    $caste = $_REQUEST['caste'];
    $fg_cnic = $_REQUEST['fg_cnic'];
    $f_occupation = $_REQUEST['f_occupation'];
    $fg_cell_no = $_REQUEST['fg_cell_no'];
    $ptcl = $_REQUEST['ptcl'];
    $pre_school = $_REQUEST['pre_school'];
    $cell_for_sms = $_REQUEST['cell_for_sms'];

$sql="INSERT INTO `student` (`admission_no`, `roll_no`, `date`, `student_pic`, `name`, `f_name`, `dob`, `gender`, `class`, `section`, `year`, `residential_addr`, `fee`, `nadra_reg_no`, `caste`, `fg_cnic`, `f_occupation`, `fg_cell_no`, `ptcl`, `pre_school`, `home_sms`) VALUES (NULL, '$roll_no', now(), '$path', '$name', '$f_name', '$dob', '$gender', '$student_class','$section', '$year', '$residential_addr', '$fee', '$nadra_reg_no', '$caste', '$fg_cnic', '$f_occupation', '$fg_cell_no', '$ptcl', '$pre_school', '$cell_for_sms');";
    $query = mysqli_query($con,$sql) or die(mysqli_error($con));
echo $sql;
    if ($query){

       header("LOCATION:students.php");
    }
    else{
        echo "Data Not inserted";
    }

}

?>
<!doctype html>
<html lang="en">
<head>
   <script src="semester.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo($project_name); ?></title>

  <!-- Bootstrap Core CSS -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--     <link href="css/plugins/morris.css" rel="stylesheet"> -->
    <style>

        img{

            width: 200px;
            height: 200px;

        }
        .logo-section{

            margin: 0 0 0 100px;
            text-align: center;
        }
        .label_start{
            color: white;
            font-weight: bold;
        }
        label{
            font-family: Arial;
            font-weight: bold;
        }
        #student_pic{

            margin: -170px 54px 40px 20px;
        }
        .browse{
            margin: -30px 0px 0 0;
        }



    </style>
</head>

<body>
<?php include("navbar.php"); ?>
<div class="container" >
    <div class="container-fluid">
        <div class="panel panel-primary">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="panel-heading" style="border:solid 2px #337ab7;border-radius: 15px">
                    <div class="navbar bg-primary" style="border-radius: 15px">
                    <div class="col-sm-10">
                        <div class="logo-section">
                            <h1 class=""><?php echo($project_name); ?></h1>
                            <img src="img/logo.png" alt="logo">
                            <h5><?php echo $address; ?></h5>
                            <h1><u>Admission Form</u></h1><br>
                        </div>
                    </div>
                    
                        <div class="col-sm-12">
                            <div class="form-group">
                           <!--     <img src="img/default-user-img.jpg" alt="" class="img-thumbnail pull-right " id="student_pic" >
                               --> <input type="file" class="pull-right browse" name="file">
                            </div>
                        </div>
                    
                               <div class="row col-sm-12">
                            <div class="form-group col-sm-6">
                                <label class="label_start">Admission No:</label>
                                <input type="text" class="form-control" name="" value="<?php echo(getNextId("admission_no","student")); ?>" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="label_start">Roll Number</label>
                                <div id="course">
                                <input type="text" class="form-control" name="" disabled>
                                </div>
                            </div>
                            
                        </div>
                         <div class="row col-sm-12">
                            <div class="form-group col-sm-6">
                                <label class="label_start">Class</label>
                                <select id="programdd" onchange="change_semester()" class="form-control" name="board" required>
                                      <option value="">Select Class</option>
                                       <?php populateDDdistinct("board_name","class") ?>
                                   </select>
                                
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="label_start">Section</label>
                                <div id="semester">
                                     <select class='form-control' >
                                           <option value="">Select Section</option>
                                        
									</select></div></div>
                            
                        </div>
                    </div>
                   
                </div>
                <br>
                <div class="panel-body" style="border:solid 2px #337ab7;border-radius: 15px;"><br>
                    <div class="col-lg-12">
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="row"><!--row start-->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                             <h1 align="center" class="bg-primary" style="border-radius: 15px;color: white;font-weight: bold;font-family: Arial">Students Information</h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Name of the Student:</label>
                                                <input type="text" class="form-control" name="student_name" placeholder="Student Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Father's Name:</label>
                                                <input type="text" class="form-control" name="father_name" placeholder="Father's Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Date Of Birth:</label>
                                                <input type="date" class="form-control" name="dob" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                       <!-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Class Which Admission is required:</label>
                                                <input type="text" class="form-control" name="student_class" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Year:</label>
                                                <input type="text" class="form-control" name="year" placeholder="Year">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Year:</label>
                                                <select name="year" required class="form-control">
                                                <option value="">Select Session</option>
                                                	<?php populateDDdistinct("session_name","session"); ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                           <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Residential Address:</label>
                                                <textarea class="form-control" name="residential_address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Fee:</label>
                                                <input type="number" class="form-control" name="fee" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Nadra Registration Number:</label>
                                                <input type="text" class="form-control" name="nadra_reg_no" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" placeholder="xxxxx-xxxxxxx-x" title="format is xxxxx-xxxxxxx-x ">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Caste:</label>
                                                <input type="text" class="form-control" name="caste">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h1 align="center" class="bg-primary" style="border-radius: 15px;color: white;font-weight: bold;font-family: Arial">Father's Information</h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Father's Guardian CNIC::</label>
                                                <input type="text" class="form-control" name="fg_cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" placeholder="xxxxx-xxxxxxx-x" title="format is xxxxx-xxxxxxx-x ">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Father's Occupation:</label>
                                                <input type="text" class="form-control" name="f_occupation">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Father's Guardian Cell No:</label>
                                                <input type="text" class="form-control" name="fg_cell_no">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">PTCL No:</label>
                                                <input type="text" class="form-control" name="ptcl">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Previous School (if any):</label>
                                                <input type="text" class="form-control" name="pre_school">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail">Mobile No(For SMS):</label>
                                                <input type="text" class="form-control" name="cell_for_sms"  required pattern="923([0-9])[0-9]{8}" title="923xxxxxxxxx" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="submit" value="Submit" class="btn-sm btn-primary btn-lg" name="btn">
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</body>
</html>