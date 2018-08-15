<?php
include("rpc.php");

$rpc = new Linda();
$rawtransaction = $rpc->getrawtransaction("649fb4ee6be487ff3b8b163b39e68a44dd905ed19b2c37ce40998eb65315e987");
$error = $rpc->error;

if($error != "") {
	echo "<p>Error: $error</p>";
	exit;
}

echo "<p>Output: $rawtransaction</p>";
?>