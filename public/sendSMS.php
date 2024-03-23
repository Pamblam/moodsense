<?php

use SignalWire\Rest\Client;

require "../vendor/autoload.php";

define('SW_SPACE_URL', 'moodsense.signalwire.com');
define('SW_PHONE_NUM', '+12179616663');
define('TO_NUMBER', '+18137035515');
define('PROJECT_ID', '5eb0b49d-98a0-4b9f-a722-69d80b7fb7ca');
define('API_TOKEN', 'PTb15822179028fc2921d991ec4de4b91f53b7361c2f76afcc');



$body = "Hey there";

$client = new Client(PROJECT_ID, API_TOKEN, [
	"signalwireSpaceUrl" => SW_SPACE_URL
]);

$message = $client->messages->create(TO_NUMBER, [
	"from" => SW_PHONE_NUM, 
	"body" => $body
]);

print($message->sid);