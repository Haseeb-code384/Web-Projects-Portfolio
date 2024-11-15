<style>
.tb
    {
        width: 25%;
        text-align: center;
        border:1px solid grey;
        border-radius: 5px;
    }
</style>
<ul class="nav nav-tabs col-sm-12">
    <a href="distribute_inquiry_wizard_select_users.php" class="tb"><li class=" nav-link <?php echo $currentPage=='distribute_inquiry_wizard_select_users.php' ? 'active bg-success text-white' : '' ?>"><i class="fa fa-users"></i> Users Selection</li></a>
     <a href="distribute_inquiry_wizard_select_disease.php" class="tb"><li class=" nav-link <?php echo $currentPage=='distribute_inquiry_wizard_select_disease.php' ? 'active bg-success text-white' : '' ?>"><i class="fa fa-users"></i> Disease Selection</li></a>
    
    <a href="distribute_inquiry_wizard_select_date.php" class="tb">
        <li class=" nav-link <?php echo $currentPage=='distribute_inquiry_wizard_select_date.php' ? 'active bg-success text-white' : '' ?>"><i class="fa fa-calendar"></i> Date Selection</li>
    </a>

    <a href="#distribute_inquiry_wizard_select_users_networks.php" class="tb">
        <li class="  nav-link <?php echo $currentPage=='distribute_inquiry_wizard_select_users_networks.php' ? 'active bg-success text-white' : '' ?>"><i class="fa fa-phone-square"></i> Network Selection</li>
    </a>

  
</ul>
