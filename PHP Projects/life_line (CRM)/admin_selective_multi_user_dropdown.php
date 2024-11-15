<?php


if (check_admin($_SESSION[ 'email' ])) {
  ?>         
     
<label class="">Select Seller</label>


            <select  multiple="multiple" name="username[]" required  class="form-control">
          
  <?php populateDDsel("user","concat(email,' | ',name)","email","") ?>
                <option value="null">No User</option>
        </select>

<?php
} else {
  ?>
<input type="hidden" name="seller" value="<?php echo $_SESSION[ 'email' ]; ?>">
<?php } ?>
   
