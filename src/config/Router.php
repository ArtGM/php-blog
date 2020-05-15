<?php

namespace Blog\src\config;

use Blog\src\controller\AdminController;
use Blog\src\controller\CommentController;
use Blog\src\controller\FrontController;
use Blog\src\controller\PostController;
use Blog\src\controller\UserController;

class Router
{

    private $admin;
    private $post;
    private $comment;
    private $user;
    private $home;

    /**
     * Router constructor.
     */
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
            case $route->with('admin', 'admin')->match('/admin/gestion-articles'):
                $this->admin->listAllPosts();
                break;
            case $route->with('admin', 'admin')->match('/admin/gestion-commentaires'):
                $this->admin->listAllComments();
                break;
            case $route->with('admin', 'admin')->match('/admin/ajouter'):
                $this->admin->displayPostForm();
                break;
            case $route->with('admin', 'admin')->with('delete', 'delete')->with('id', '[0-9]+')->match('/admin/delete/:id'):
                $post_id = $route->getRouteIdParam();
                $this->post->deletePost($post_id);
                break;
            case $route->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->post->displaySinglePost($post_id);
                break;
            case $route->with('admin', 'admin')->with('edit', 'edit')->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/admin/edit/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->admin->modifyPost($post_id);
                break;
            case $route->match('/newcomment'):
                $this->comment->addComment(filter_input_array(INPUT_POST));
                break;
            case $route->match('/newpost'):
                $this->post->addNewPost(filter_input_array(INPUT_POST));
                break;
            case $route->match('/updatepost'):
                $this->post->updatePost(filter_input_array(INPUT_POST));
                break;
            default:
                header("HTTP/1.0 404 Not Found");
        }
    }
}
