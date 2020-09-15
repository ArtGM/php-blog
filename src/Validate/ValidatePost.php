<?php

namespace Blog\Validate;

/**
 * Class ValidatePost
 * @package Blog\src\Validate
 */
class ValidatePost extends Validation
{
    /**
     * @param $name
     * @param $value
     */
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

    /**
     * @param $name
     * @param $value
     * @return string
     */
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
        return null;
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
