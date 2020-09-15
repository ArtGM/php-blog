<?php


namespace Blog\Manager;

use Blog\Model\User;

/**
 * Class UserManager
 * @package Blog\src\Manager
 */
class UserManager extends Manager
{
    /**
     * @param $id
     * @return User
     */
    public function getUserById($id)
    {
        $fetch_user = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $fetch_user->execute([$id]);
        $get_row = $fetch_user->fetch($this->fetch_style);
        return new User($get_row);
    }

    /**
     * @return User
     */
    public function getAdmin()
    {
        $fetch_admin = $this->db->prepare("SELECT * FROM user WHERE roles_id = 1");
        $fetch_admin->execute();
        $get_row = $fetch_admin->fetch($this->fetch_style);
        return new User($get_row);
    }

    /**
     * @param $username
     * @return User
     */
    public function getUserByName($username)
    {
        $fetch_user = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $fetch_user->execute([$username]);
        $get_row = $fetch_user->fetch($this->fetch_style);
        return new User($get_row);
    }

    /**
     * @param $newUser
     */
    public function createNewUser($newUser)
    {
        $insert = $this->db->prepare("INSERT INTO user (username, email, password, roles_id) VALUES (?, ?, ?, 2)");
        $insert->execute(array_values($newUser));
    }

    /**
     * @param $username
     * @return bool
     */
    public function checkUserName($username)
    {
        $fetch_user = $this->db->prepare("SELECT COUNT(username) FROM user WHERE username = ?");
        $fetch_user->execute(array_values([$username]));
        $isExist = $fetch_user->fetchColumn();
        if ($isExist > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmail($email)
    {
        $fetch_mail = $this->db->prepare("SELECT COUNT(email) FROM user WHERE email = ?");
        $fetch_mail->execute(array_values([$email]));
        $uniqEmail = $fetch_mail->fetchColumn();
        var_dump($uniqEmail);
        return ($uniqEmail > 0 ? false : true);
    }

    /**
     * @param $username
     * @return mixed
     */
    private function checkPassword($username)
    {
        $fetch_password = $this->db->prepare("SELECT password FROM user WHERE username = ?");
        $fetch_password->execute([$username]);
        return $fetch_password->fetchColumn();
    }

    /**
     * @return array
     */
    public function getAllUsers()
    {
        $allUsersList = [];
        $fetch_user = $this->db->prepare("SELECT * FROM user");
        $fetch_user->execute();
        $allUsers = $fetch_user->fetchAll($this->fetch_style);
        foreach ($allUsers as $user) {
            $allUsersList[] = new User($user);
        }
        return $allUsersList;
    }

    /**
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username, $password)
    {
        $isPasswordValid = password_verify($password, $this->checkPassword($username));
        $usernameExist = $this->checkUserName($username);
        return [
            "usernameExist" => $usernameExist,
            "isPasswordValid" => $isPasswordValid
        ];
    }

    /**
     * @param $update
     */
    public function updateUser($update)
    {
        $insert = $this->db->prepare("UPDATE user SET username = ?, email = ? WHERE id = ?");
        $insert->execute(array_values($update));
    }

    /**
     * @param $update
     */
    public function updatePassword($update)
    {
        $insert = $this->db->prepare("UPDATE user SET password = ? WHERE id = ?");
        $insert->execute(array_values($update));
    }
}
