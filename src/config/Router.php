<?php
// namespace Blog\src\config;

class Router
{

    public function run()
    {
        $route = $_SERVER['REQUEST_URI'] ?? 404;

        var_dump($route);
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
