<?php
require '../src/Config/config.php';
require '../src/Config/mail-cfg.php';
require '../vendor/autoload.php';

use Blog\Config\Router;
use Blog\Config\Session;

$session = new Session();
$data = $session::getInstance();
$router = new Router();

try {
    $router->run($_SERVER['REQUEST_URI']);
} catch (\Twig\Error\LoaderError $e) {
} catch (\Twig\Error\RuntimeError $e) {
} catch (\Twig\Error\SyntaxError $e) {
}
