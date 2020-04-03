<?php


namespace Blog\src\controller;

use PDO;

class UserController extends Controller
{
    public function getUserById($id)
    {
        $fetch_user = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $fetch_user->execute($id);
        return $fetch_user->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\User');
    }
}
