<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "'".file_get_contents('/var/www/openai.key')."'";