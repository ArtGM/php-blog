<?php

namespace Blog\src\controller;

use Blog\src\config\DatabaseFactory;

abstract class Controller
{
    protected $database;

    public function __construct()
    {
        $database = new DatabaseFactory();
        return $this;
    }
}
