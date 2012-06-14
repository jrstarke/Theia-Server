<?php
	// If the url starts with '/collector/index.php'
	if (strpos($_SERVER['REQUEST_URI'],'/collector/index.php') !== 0)
	{
		header("Location: https://keg.cs.uvic.ca/collector/index.php");
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Search Data Collection</title>
<style type="text/css">
td {
	border: 1px solid #AAA;
}

textarea {
	display: none;
}
</style>
</head>
<body>

	<h1>Welcome to the search collection system.</h1>
	<h2>Data Review</h2>
	<p>The data shown below has not yet been sent to the server. Please
		review the data, and if you are satisfied, click submit to send us
		your data.</p>
	<p>For the purposes of this pilot project, the searches will not be set
		over a secure connection, However, the server is local, so you need
		only worry about your colleagues (who you are likely pairing with
		anyway).</p>

	<form action="collect.php" method="POST">
		<h2>Participant ID</h2>
		<div id="pid"></div>
		<textarea cols="80" rows="20" id="pid-json" name="pid" readonly></textarea>
		<h2>Searches performed</h2>
		<div id="queries"></div>
		<textarea cols="80" rows="20" id="queries-json" name="queries"
			readonly></textarea>
		<h2>Resulted selected</h2>
		<div id="clicks"></div>
		<textarea cols="80" rows="20" id="clicks-json" name="clicks" readonly></textarea>
		<br /> <input type="submit" value="Looks Good, Submit" />
	</form>
</body>
</html>
