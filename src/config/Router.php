<?php
namespace Blog\src\config;

use Blog\src\controller\CommentController;
use Blog\src\controller\FrontController;
use Blog\src\controller\PostController;
use Blog\src\controller\AdminController;

class Router
{
    public function run()
    {
        $request = $_SERVER['PHP_SELF'] ?? 404;
        $url = explode('/', $request);
        $route = array_slice($url, array_key_last($url));
        switch ($route[0]) {
            case 'index.php':
                $home = new FrontController();
                $home->homePage();
                break;
            case 'blog':
                $post = new PostController();
                $post->displayPosts();
                break;
            case 'admin':
                $admin = new AdminController();
                $admin->runDashboard();
                break;
            case (preg_match('/^[0-9]{1,3}-[a-zA-Z]*/', $route[0]) ? true : false):
                $post = new PostController();
                $comment = new CommentController();
                preg_match('/^[0-9]{1,3}/', $route[0], $id);
                $post_id = $id[0];
                $post->displaySinglePost($post_id);
                $comment->displayPostComments($post_id);
                break;
        }
    }
}
