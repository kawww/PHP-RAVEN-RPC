<?php
include("rpc.php");

$rpc = new Linda();

////////////// STEP 1: get unspent transactions

//$unspent = $rpc->listunspent(); //list ALL unspent transactions
$unspent = $rpc->listunspent(2, 999999999, array("LdtNCwNzEbBPZNf7xK9SfmZ7KGChCNW1EF")); //List all unspent transactions with minimum 2 confirms of the listed addresses (add , "otheraddress" for multiple addresses)

$error = $rpc->error;

if($error != "") {
	echo "<p>Error 1: $error</p>";
	exit;
}

echo "<p>Result 1 (listunspent):</p>";
echo "<pre>";
print_r($unspent);
echo "</pre>";
echo "<hr>";

/*
Returns:

Array
(
    [0] => Array
        (
            [txid] => 32dff4a356fca13078d100d7edcacb27586a67752fb2674452fb2b390e5f8f89
            [vout] => 0
            [address] => LdtNCwNzEbBPZNf7xK9SfmZ7KGChCNW1EF
            [account] => 
            [scriptPubKey] => 76a914ccb60ec6918dd12b37c88c5b99b52d2b49429a9b88ac
            [amount] => 15
            [confirmations] => 764
        )

)

*/

////////////// STEP 2: create rawtransaction

$rawtransaction = $rpc->createrawtransaction(array(array("txid"=>"32dff4a356fca13078d100d7edcacb27586a67752fb2674452fb2b390e5f8f89", "vout"=>0)), array("LNT25R2ymFFu7mFKfYRdMK8TK7x2E1P13k"=>5, "LdtNCwNzEbBPZNf7xK9SfmZ7KGChCNW1EF"=>9.999)); //sending 5 Linda to another address
//in this example address only has 1 unspent transaction, in case you want to send all unspent transactions add for loop to count($unspent) and add to an array in an array

/*
IMPORTANT !!!!!!!!!!!!!!
In the createrawtransaction you HAVE to add your senders address as last parameter in the array as return address!
Failing to add this part will result in that the whole balance of the wallet will be used as fees! Nevertheless the amount!!!
The amount you add their is amountofunspent - amountyouwishtosend - transactionfees
In this example = 15-5-0.001 = 9.999
In case your fee is too low the transaction won't confirm
*/

$error = $rpc->error;

if($error != "") {
	echo "<p>Error 2: $error</p>";
	exit;
}

echo "<p>Result 2 (createrawtransaction):</p>";
echo "<p>$rawtransaction</p>";

echo "<hr>";

/*
Returns:

010000008c22755b01898f5f0e392bfb524467b22f75676a5827cbcaedd700d17830a1fc56a3f4df320000000000ffffffff020065cd1d000000001976a9142360f7ee5170d3e760a7ec84414055e1bf90f92f88ac6043993b000000001976a914ccb60ec6918dd12b37c88c5b99b52d2b49429a9b88ac00000000

*/

////////////// STEP 3: sign rawtransaction

$signtransaction = $rpc->signrawtransaction($rawtransaction);

$error = $rpc->error;

if($error != "") {
	echo "<p>Error 3: $error</p>";
	exit;
}

echo "<p>Result 3 (signrawtransaction):</p>";
echo "<pre>";
print_r($signtransaction);
echo "</pre>";
echo "<hr>";

/*
Returns:

Array
(
    [hex] => 010000008c22755b01898f5f0e392bfb524467b22f75676a5827cbcaedd700d17830a1fc56a3f4df32000000006b483045022100d0865b12f7547a3b7845be1f5a60c4c7b14cfd10f605a06e462dd22c9bc55518022044b594133d1d75af9aa00aceaef6a7c91b2f51216cb93e7b6bd3c68961141c8401210281503249d417b672bc544da28de9cd49c1abbc3b4f80c1c0963b8c32664ced72ffffffff020065cd1d000000001976a9142360f7ee5170d3e760a7ec84414055e1bf90f92f88ac6043993b000000001976a914ccb60ec6918dd12b37c88c5b99b52d2b49429a9b88ac00000000
    [complete] => 1
)

*/

////////////// STEP 4: send rawtransaction

$hex = $signtransaction["hex"];
$sendtransaction = $rpc->sendrawtransaction($hex);

$error = $rpc->error;

if($error != "") {
	echo "<p>Error 4: $error</p>";
	exit;
}

echo "<p>Result 4 (sendrawtransaction):</p>";
echo "<p>TxID: $sendtransaction</p>";

/*
Returns:

859c85a2f8d4b73fc915e7967693adf711cfa943b496455446ccdf5d77f6e43c

*/

//Watch this transaction on the explorer: https://lindaexplorer.kdhsolutions.co.uk/tx/859c85a2f8d4b73fc915e7967693adf711cfa943b496455446ccdf5d77f6e43c
?>