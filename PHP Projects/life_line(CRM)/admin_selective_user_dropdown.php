<?php


if (check_admin($_SESSION[ 'email' ])) {
  ?>         
     
<label class="">Select Seller</label>

<input type="text" class="form-control" id="search_am" placeholder="Search Seller">
<select id="am"   class="form-control" type="text" name="seller">
  <?php populateDDsel("user where active=1","concat(email,' | ',name)","email","$seller") ?>
    <option value="">No User</option>
</select>
    <script>
    const select_am = document.getElementById("am");
const selectSearch_am = document.getElementById("search_am");
const options_am = select_am.options;
selectSearch_am.addEventListener("input", function() {
  const searchValue = selectSearch_am.value.toLowerCase();
  for (let i = 0; i < options_am.length; i++) {
    const optionValue = options_am[i].textContent.toLowerCase();
    if (optionValue.includes(searchValue)) {
      options_am[i].style.display = "block";
    } else {
      options_am[i].style.display = "none";
    }
  }
});

    </script>

<?php
} else {
  ?>
<input type="hidden" name="seller" value="<?php echo $_SESSION[ 'email' ]; ?>">
<?php } ?>
