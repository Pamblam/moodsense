<?php

require "gpt.php";

$entry = promptUser("entry");

echo getRating($entry);
echo "\n";