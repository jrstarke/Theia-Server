<?php
$db_server = "";
$db_name = "";
$db_user = "";
$db_password = "";
$connected = mysql_connect($db_server, $db_user, $db_password);
$debug = true;

if ($connected)
{
	mysql_select_db($db_name);

	$pid = mysql_real_escape_string($_POST["pid"]);
	if (!$pid)
		$pid = 0;
	
	$gid = mysql_real_escape_string($_POST["gid"]);
	if (!$gid)
		$gid = 0;

	$site = mysql_real_escape_string($_POST["site"]);
	if (!$site)
		$site = "";
	
	$context = mysql_real_escape_string($_POST["context"]);
	if (!$context)
	$context = "";
	
	$message = mysql_real_escape_string($_POST["message"]);
	if (!$message)
	$message = "";
	
	$stack = mysql_real_escape_string($_POST["stack"]);
	if (!$stack)
	$stack = "";

	$sql = "INSERT INTO errors (timestamp, pid, gid, site, context, message, stack) " .
                " VALUES (NOW(), '$pid', '$gid', '$site', '$context', '$message', '$stack')";
	// Make sure the query stores, and if it does, track this
	if (mysql_query($sql))
	{
		echo "Your error has successfully submitted, thank you for your support!\n";
		echo $pid . " " . $gid . " " . $site . " " . $context . " " . $message . " " . $stack;
	}
	else 
	{
		echo "We were unable to submit your error at this time";
	}
} else {
	echo "The server was unable to connect to the database at this time";
}
?>