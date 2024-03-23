<?php

function getGPTResponse($token, $context, $input){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer '.$token,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "model" => "gpt-3.5-turbo",
            "messages" => [[
            "role" => "system",
            "content" => $context
        ], [
            "role" => "user",
            "content" => $input
        ]]
    ]));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    return $response->choices[0]->message->content;
}

function promptUser($prompt){
    echo "$prompt ";
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    fclose($handle);
    return trim($line); 
}

function getRating($entry){
	$token = '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';
	$context = "Given a journal entry, rate how upset the author might be on a scale of 1 to 10, 10 being the most upset. Also give advice to the author about how to deal with the emotions.";
	return getGPTResponse($token, $context, $entry);
}

function isHelpRequest($input){
    $input = strtolower($input);
    $input = trim($input);
    $input = preg_replace('/[^A-Za-z]/', '', $input);
    $matches = [
        "help",
        "menu"
    ];
}
