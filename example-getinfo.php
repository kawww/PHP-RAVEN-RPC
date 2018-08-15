<?php
include("rpc.php");

$rpc = new Linda();
$getinfo = $rpc->getinfo();
$error = $rpc->error;

if($error != "") {
	echo "<p>Error: $error</p>";
	exit;
}

echo "<pre>";
print_r($getinfo);
echo "</pre>";
?>