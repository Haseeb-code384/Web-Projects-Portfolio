<?php 
include("start.php");

?>
<link rel="stylesheet" href="dist2/css/bootstrap.min.css" type="text/css"/>
<script type="text/javascript" src="dist2/js/jquery.min.js"></script>
<script type="text/javascript" src="dist2/js/bootstrap.min.js"></script>
 
<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="dist2/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="dist2/css/bootstrap-multiselect.css" type="text/css"/>
<!-- Initialize the plugin: -->

<!-- Note the missing multiple attribute! -->
<center>
<!-- Build your select: -->
<select id="example-getting-started"  multiple="multiple">
   <?php populateDD("medicine_list","medicine_name","concat(abbreviation,' ',medicine_name)") ?>
</select>

</center>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            enableResetButton: true,
            enableFiltering: true,
            includeSelectAllOption: true, widthSynchronizationMode: 'ifPopupIsWider',
            buttonWidth: '200px',
        });
    });
</script>