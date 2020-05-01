<?php
namespace Blog\src\config;

use Blog\src\controller\AdminController;
use Blog\src\controller\CommentController;
use Blog\src\controller\FrontController;
use Blog\src\controller\PostController;
use Blog\src\controller\UserController;

class Router
{
    // TODO: Test admin url
    private $admin;
    private $post;
    private $comment;
    private $user;
    private $home;

    public function __construct()
    {
        $this->admin = new AdminController();
        $this->post = new PostController();
        $this->comment = new CommentController();
        $this->user = new UserController();
        $this->home = new FrontController();
    }


    /**
     * @param $path
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function run($path)
    {
        $route = new Route($path);
        switch ($route) {
            case $route->match('/'):
                $this->home->homePage();
                break;
            case $route->match('/blog'):
                $this->post->displayPosts();
                break;
            case $route->match('/admin'):
                $this->admin->runDashboard();
                break;
            case $route->match('/admin/posts'):
                $this->admin->listAllPost();
                break;
            case $route->match('/admin/ajouter'):
                $this->admin->addNewPostForm();
                break;
            case $route->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->post->displaySinglePost($post_id);
                break;
            case 'confirm':
                $this->comment->addComment($_POST);
                break;
            default:
                header("HTTP/1.0 404 Not Found");
        }
    }
}
