<?php  

$db['db_host'] = "127.0.0.1";
$db['db_user'] = "user";
$db['db_pass'] = "1ag1Z6TwfWHFSN7Q";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
	
	define(strtoupper($key), $value);

}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$connection) {

	echo "Error ! Unable to connect to Database". mysqli_error($connection);

}

?>
