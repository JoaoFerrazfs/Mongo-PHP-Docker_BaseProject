<?php
// router.php

use App\Trainer\Controller\TrainerController;

function route($uri) {
    switch ($uri) {
        case '/':
            home();
            break;
        case '/trainers':
            $controller = new TrainerController();
            $controller->index();
            break;
        case '/trainers/create':
            $controller = new TrainerController();
            $controller->create();
            break;
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
    }
}

function home() {
    echo "Bem-vindo à página inicial!";
}
