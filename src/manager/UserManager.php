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

    public function createNewUser($newUser)
    {
        $insert = $this->db->prepare("INSERT INTO user (username, email, password, roles_id) VALUES (?, ?, ?, 2)");
        $insert->execute(array_values($newUser));
    }

    public function checkUserName($username)
    {
        $fetch_user = $this->db->prepare("SELECT COUNT(username) FROM user WHERE username = ?");
        $fetch_user->execute(array_values([$username]));
        $uniqUserName = $fetch_user->fetchColumn();
        return ($uniqUserName > 0 ? false : true);
    }

    public function checkEmail($email)
    {
        $fetch_mail = $this->db->prepare("SELECT COUNT(email) FROM user WHERE email = ?");
        $fetch_mail->execute(array_values([$email]));
        $uniqEmail = $fetch_mail->fetchColumn();
        return ($uniqEmail > 0 ? false : true);
    }
}
