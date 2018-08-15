<?php
include("rpc.php");

$rpc = new Linda();
$newaddress = $rpc->getnewaddress();
$error = $rpc->error;

if($error != "") {
	echo "<p>Error: $error</p>";
	exit;
}

echo "<p>New address: $newaddress</p>";
?>