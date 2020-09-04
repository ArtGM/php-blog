<?php


namespace Blog\src\validate;

/**
 * Class Validation
 * @package Blog\src\validate
 */
class Validation
{
    protected $constraint;
    protected $errors = [];

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    /**
     * @param $user
     * @return array
     */
    protected function check($user)
    {
        foreach ($user as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    /**
     * @param $name
     * @param $error
     */
    protected function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    /**
     * @param $data
     * @param $name
     * @return array
     */
    public function validate($data, $name)
    {
        if ($name === 'post') {
            $articleValidation = new ValidatePost();
            $validate = $articleValidation->check($data);
        } elseif ($name === 'register') {
            $registerValidation = new ValidateRegister();
            $validate = $registerValidation->check($data);
        } elseif ($name === 'login') {
            $loginValidation = new ValidateLogin();
            $validate = $loginValidation->check($data);
        } elseif ($name === 'comment') {
            $loginValidation = new ValidateComment();
            $validate = $loginValidation->check($data);
        } elseif ($name === 'update') {
            $loginValidation = new ValidateUser();
            $validate = $loginValidation->check($data);
        } elseif ($name === 'password') {
            $passValidation = new ValidatePass();
            $validate = $passValidation->check($data);
        } elseif ($name === 'contact') {
            $contactValidation = new ValidateContact();
            $validate = $contactValidation->check($data);
        }
        return $validate;
    }
}
