<?php
require '../vendor/autoload.php'; // Isso já inclui o VarDumper

use Symfony\Component\VarDumper\VarDumper;

function myDump(...$vars) {
    foreach ($vars as $var) {
        VarDumper::dump($var);
    }
}

function myDd(...$vars) {
    myDump(...$vars);
    exit; // Para parar a execução do script
}
