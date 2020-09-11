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
    protected $comment;
    protected $contact;
    protected $login;
    protected $pass;
    protected $post;
    protected $register;
    protected $user;

    public function __construct()
    {
        $this->constraint = new Constraint();
        $this->contact = new ValidateContact();
        $this->login = new ValidateLogin();
        $this->comment = new ValidateComment();
        $this->pass = new ValidatePass();
        $this->post = new ValidatePost();
        $this->register = new ValidateRegister();
        $this->user = new ValidateUser();
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
                $validate = $this->post->check($data);
                break;
            case 'register':
                $validate = $this->register->check($data);
                break;
            case 'login':
                $validate = $this->login->check($data);
                break;
            case 'comment':
                $validate = $this->comment->check($data);
                break;
            case 'update':
                $validate = $this->user->check($data);
                break;
            case 'password':
                $validate = $this->pass->check($data);
                break;
            case 'contact':
                $validate = $this->contact->check($data);
                break;
        }
        return $validate;
    }

}
