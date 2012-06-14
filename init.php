<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Initializing...</title>
<style>
#pid,#gid {visibility:hidden;}
</style>
    <script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="swfobject.js"></script>

<script type="text/javascript">
var capabilities = null;
var params = {
	allowscriptaccess: 'local',
	swliveconnect: 'true',
	wmode: 'transparent'
};
var attributes = {
	id: 'capabilities'
};
var embedHandler = function(e){
	window.setTimeout(function(){
		capabilities = $("#capabilities").get(0);
		if (capabilities.get_cookie)
		{
			var pid = capabilities.get_cookie("pid");
			if (pid)
			{
				$("#pid").html(pid);
			}
		}
		if (!$('#pid').html())
		{
			var gid = parseInt($('#gid').html())
			jQuery.post('newuser.php',{gid:gid},function(data){
				var pid = parseInt(data);
				if (capabilities.set_cookie)
				{
					capabilities.set_cookie("pid",pid);
				}
				$("#pid").html(data);
			});
		}
	},500);
};

swfobject.embedSWF('swf_capabilities.swf?version=' + Math.floor(Math.random()*1000) + '', 'container-div', '1', '1', '10', 'expressInstall.swf', null, params, attributes, embedHandler);	

</script>

</head>
<body>
	<p>Please wait while we retrieve your Participant ID</p>

	<!-- BEGIN SWF-Capabilities -->

	<div id="container-div"></div>
	<div id="pid"></div>
	<div id="gid">1</div>

	<!-- END SWF-Capabilities -->

</body>
</html>
