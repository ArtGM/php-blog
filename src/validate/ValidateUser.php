<?php

namespace Blog\src\validate;

class ValidateUser extends Validation
{
    protected function checkField($name, $value)
    {
        if ($name === 'username') {
            $error = $this->checkName($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'user_email') {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        }
    }

    private function checkName($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Nom d\'utilisateur', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Nom d\'utilisateur', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('Nom d\'utilisateur', $value, 255);
        }
    }


    private function checkEmail($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Email', $value);
        }
        if ($this->constraint->isEmail($name, $value)) {
            return $this->constraint->isEmail('Email', $value);
        }
    }

}

