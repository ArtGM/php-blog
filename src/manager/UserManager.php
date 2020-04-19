<?php


namespace Blog\src\manager;
use Blog\src\model\User;

class UserManager extends Manager
{
    public function getUserById($id)
    {
        $fetch_user = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $fetch_user->execute([$id]);
        return new User($fetch_user->fetch($this->fetch_style));
    }
}