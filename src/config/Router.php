<?php
namespace Blog\src\config;
use Blog\src\controller\FrontController;
use Blog\src\controller\PostController;
use Blog\src\controller\AdminController;
class Router
{

    public function run()
    {
        $route = $_SERVER['REQUEST_URI'] ?? 404;
        switch ($route) {
            case '/blog':
                $post = new PostController();
                $post->getPosts();
                break;
            case '/admin':
                $admin = new AdminController();
                $admin->runDashboard();
                break;
            default:
                $home = new FrontController();
                $home->homePage();
        }
    }
}
