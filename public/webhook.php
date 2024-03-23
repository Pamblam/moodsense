<?php

/**
 * Post Paramters:
	'MessageSid' => '15f11ce2-f233-46ea-9283-54964411f1f2',
	'SmsSid' => '15f11ce2-f233-46ea-9283-54964411f1f2',
	'AccountSid' => '5eb0b49d-98a0-4b9f-a722-69d80b7fb7ca',
	'From' => '+18137035515',
	'To' => '+12179616663',
	'Body' => 'Bop',
	'NumMedia' => '0',
	'NumSegments' => '1',
 */
require "gpt.php";

if(!empty($_REQUEST['Body']) && !empty($_REQUEST['From'])){

	$host = 'localhost';
	$db   = 'moods';
	$user = 'root';
	$pass = 'bayhacks';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$pdo = new PDO($dsn, $user, $pass, $options);
	
	$response = getRating($_REQUEST['Body']);

	$re = '/Rating:\s(\d+)[^:]*:\s(.*)/';
	preg_match($re, $response, $gob);
	$rating = $gob[1];

	$gpt_response = $gob[2];

	$stmt = $pdo->prepare("insert into moods (from_number, entry, rating, response, ts) values (?, ?, ?, ?, ?)");
	$stmt->execute([$_REQUEST['From'], $_REQUEST['Body'], $rating, $gpt_response, time()]);
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	?>
	<Response>
		<Message><?php echo $gpt_response; ?></Message>
	</Response><?php

}