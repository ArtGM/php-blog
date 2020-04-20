<?php

namespace Blog\src\manager;
use Blog\src\config\DatabaseFactory;
use PDO;

abstract class Manager
{
    protected $db;
    protected $fetch_style = PDO::FETCH_ASSOC;

    public function __construct()
    {
        $db = new DatabaseFactory();
        $this->db = $db->dbConnect();
    }
}
