<?php
require '../src/config/config.php';
require '../vendor/autoload.php';

use Blog\src\config\Router;

$router = new Router();

$router->run($_SERVER['REQUEST_URI']);
