<?php

require "../includes/env.php";
require "../includes/functions.php";

if(!empty($_REQUEST['Body']) && !empty($_REQUEST['From'])){
	
	if(isHelpRequest($_REQUEST["Body"])){
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<Response><Message>' . MSG_INTRO . '</Message></Response>';

	}else if(isCalendarRequest($_REQUEST["Body"])){
		$url = "https://moodsense.dev/journal.php?phone=" . urlencode($_REQUEST['From']);
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<Response><Message>' . str_replace('{{CAL_LINK}}', $url, MSG_CALENDAR) . '</Message></Response>';

	}else{
		$response = getRating($_REQUEST['Body'], GPT_TOKEN);
		$re = '/(\d+)[^:]*:\s?(.*)/';
		preg_match($re, $response, $gob);
		$rating = intval($gob[1]);
		$gpt_response = $gob[2];
		$stmt = $pdo->prepare("insert into entries (from_number, entry, rating, response, ts) values (?, ?, ?, ?, ?)");
		$stmt->execute([$_REQUEST['From'], $_REQUEST['Body'], $rating, $gpt_response, time()]);
		if($rating > 7) $gpt_response = MSG_RESOURCES.$gpt_response;
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<Response><Message>' . $gpt_response . '</Message></Response>';

	}

}