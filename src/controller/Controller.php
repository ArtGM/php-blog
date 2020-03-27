<?php

namespace Blog\src\controller;
use Blog\src\config\DatabaseFactory;
use Twig\Extension\DebugExtension;

abstract class Controller
{
    protected $db;
    protected $post;
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $db = new DatabaseFactory();
        $this->db = $db->dbConnect();
        $this->twig = $this->twig();
        $this->twig->addExtension(new DebugExtension());
    }
    public function twig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../public/templates/');
        return new \Twig\Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
            'debug' => true,
        ]);
    }
}
