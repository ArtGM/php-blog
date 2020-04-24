<?php
namespace Blog\src\config;

use Blog\src\controller\AdminController;
use Blog\src\controller\CommentController;
use Blog\src\controller\FrontController;
use Blog\src\controller\PostController;
use Blog\src\controller\UserController;

class Router
{
    // TODO: improve router matching
    private $url;
    private $routes = [];
    private $admin;
    private $post;
    private $comment;
    private $user;
    private $home;

    public function __construct()
    {
        //$this->url = $url;
        $this->admin = new AdminController();
        $this->post = new PostController();
        $this->comment = new CommentController();
        $this->user = new UserController();
        $this->home = new FrontController();
    }

    public function get($path, $fn)
    {
        $route = new Route($path, $fn);
        $this->routes['GET'][] = $route;
    }

    public function run()
    {
        $request = $_SERVER['PHP_SELF'] ?? 404;
        var_dump($request);
        $url = explode('/', $request);
        $route = array_slice($url, array_key_last($url));
        //var_dump($_POST);
        switch ($route[0]) {
            case 'index.php':
                $this->home->homePage();
                break;
            case 'blog':
                $this->post->displayPosts();
                break;
            case 'admin':
                $this->admin->runDashboard();
                break;
            case 'gestion-articles':
                $this->admin->listAllPost();
                break;
            case 'ajouter':
                $this->admin->addNewPostForm();
                break;
            case (preg_match('/^[0-9]{1,3}-[a-zA-Z]*/', $route[0]) ? true : false):
                preg_match('/^[0-9]{1,3}/', $route[0], $id);
                $post_id = $id[0];
                $this->post->displaySinglePost($post_id);
                break;
            case 'confirm':
                $this->comment->addComment($_POST);
                break;

        }
    }
}
