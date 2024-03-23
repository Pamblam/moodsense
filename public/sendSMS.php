<?php

use SignalWire\Rest\Client;

define('SW_SPACE_URL', '..');
define('SW_PHONE_NUM', '..');

$client = new Client($PROJECT_ID, $API_TOKEN, [
	"signalwireSpaceUrl" => SW_SPACE_URL
]);

$message = $client->messages->create($TO_NUMBER, [
	"from" => $SW_PHONE_NUM, 
	"body" => "Hello"
]);

print($message->sid);