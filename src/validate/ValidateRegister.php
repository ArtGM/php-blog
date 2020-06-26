<?php

namespace Blog\src\validate;


class ValidateRegister extends Validation
{
    private $errors = [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check($user)
    {
        foreach ($user as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if ($name === 'username') {
            $error = $this->checkName($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'user-email') {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'password') {
            $error = $this->checkPass($name, $value);
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

    private function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
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

    private function checkPass(string $name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Email', $value);
        }
        if ($this->constraint->minLength($name, $value, 8)) {
            return $this->constraint->minLength('Mot de Passe', $value, 8);
        }
        if ($this->constraint->maxLength($name, $value, 16)) {
            return $this->constraint->minLength('Mot de Passe', $value, 16);
        }
    }

}
