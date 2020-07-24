<?php

namespace Blog\src\validate;

use Blog\src\config\Parameter;

class ValidatePost extends Validation
{
    protected function checkField($name, $value)
    {
        if ($name === 'title') {
            $error = $this->checkTitle($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
    }

    private function checkTitle($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('titre', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('titre', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 45)) {
            return $this->constraint->maxLength('titre', $value, 255);
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
