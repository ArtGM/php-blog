<?php

namespace Blog\src\controller;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Blog\src\manager\PostManager;
use Blog\src\manager\CommentManager;
use Blog\src\manager\UserManager;
use Twig\Loader\FilesystemLoader;


abstract class Controller
{
    protected $loader;
    protected $post;
    protected $twig;
    protected $comment;
    protected $user;

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $this->user = new UserManager();
        $this->twig = $this->twig();
        $this->twig->addExtension(new DebugExtension());
    }
    public function twig()
    {
        $loader = new FilesystemLoader('../public/templates/');
        return new Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
            'debug' => true,
        ]);
    }
}
