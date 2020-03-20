<?php

namespace Blog\src\controller;

use Blog\src\config\DatabaseFactory;
use Blog\src\model\Post;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

abstract class Controller
{
    protected $db;
    protected $post;
    protected $loader;

    public function __construct()
    {
        $db = new DatabaseFactory();
        $this->db = $db->dbConnect();
        $this->post = new Post();
        $this->loader = new ArrayLoader();
    }

    function makeSlug($post) {
        $slug = new Slug();
    }

}
