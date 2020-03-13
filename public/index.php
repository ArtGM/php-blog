<?php

require '../vendor/autoload.php';
require '../src/config/Router.php';
require '../src/controller/FrontController.php';
require '../src/controller/AdminController.php';
require '../src/controller/PostController.php';
require '../src/model/Post.php';

$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__). '/src/view');
$twig = new \Twig\Environment($loader, [
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
