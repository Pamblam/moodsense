<?php

use SignalWire\Rest\Client;

require "../vendor/autoload.php";

define('SW_SPACE_URL', 'moodsense.signalwire.com');
define('SW_PHONE_NUM', '+12179616663');
define('TO_NUMBER', '+18137035515');
define('PROJECT_ID', '5eb0b49d-98a0-4b9f-a722-69d80b7fb7ca');
define('API_TOKEN', 'PTb15822179028fc2921d991ec4de4b91f53b7361c2f76afcc');



$body = "Hey there";



// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://' . SW_SPACE_URL . '/api/laml/2010-04-01/Accounts/' . PROJECT_ID . '/Messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, PROJECT_ID . ':' . API_TOKEN);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
	'From' => SW_PHONE_NUM,
	'To' => TO_NUMBER,
	'Body' => $body
]));

$response = curl_exec($ch);

curl_close($ch);

print($response);

// $client = new Client(PROJECT_ID, API_TOKEN, [
// 	"signalwireSpaceUrl" => SW_SPACE_URL
// ]);

// $message = $client->messages->create(TO_NUMBER, [
// 	"from" => SW_PHONE_NUM, 
// 	"body" => $body
// ]);

// print($message->sid);