<?php

namespace Blog\Validate;

/**
 * Class ValidateRegister
 * @package Blog\src\Validate
 */
class ValidateRegister extends Validation
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
        } elseif ($name === 'password') {
            $error = $this->checkPass($name, $value);
            $this->addError($name, $error);
        }
    }

}
