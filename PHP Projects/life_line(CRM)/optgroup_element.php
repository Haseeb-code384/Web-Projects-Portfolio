<?php session_start();
include ("config.php");
?>

<!--
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>

	
</head>


       <select class="form-control selectpicker" id="select-country" data-live-search="true">
        
-->

		   <option value="">Choose Ledger</option>
          <?php
               $sql = "SELECT head_name FROM `account_head` order by head_name";
                $result = mysqli_query($con, $sql);
                  while($row = mysqli_fetch_array($result)) { ?>
               
          <optgroup label="<?php echo $row['head_name'];?>">
<?php 
			  $sql2="SELECT id,subhead_name FROM `account_subhead` WHERE head_name='$row[0]'  order by subhead_name";
			$query2=mysqli_query($con,$sql2);
			while($row2=mysqli_fetch_array($query2))
			{
				
			  ?>
            <optgroup label="&nbsp;&nbsp;&nbsp; <?php echo $row2[1]; ?>">
			<?php
                if(($_SESSION['email']=="Doctor Omar Chughtai")||($_SESSION['email']=="admin"))
                {
                     $sql3="SELECT m_accountid,account FROM `master_account` WHERE accounttype='$row2[0]'  order by account";
                }
                else
                {
                   $sql3="SELECT m_accountid,account FROM `master_account` WHERE accounttype='$row2[0]' AND m_accountid IN(SELECT account_id FROM `m_account_permission` WHERE username='$_SESSION[email]')  order by account";  
                }
				
				echo $sql3;
			$query3=mysqli_query($con,$sql3);
			while($row3=mysqli_fetch_array($query3))
			{
				?>	
              <option  <?php echo isset($selected_account) && $selected_account == $row3[0] ? 'selected' : '';
 ?> value="<?php echo $row3[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3[0]; ?> | <?php echo $row3[1] ?> </option>
				<?php } ?>
            </optgroup>
			<?php 
			}
															 ?>
          </optgroup>
             <?php
                    }
                ?>
<!--
	
        </select> 
      
-->





 

<!--
 <script type="text/javascript">
 	
 	jQuery(document).ready(function($){
    let picker = $('.selectpicker');
        picker.selectpicker();

    $(document).on('click', picker, function () {
        $('#group').html(
            $('option:selected', picker).parent('optgroup').prop('label') || 'no group'
        );
        $('#text').html(
            $('option:selected', picker).text()
        );
        $('#value').html(
            picker.val()
        );
    });
});

 </script>
-->
<!-- 
<select class="form-control selectpicker" id="select-country" data-live-search="true">

	<option>A</option>
	<option>B</option>
	<option>C</option>
	<option>D</option>

</select> -->
<?php if(isset($selected_account))
{
    unset($selected_account);
}
?>

</body>
</html>