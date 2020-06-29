<?php


namespace Blog\src\validate;

class Validation
{
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
        }
    }
}
