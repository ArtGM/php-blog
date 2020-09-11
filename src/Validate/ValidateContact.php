<?php

namespace Blog\Validate;

/**
 * Class ValidateContact
 * @package Blog\src\Validate
 */
class ValidateContact extends Validation
{
    /**
     * @param $name
     * @param $value
     */
    protected function checkField($name, $value)
    {
        if ($name === 'name') {
            $error = $this->checkUsername($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'email') {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'message') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
    }


    /**
     * @param $name
     * @param $value
     * @return string
     */
    private function checkContent($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('message', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('message', $value, 2);
        }
        return null;
    }
}
