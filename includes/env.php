<?php

// Database Details
define('DB_HOST', 'localhost');
define('DB_SCHEMA', 'moods');
define('DB_USER', 'root');
define('DB_PASS', 'bayhacks');
define('GPT_TOKEN', trim(file_get_contents('/var/www/openai.key')));

define('MSG_INTRO', <<<END
Welcome to MoodSense!

This application allows you to journal your thoughts and feelings to receive helpful feedback as well as provide a tracker for your mood in a calendar form!

Type Help or Menu for help.
Type Calendar to see a calendar record of your entries so far.
Otherwise, feel free to message how your day is going!
END);

define('MSG_CALENDAR', <<<END
Click here to view your calendar. {{CAL_LINK}}
END);

define('MSG_RESOURCES', <<<END
It seems like you are having a particularly bad day. Here are some resources that you should check out to help you during this time. https://rb.gy/7nnnaw

END);

date_default_timezone_set('America/New_York');

// Create Database connection
$dsn = "mysql:host=".DB_HOST.";dbname=".DB_SCHEMA.";charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);