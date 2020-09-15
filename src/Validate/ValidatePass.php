<?php

namespace Blog\Validate;

/**
 * Class ValidatePass
 * @package Blog\src\Validate
 */
class ValidatePass extends Validation
{
    /**
     * @param $name
     * @param $value
     */
    protected function checkField($name, $value)
    {
        if ($name === 'password') {
            $error = $this->checkPass($name, $value);
            $this->addError($name, $error);
        }
    }

}
