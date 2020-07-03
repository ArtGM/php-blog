<?php


namespace Blog\src\model;

class User extends Model
{
    private $username;
    private $email;
    private $password;
    private $roleId;
    private $imageId;

    protected function hydrate($data)
    {
        parent::hydrate($data);
        $this->setUsername($data['username']);
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
        $this->setRoles_id($data['roles_id']);
        //$this->setImage_id($data['imageId']);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param mixed $roleId
     */
    public function setRoles_id($roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param mixed $imageId
     */
    public function setImage_id($imageId): void
    {
        $this->imageId = $imageId;
    }
}
