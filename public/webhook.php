<?php

require "../includes/env.php";
require "../includes/functions.php";

if(!empty($_REQUEST['Body']) && !empty($_REQUEST['From'])){
	
	if(isHelpRequest($_REQUEST["Body"])){
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<Response><Message>' . MSG_INTRO . '</Message></Response>';

	}else if(isCalendarRequest($_REQUEST["Body"])){
		$url = "https://moodsense.dev/?phone=" . urlencode($_REQUEST['From']);
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
		if($rating > 7){
			$gpt_response .= " It seems like you are having a particularly bad day. Here are some resources that you should check out to help you during this time. https://rb.gy/7nnnaw";
		}
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<Response><Message>' . $gpt_response . '</Message></Response>';
	}

}