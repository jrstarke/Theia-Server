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
	$gid = mysql_real_escape_string($_POST["gid"]);
	if (!$gid)
		$gid = 0;

	$queries = json_decode($_POST["queries"]);
	$clicks = json_decode($_POST["clicks"]);
	$navigations = json_decode($_POST["navigations"]);

	if ($queries) {
		$storedQueries = array();
		for ($i = 0; $i < count($queries); $i++){
			$query = $queries[$i];

			// If the query is empty, don't bother
			if(urldecode($query->query) == "") {
				$storedQueries[] = $i;
				continue;
			}
			$sql = "INSERT INTO queries (participant, gid, timestamp, site, query, page) " .
                " VALUES ('$pid', '$gid', " . mysql_real_escape_string($query->timestamp) . ", '" . mysql_real_escape_string($query->site) .
                "', '" . mysql_real_escape_string(urldecode($query->query)) . "', " . intval(mysql_real_escape_string($query->page)) . ")";
				
			// Make sure the query stores, and if it does, track this
			if (mysql_query($sql))
			{
				$storedQueries[] = $i;
			}
			else 
			{
				if (!$error) $error = array();
				$error[] = "query " . $i . ": " . mysql_error();
			}
		}
	}

	if ($clicks) {
		$storedClicks = array();
		for ($i = 0; $i < count($clicks); $i++){
			$click = $clicks[$i];

			$sql = "INSERT INTO clicks (participant, gid, timestamp, site, query, title, url, page) " .
                " VALUES ('$pid', '$gid', " . mysql_real_escape_string($click->timestamp) . ", '" . mysql_real_escape_string($click->site) . 
                "', '" . mysql_real_escape_string(urldecode($click->query)) .
                "', '" . mysql_real_escape_string($click->title) .
                "', '" . mysql_real_escape_string($click->url) . 
                "', " . $click->page . ")";
			
			// Track successfully stored clicks
			if (mysql_query($sql))
			{
				$storedClicks[] = $i;
			}
			else
			{
				if (!$error) $error = array();
				$error[] = "click " . $i . ": " . mysql_error();
			}
		}
	}
	
	if ($navigations) {
		$storedNavigations = array();
		for ($i = 0; $i < count($navigations); $i++){
			$nav = $navigations[$i];
	
			$sql = "INSERT INTO visits (participant, gid, timestamp, title, url, referrer) " .
	                " VALUES ('$pid', '$gid', " . mysql_real_escape_string($nav->timestamp) . ", '" . mysql_real_escape_string($nav->title) .
	                "', '" . mysql_real_escape_string($nav->url) . "', '" . mysql_real_escape_string($nav->referrer) . "')";
	
			// Make sure the query stores, and if it does, track this
			if (mysql_query($sql))
			{
				$storedNavigations[] = $i;
			}
			else
			{
				if (!$error) $error = array();
				$error[] = "navigation " . $i . ": " . mysql_error();
			}
		}
	}
	
	$blacklist = array();
	
	$sql = "SELECT site FROM blacklist WHERE gid = '0'";
	if ($result = mysql_query($sql))
	{
		while ($row = mysql_fetch_array($result))
		{
			$blacklist[] = $row['site'];
		}
	}
	
	$sql = "SELECT site FROM blacklist WHERE gid = '" . $gid . "'";
	if ($result = mysql_query($sql))
	{
		while ($row = mysql_fetch_array($result))
		{
			$blacklist[] = $row['site'];
		}
	}

	// Return the list of stored clicks and queries to the logger for removal
	$output = array("storedClicks"=>$storedClicks,"storedQueries"=>$storedQueries,"storedNavigations"=>$storedNavigations,"blacklist"=>$blacklist);
	if ($error)
		$output["error"] = $error;
	
	echo json_encode($output);
} else {
	echo array("error"=>"The server was unable to connect to the database at this time");
}
?>