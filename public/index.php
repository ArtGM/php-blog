<?php
require '../src/config/config.php';
require '../src/config/mail-cfg.php';
require '../vendor/autoload.php';

use Blog\src\config\Router;
use Blog\src\config\Session;

$session = new Session();
$data = $session::getInstance();
$router = new Router();

try {
    $router->run($_SERVER['REQUEST_URI']);
} catch (\Twig\Error\LoaderError $e) {
} catch (\Twig\Error\RuntimeError $e) {
} catch (\Twig\Error\SyntaxError $e) {
}
