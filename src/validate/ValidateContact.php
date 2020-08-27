<?php

namespace Blog\src\validate;

class ValidateContact extends Validation
{
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

    private function checkUsername($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('nom d\'utilisateur', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('nom d\'utilisateur', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('nom d\'utilisateur', $value, 255);
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

    private function checkContent($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('message', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('message', $value, 2);
        }
    }
}
