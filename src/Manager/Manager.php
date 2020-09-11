<?php

namespace Blog\Manager;

use Blog\Config\DatabaseFactory;
use PDO;

/**
 * Class Manager
 * @package Blog\src\Manager
 */
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
