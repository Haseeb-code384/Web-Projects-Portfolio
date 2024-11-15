<html>
    <head>
        <title>ZK Device Info</title>
    </head>
    
    <body>
<?php
		include("config.php");
		include("allFunctions.php");
    include("zklib/zklib.php");
    $gate=$_REQUEST['gate'];
    $ip=$_REQUEST['ip'];
		?>
		<h1 align="center">Gate: <?php echo $gate; ?></h1>
		<h1 align="center">Device IP: <?php echo $ip; ?></h1>
		<?php
    $zk = new ZKLib($ip, 4370);
    
    $ret = $zk->connect();

  
    ?>
        
        <table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <td><b>Status</b></td>
                <td>Connected</td>
                <td><b>Version</b></td>
                <td><?php echo $zk->version() ?></td>
                <td><b>OS Version</b></td>
                <td><?php echo $zk->osversion() ?></td>
                <td><b>Platform</b></td>
                <td><?php echo $zk->platform() ?></td>
            </tr>
            <tr>
                <td><b>Firmware Version</b></td>
                <td><?php echo $zk->fmVersion() ?></td>
                <td><b>WorkCode</b></td>
                <td><?php echo $zk->workCode() ?></td>
                <td><b>SSR</b></td>
                <td><?php echo $zk->ssr() ?></td>
                <td><b>Pin Width</b></td>
                <td><?php echo $zk->pinWidth() ?></td>
            </tr>
            <tr>
                <td><b>Face Function On</b></td>
                <td><?php echo $zk->faceFunctionOn() ?></td>
                <td><b>Serial Number</b></td>
                <td><?php echo $zk->serialNumber() ?></td>
                <td><b>Device Name</b></td>
                <td><?php echo $zk->deviceName(); ?></td>
                <td><b>Get Time</b></td>
                <td><?php echo $zk->getTime() ?></td>
            </tr>
        </table>
        <hr />
		<center>
        <table border="1" cellpadding="5" cellspacing="2" style="margin-right: 10px;">
            <tr>
                <th colspan="6">Data User</th>
            </tr>
            <tr>
                <th>SN</th>
                <th>Employee ID</th>
                <th>Army No</th>
                <th>Name</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
            <?php
	$i=1;
            try {
                
                //$zk->setUser(1, '1', 'Admin', '', LEVEL_ADMIN);
                $user = $zk->getUser();
                sleep(1);
                while(list($uid, $userdata) = each($user)):
                    if ($userdata[2] == LEVEL_ADMIN)
                        $role = 'ADMIN';
                    elseif ($userdata[2] == LEVEL_USER)
                        $role = 'USER';
                    else
                        $role = 'Entry Form Device';
                ?>
                <tr>
					
                    <td><?php echo $i; ?></td>
                    <td bgcolor="<?php
								 echo showQuery("SELECT 'red' FROM `employee` WHERE id='$userdata[0]' AND gate!='$gate' ");
								 
								 ?>"><?php echo $userdata[0] ?> </td>
                    <td><?php echo showQuery("SELECT army_no FROM `employee` WHERE id='$userdata[0]'");  ?></td>
                    <td><?php echo $userdata[1] ?></td>
                    <td><?php echo $role ?></td>
					<td><a href="del_user_from_device.php?emp_no=<?php echo $userdata[0] ?>&ip=<?php echo $ip; ?>"><button>Delete</button></a></td>
                </tr>
                <?php
				$i++;
                endwhile;
            } catch (Exception $e) {
                header("HTTP/1.0 404 Not Found");
                header('HTTP', true, 500); // 500 internal server error                
            }
            //$zk->clearAdmin();
            ?>
        </table>
        
    </center>
    </body>
</html>
