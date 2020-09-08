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
        $validate = null;
        switch ($name) {
            case 'post':
                $articleValidation = new ValidatePost();
                $validate = $articleValidation->check($data);
                break;
            case 'register':
                $registerValidation = new ValidateRegister();
                $validate = $registerValidation->check($data);
                break;
            case 'login':
                $loginValidation = new ValidateLogin();
                $validate = $loginValidation->check($data);
                break;
            case 'comment':
                $loginValidation = new ValidateComment();
                $validate = $loginValidation->check($data);
                break;
            case 'update':
                $loginValidation = new ValidateUser();
                $validate = $loginValidation->check($data);
                break;
            case 'password':
                $passValidation = new ValidatePass();
                $validate = $passValidation->check($data);
                break;
            case 'contact':
                $contactValidation = new ValidateContact();
                $validate = $contactValidation->check($data);
                break;
        }

        return $validate;
    }

}
