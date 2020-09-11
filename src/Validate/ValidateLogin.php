<?php


namespace Blog\Validate;

/**
 * Class ValidateLogin
 * @package Blog\src\Validate
 */
class ValidateLogin extends Validation
{
    /**
     * @param $name
     * @param $value
     */
    protected function checkField($name, $value)
    {
        if ($name === 'username') {
            $error = $this->checkUsername($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'password') {
            $error = $this->checkPassword($name, $value);
            $this->addError($name, $error);
        }
    }


    /**
     * @param $name
     * @param $value
     * @return string
     */
    private function checkPassword($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('mot de passe', $value);
        }
        if ($this->constraint->minLength($name, $value, 8)) {
            return $this->constraint->minLength('mot de passe', $value, 8);
        }
        return null;
    }
}
