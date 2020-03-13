<?php
require '../src/config/config.php';
require '../vendor/autoload.php';
use Blog\src\config\Router;
use Twig\Environment;

$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__). '/src/view');
$twig = new Environment($loader, [
    'cache' => 'false',
]);

echo '<a href="/"><h1>HEADER</h1></a>';

?>
    <ul>
        <li><a href="/blog">Blog</a></li>
    </ul>
    <ul>
        <li><a href="/admin">Admin</a></li>
    </ul>

<?php

$router = new Router();

$router->run();

echo '<h1>FOOTER</h1>';
