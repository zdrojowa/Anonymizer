<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

$anonymizer = new \Kosinski\Anonymizer\Anonymizer();

echo "<pre>";
print_r($anonymizer->email(['kubakssk@gmail.com', 'kubakssk@gmail.com', 'kubakssk@gmail.com', 'kubakssk@gmail.com', 'kubakssk@gmail.com', 'kubakssk@gmail.com', 'kubakssk@gmail.com']));
echo "</pre>";