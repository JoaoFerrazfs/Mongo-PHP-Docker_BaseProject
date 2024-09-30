<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://mongo:27017");
$collection = $client->test->users;

echo "Conexão com MongoDB estabelecida!";
