<?php
include("rpc.php");

$rpc = new Linda();
$txid = $rpc->sendtoaddress("LXFo7eDPL3cAgGbYXDq9gtenyX7LQQfptT", 1000); //Send 1000 Linda to address; picks random available funds
$error = $rpc->error;

if($error != "") {
	echo "<p>Error: $error</p>";
	exit;
}

echo "<p>TxID: $txid</p>";
?>