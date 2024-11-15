<script>
function chnage_row_clr(x,clr)
    {
        clr=document.getElementById("rowclr").value;
        x.style.backgroundColor=clr;
    }
    function chnage_row_wclr(x,clr)
    {
        x.style.backgroundColor=clr;
    }
</script>

<style>
    #employee_data_length
    {
        display: none;
    }
.header {
    position: sticky;
    top: 400;
}
.container {
    width: 600px;
    height: 300px;
    overflow: auto;
}
.table-sm {
    font-size: 9pt;
}
.table-sm > .btn-sm {
    width: 100px;
}
    table.dataTable
    { margin-top: -13px  !important;
    border-collapse: collapse !important;
    }
</style>
<div class="table-responsive col-lg-12 table-sm" style="height: 73vh;">
<table class="table table-fixed table-hover table-striped"  id="employee_data">
    
<thead class="small bg-danger" style="position: sticky;top: 0;color: #fff;
    background-color: #337ab7; font-size: 7pt;">
  <tr style="background-color: black;color: white; height: 5px;" >
    <th colspan="15"><label style="height: 0px;">Highlighter Color</label>
      <input style="height: 10px;" type="color" id="rowclr" value="#EEFF00"></th>
  </tr>
