<?php

namespace Blog\src\controller;

use Blog\src\config\Session;
use Blog\src\manager\CommentManager;
use Blog\src\manager\PostManager;
use Blog\src\manager\UserManager;
use Blog\src\validate\Validation;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Class Controller
 * @package Blog\src\controller
 */
abstract class Controller
{
    protected $loader;
    protected $post;
    protected $twig;
    protected $comment;
    protected $user;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $this->user = new UserManager();
        $this->twig = $this->twig();
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->session = Session::getInstance();
        $this->twig->addGlobal('session', $this->session);
        $this->validation = new Validation();
    }

    /**
     * @return Environment
     */
    public function twig()
    {
        $loader = new FilesystemLoader('../templates/');
        return new Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
            'debug' => true,
        ]);
    }

    /**
     * @param $template
     * @param array $data
     */
    public function render($template, array $data = [])
    {
        try {
            echo $this->twig->render($template, $data);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function emailIsUniq($email)
    {
        return $this->user->checkEmail($email);
    }

    /**
     * @param $username
     * @return bool
     */
    public function userNameIsUniq($username)
    {
        return !$this->user->checkUserName($username);
    }
}
