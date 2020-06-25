<?php

namespace Blog\src\config;

use Blog\src\controller\AdminController;
use Blog\src\controller\FrontController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Router
{

    private $admin;
    private $front;
    private $session;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->admin = new AdminController();
        $this->front = new FrontController();
        $this->session = Session::getInstance();
    }


    /**
     * @param $path
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function run($path)
    {
        $route = new Route($path);
        switch ($route) {
            case $route->match('/'):
                $this->front->homePage();
                break;
            case $route->match('/blog'):
                $this->front->displayPosts();
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
            case $route->with('admin', 'admin')->match('/admin/gestion-utilisateur'):
                $this->admin->displayUsersList();
                break;
            case $route->with('admin', 'admin')->match('/admin/ajouter'):
                $this->admin->displayPostForm();
                break;
            case $route->with('admin', 'admin')->with('delete', 'delete')->with('id', '[0-9]+')->match('/admin/delete/:id'):
                $post_id = $route->getRouteIdParam();
                $this->admin->deletePost($post_id);
                break;
            case $route->with('admin', 'admin')->with('approvecomment', 'approvecomment')->with('id', '[0-9]+')->match('/admin/approvecomment/:id'):
                $comment_id = $route->getRouteIdParam();
                $this->admin->approveComment($comment_id);
                break;
            case $route->with('admin', 'admin')->with('deletecomment', 'deletecomment')->with('id', '[0-9]+')->match('/admin/deletecomment/:id'):
                $comment_id = $route->getRouteIdParam();
                $this->admin->deleteComment($comment_id);
                break;
            case $route->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->front->displaySinglePost($post_id);
                break;
            case $route->with('admin', 'admin')->with('edit', 'edit')->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/admin/edit/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->admin->modifyPost($post_id);
                break;
            case $route->with('admin', 'admin')->with('profile', 'profile')->with('id', '[0-9]+')->with('name', '[a-z0-9-]+')->match('/admin/profile/:id-:name'):
                $user_id = $route->getRouteIdParam();
                $this->admin->editUserProfile($user_id);
                break;
            case $route->match('/newcomment'):
                // TODO: Add Filter argument on filter_input_array() to validate input
                $validateFilter = [
                    'message'=> FILTER_SANITIZE_ENCODED,
                    'user_id' => FILTER_VALIDATE_INT,
                    'post_id' => FILTER_VALIDATE_INT
                ];
                $this->front->addComment(filter_input_array(INPUT_POST, $validateFilter));
                break;
            case $route->match('/newpost'):
                $validateFilter = [
                    'post_title'=> FILTER_SANITIZE_ENCODED,
                    'content' => FILTER_VALIDATE_INT,
                    'status' => FILTER_VALIDATE_BOOLEAN,
                    'user_id' => FILTER_VALIDATE_INT,
                    'user_role' => FILTER_VALIDATE_INT
                ];
                $this->admin->addNewPost(filter_input_array(INPUT_POST, $validateFilter));
                break;
            case $route->match('/updatepost'):
                $this->admin->updatePost(filter_input_array(INPUT_POST));
                break;
            case $route->match('/register'):
                $this->front->registerNewUser(filter_input_array(INPUT_POST));
                break;
            case $route->match('/login'):
                $this->front->login(filter_input_array(INPUT_POST));
                break;
            case $route->match('/usernameexist'):
                $this->front->userNameIsUniq(filter_input_array(INPUT_POST));
                break;
            case $route->match('/logout'):
                $this->session->destroy();
                break;
            default:
                header("HTTP/1.0 404 Not Found");
        }
    }
}
