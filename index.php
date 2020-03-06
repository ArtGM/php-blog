<?php

use Twig\Error\LoaderError;

require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello My name is {{name}}',
]);

$twig = new Twig\Environment($loader);

try {
    echo $twig->render('index', [ 'name' => 'Arthur' ]);
} catch (LoaderError $e) {
} catch (\Twig\Error\RuntimeError $e) {
} catch (\Twig\Error\SyntaxError $e) {
}
