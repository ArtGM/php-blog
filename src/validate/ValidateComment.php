<?php


namespace Blog\src\validate;

/**
 * Class ValidateComment
 * @package Blog\src\validate
 */
class ValidateComment extends Validation
{
    /**
     * @param $name
     * @param $value
     */
    protected function checkField($name, $value)
    {
        if ($name === 'message') {
            $error = $this->checkMessage($name, $value);
            $this->addError($name, $error);
        }
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    private function checkMessage($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Message', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Message', $value, 2);
        }
    }
}
