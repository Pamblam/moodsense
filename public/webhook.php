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

	

}