<?php

namespace Blog\src\validate;

class ValidatePass extends Validation
{
    protected function checkField($name, $value)
    {
        if ($name === 'password') {
            $error = $this->checkPass($name, $value);
            $this->addError($name, $error);
        }
    }

    private function checkPass(string $name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Mot de Passe', $value);
        }
        if ($this->constraint->minLength($name, $value, 8)) {
            return $this->constraint->minLength('Mot de Passe', $value, 8);
        }
        if ($this->constraint->maxLength($name, $value, 16)) {
            return $this->constraint->minLength('Mot de Passe', $value, 16);
        }
    }

}

