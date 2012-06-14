<?php
// 
$db_server = "";
$db_name = "";
$db_user = "";
$db_password = "";
$connected = mysql_connect($db_server, $db_user, $db_password);

if ($connected)
{
	mysql_select_db($db_name);
	
	$gid = mysql_real_escape_string($_POST["gid"]);
	
	$blacklist = array();
	
	$sql = "SELECT site FROM blacklist WHERE gid = '0'";
	if ($result = mysql_query($sql))
	{
		while ($row = mysql_fetch_array($result))
		{
			$blacklist[] = $row['site'];
		}
	}
	else
	{
		die("Unable to retrieve blacklist: " . mysql_error());
	}
	
	$sql = "SELECT site FROM blacklist WHERE gid = '" . $gid . "'";
	if ($result = mysql_query($sql))
	{
		while ($row = mysql_fetch_array($result))
		{
			$blacklist[] = $row['site'];
		}
	}
	else
	{
		die("Unable to retrieve blacklist: " . mysql_error());
	}
	
	echo json_encode($blacklist);
}
else
{
	die("Unable to connect to database to get participant id");
}

?>