<?php


namespace Blog\src\validate;

class Validation
{
    protected $constraint;
    protected $errors = [];

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    protected function check($user)
    {
        foreach ($user as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    protected function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    public function validate($data, $name)
    {
        if ($name === 'post') {
            $articleValidation = new ValidatePost();
            return $articleValidation->check($data);
        } elseif ($name === 'register') {
            $registerValidation = new ValidateRegister();
            return $registerValidation->check($data);
        } elseif ($name === 'login') {
            $loginValidation = new ValidateLogin();
            return $loginValidation->check($data);
        } elseif ($name === 'comment') {
            $loginValidation = new ValidateComment();
            return $loginValidation->check($data);
        }
    }
}
