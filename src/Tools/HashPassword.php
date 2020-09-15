<?php


namespace Blog\Tools;

/**
 * Class HashPassword
 * @package Blog\Tools
 */
class HashPassword
{
    /**
     * @param $password
     * @return false|string|null
     */
    public function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
