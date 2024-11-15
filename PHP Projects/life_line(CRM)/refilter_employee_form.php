<script>
function filternow()
    {
        //alert("hello");
        document.getElementById("filterform").submit();
    }
</script>
<style>
    label{
        height: 0px;
        margin: 0;
        padding: 0;
    }
</style>
<form id="filterform">
  <div style="border: 1px solid black; padding: 5px;" align="center">
  <table width="100%">
    <tr>
      <th><label>User <select name="allocated_to" onChange="filternow();">
          <option value="allocated_to" >ANY</option>
          <?php populateDDsel("user","email","email",$_REQUEST['allocated_to']) ?>
        </select></label></th>
      <th><label>Phone 1 Network<select name="phone1network">
          <option value="phone1network" >ANY</option>
          <?php populateDDsel("network","network","network",$_REQUEST['phone1network']) ?>
        </select></label></th>
      <th><label>Phone 2 Network<select name="phone2network">
          <option value="phone2network" >ANY</option>
          <?php populateDDsel("network","network","network",$_REQUEST['phone2network']) ?>
        </select></label></th>
      <th><label>Call Status <select name="call_status">
          <option value="call_status" >ANY</option>
          <?php populateDDsel("status_list","status_name","status_name",$_REQUEST['call_status']) ?>
        </select></label></th>
      <th><label>Order Status<select name="order_status">
          <option value="order_status" >ANY</option>
          <?php populateDDsel("order_status  order by sort","order_status","order_status",$_REQUEST['order_status']) ?>
        </select></label></th>
 
      <th> <input type="submit" value="Filter" name="filter"></th>
    </tr>
  </table>
</form>
</div>
