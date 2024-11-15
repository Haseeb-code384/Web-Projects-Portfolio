<form>
					<div style="border: 1px solid black; padding: 5px;" align="center">
						<i style="font-size: 18pt;" class="fa fa-filter"></i>
					
	
	
	<label>Phone 1 Network</label>
	<select name="phone1network">
		<option value="phone1network" >ANY</option>
	<?php populateDDsel("network","network","network",$_REQUEST['phone1network']) ?>
	</select>
		
	<label>Phone 2 Network</label>
	<select name="phone2network">
		<option value="phone2network" >ANY</option>
	<?php populateDDsel("network","network","network",$_REQUEST['phone2network']) ?>
	</select>
		
	<input type="submit" value="Filter" name="filter">
	</form></div>