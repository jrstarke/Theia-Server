<?php 
$version = "0.1.0";
$location = "https://keg.cs.uvic.ca/collector/chisel/LoggerChrome.crx";
$id = "eedklndieapabghiipipbfibbkndmpcg";

header("Content-type: text/xml");

$x = $_GET['x'];

$keys = array();
$params = explode('&',$x);
foreach ($params as $param)
{
	$val = explode('=',$param);
	$keys[$val[0]] = $val[1]; 
}

if ($keys['id'])
	$id = $keys['id'];
echo "<?xml version='1.0' encoding='UTF-8'?>"; ?>
<gupdate xmlns='http://www.google.com/update2/response' protocol='2.0'>
  <app appid='<?php echo $id ?>'>
    <updatecheck codebase='<?php echo $location ?>' version='<?php echo $version ?>' />
  </app>
</gupdate>