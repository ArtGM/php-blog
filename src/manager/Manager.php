<?php

namespace Blog\src\manager;

use Blog\src\config\DatabaseFactory;
use PDO;

/**
 * Class Manager
 * @package Blog\src\manager
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
