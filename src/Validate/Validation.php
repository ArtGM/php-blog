<?php


namespace Blog\Validate;

/**
 * Class Validation
 * @package Blog\src\Validate
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
     * @param $value
     * @return string
     */
    protected function checkUserName($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Nom d\'utilisateur', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Nom d\'utilisateur', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('Nom d\'utilisateur', $value, 255);
        }
        return null;
    }

    /**
     * @param string $name
     * @param $value
     * @return string
     */
    protected function checkPass(string $name, $value)
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
        return null;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function checkEmail($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Email', $value);
        }
        if ($this->constraint->isEmail($name, $value)) {
            return $this->constraint->isEmail('Email', $value);
        }
        return null;
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
