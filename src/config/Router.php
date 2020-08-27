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
                $this->front->blogPage();
                break;
            case $route->match('/mail'):
                $this->front->contactForm(filter_input_array(INPUT_POST));
                break;
            case $route->match('/creer-compte'):
                $this->front->displayRegisterForm();
                break;
            case $route->match('/connexion'):
                $this->front->displayLoginForm();
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
            case $route->with('admin', 'admin')->with('delete', 'delete')->with('id', '^[0-9]+')->match('/admin/delete/:id'):
                $post_id = $route->getRouteIdParam();
                $this->admin->deletePost($post_id);
                break;
            case $route->with('admin', 'admin')->with('approvecomment', 'approvecomment')->with('id', '^[0-9]+')->match('/admin/approvecomment/:id'):
                $comment_id = $route->getRouteIdParam();
                $this->admin->approveComment($comment_id);
                break;
            case $route->with('admin', 'admin')->with('deletecomment', 'deletecomment')->with('id', '^[0-9]+')->match('/admin/deletecomment/:id'):
                $comment_id = $route->getRouteIdParam();
                $this->admin->deleteComment($comment_id);
                break;
            case $route->with('id', '^[0-9]+')->with('slug', '[a-z0-9-]+')->match('/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->front->displaySinglePost($post_id);
                break;
            case $route->with('admin', 'admin')->with('edit', 'edit')->with('id', '[0-9]+')->with('slug', '[a-z0-9-]+')->match('/admin/edit/:id-:slug'):
                $post_id = $route->getRouteIdParam();
                $this->admin->modifyPost($post_id);
                break;
            case $route->with('admin', 'admin')->with('profile', 'profile')->with('id', '[0-9]+')->with('name', '[a-z0-9-]+')->match('/admin/profile/:id-:name'):
                $user_id = $route->getRouteIdParam();
                $this->admin->showUserProfile($user_id);
                break;
            case $route->with('admin', 'admin')->with('profile', 'profile')->with('edit', 'edit')->with('id', '[0-9]+')->with('name', '[a-z0-9-]+')->match('/admin/profile/edit/:id-:name'):
                $user_id = $route->getRouteIdParam();
                $this->admin->editUserProfile($user_id);
                break;
            case $route->with('admin', 'admin')->with('profile', 'profile')->with('password', 'password')->with('id', '[0-9]+')->with('name', '[a-z0-9-]+')->match('/admin/profile/password/:id-:name'):
                $user_id = $route->getRouteIdParam();
                $this->admin->editUserPassword($user_id);
                break;
            case $route->match('/newcomment'):
                $this->front->addComment(filter_input_array(INPUT_POST));
                break;
            case $route->match('/newpost'):
                $this->admin->addNewPost(filter_input_array(INPUT_POST));
                break;
            case $route->match('/updatepost'):
                $this->admin->updatePost(filter_input_array(INPUT_POST));
                break;
            case $route->with('admin', 'admin')->with('profile', 'profile')->with('update', 'update')->match('/admin/profile/update'):
                $this->admin->updateUser(filter_input_array(INPUT_POST));
                break;
            case $route->with('admin', 'admin')->with('password', 'password')->with('update', 'update')->match('/admin/password/update'):
                $this->admin->updatePassword(filter_input_array(INPUT_POST));
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
                header("Location:" . $_SERVER['HTTP_REFERER']);
                break;
            default:
                header("HTTP/1.0 404 Not Found");
        }
    }
}
