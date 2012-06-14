<?php
$db_server = "";
$db_name = "";
$db_user = "";
$db_password = "";
$connected = mysql_connect($db_server, $db_user, $db_password);

if ($connected)
{
	mysql_select_db($db_name);
	
	$gid = mysql_real_escape_string($_POST["gid"]);
	$outside_ip = $_SERVER['REMOTE_ADDR'];
	
	$sql = "INSERT INTO participants (timestamp,gid,ip) values (NOW(),'". $gid . "','" . $outside_ip . "')";
	//echo $sql . "\n";
	if (mysql_query($sql))
	{
		echo mysql_insert_id();
	}
	else
	{
		die("Unable to create participant id: " . mysql_error());
	}
}
else
{
	die("Unable to connect to database to get participant id");
}

?>