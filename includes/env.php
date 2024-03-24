<?php

// Database Details
define('DB_HOST', 'localhost');
define('DB_SCHEMA', 'moods');
define('DB_USER', 'root');
define('DB_PASS', 'bayhacks');
define('GPT_TOKEN', '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');

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

// Create Database connection
$dsn = "mysql:host=".DB_HOST.";dbname=".DB_SCHEMA.";charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);