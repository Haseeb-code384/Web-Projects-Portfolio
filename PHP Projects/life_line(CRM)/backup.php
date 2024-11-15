
<?php 
include ('dumper.php');
include ('config.php');
$date=date('Y-m-d');
try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => $host,
		'username' => $username,
		'password' => $password,
		'db_name' => $database,
	));

	// dump the database to gzipped file
	//$world_dumper->dump('apostle.sql.gz');
$file_name="backups/$project_name".$date.".sql";
	// dump the database to plain text file
	if(!$world_dumper->dump($file_name))
	{
	
		
		header('Content-Type:text/sql; charset=utf-8');
    header("Content-Disposition: attachment; filename=$file_name.sql");
		
readfile($file_name);	
	}

	// $wp_dumper = Shuttle_Dumper::create(array(
	// 	'host' => '',
	// 	'username' => 'root',
	// 	'password' => '',
	// 	'db_name' => 'apostle',
	// ));

	// // Dump only the tables with wp_ prefix
	// $wp_dumper->dump('apostle.sql', 'wp_');
	
	// $countries_dumper = Shuttle_Dumper::create(array(
	// 	'host' => '',
	// 	'username' => 'root',
	// 	'password' => '',
	// 	'db_name' => 'apostle',
	// 	'include_tables' => array('country', 'city'), // only include those tables
	// ));
	// $countries_dumper->dump('apostle.sql.gz');

	// $world_dumper = Shuttle_Dumper::create(array(
	// 	'host' => '',
	// 	'username' => 'root',
	// 	'password' => '',
	// 	'db_name' => 'apostle',
	// 	'exclude_tables' => array('city'), 
	// ));
	// $world_dumper->dump('world-no-cities.sql.gz');

} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}