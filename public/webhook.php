<?php

$record = [
	'GET' => $_GET,
	'POST' => $_POST
];

file_put_contents(realpath(dirname(__FILE__))."/test.txt", var_export($record, true));