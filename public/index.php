<?php
require '../vendor/autoload.php';
require '../router.php';
require '../src/helpers.php';

use Mongolid\Connection\Manager;
use Mongolid\Connection\Connection;

$manager = new Manager();
$connection = $manager->setConnection(new Connection('mongodb://mongo:27017'));

if (!$connection) {
    echo "Erro ao estabelecer conexão com o MongoDB.";
    exit;
}

// Routes
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

route($requestUri);
