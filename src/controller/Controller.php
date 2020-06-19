<?php

namespace Blog\src\controller;

use Blog\src\config\Session;
use Blog\src\manager\CommentManager;
use Blog\src\manager\PostManager;
use Blog\src\manager\UserManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected $loader;
    protected $post;
    protected $twig;
    protected $comment;
    protected $user;
    protected $session;

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $this->user = new UserManager();
        $this->twig = $this->twig();
        $this->twig->addExtension(new DebugExtension());
        $this->session = Session::getInstance();
        $this->twig->addGlobal('session', $this->session);
    }

    public function twig()
    {
        $loader = new FilesystemLoader('../templates/');
        return new Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
            'debug' => true,
        ]);
    }

    public function render($template, array $data = [])
    {
        echo $this->twig->render($template, $data);
    }
}
