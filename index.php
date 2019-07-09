<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

$anonymizer = new \Kosinski\Anonymizer\Anonymizer();

echo "<pre>";
print_r($anonymizer->email([
    "email_1" => 'kubakssk@gmail.com',
    "email_2" => 'kubakssk@gmail.com',
    "email_3" => 'kubakssk@gmail.com',
    "email_4" => '12kubakssk@gmail.com',
    'xddd@gmail.com'
]));
echo "</pre>";