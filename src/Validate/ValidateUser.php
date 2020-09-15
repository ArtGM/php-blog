<?php

namespace Blog\Validate;

/**
 * Class ValidateUser
 * @package Blog\Validate
 */
class ValidateUser extends Validation
{
    /**
     * @param $name
     * @param $value
     */
    protected function checkField($name, $value)
    {
        if ($name === 'username') {
            $error = $this->checkUserName($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'user_email') {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        }
    }

}
