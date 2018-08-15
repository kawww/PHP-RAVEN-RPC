# PHP-RPC for Linda
PHP Library for interacting with Linda RPC wallet

## Connection
Match the username and password in rpc.php with your Linda wallet configuration (Linda.conf).

## Perform actions
Perform any action as you would perform it like in the console of the wallet.

```php
$rpc = new Linda(); //init
$newaddress = $rpc->getnewaddress(); // Get a new receive address
$newaddress = $rpc->getnewaddress("Holiday"); // Get a new receive address with the name "Holiday"
```

## Error check
The error check will return "" or the exact problem in case something is wrong.

```php
$error = $rpc->error;
```

## VPS
It's possible you have to install curl on your VPS to get this working.