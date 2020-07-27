<?php

namespace Blog\src\controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontController extends Controller
{
    public function homePage()
    {
        $posts = $this->post->getPosts();
        $this->render('/front/index.html.twig', ['posts' => $posts]);
    }

    /**
     * @param array $newComment
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addComment($newComment)
    {
        $errors = $this->validation->validate($newComment, 'comment');
        if (!$errors) {
            $this->comment->insertNewComment($newComment);
            $this->session->setSession('confirm', 'Commentaire enregistré, en attente de validation!');
            $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
            header('Location:../');
        } else {
            $post_id = $newComment['post_id'];
            $this->displaySinglePost($post_id, $errors);
        }
    }

    /**
     * Display a single post by id
     * @param $post_id
     * @param array $errors
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displaySinglePost($post_id, $errors = [])
    {
        $single[] = $this->post->getPosts($post_id);
        $comments = $this->comment->getComment($post_id);
        $userConnected = [
            'id' => $this->session->getSession('id'),
            'username' => $this->session->getSession('username'),
            'role' => $this->session->getSession('role'),
            'connected' => $this->session->getSession('connected')
        ];

        if (is_null($single[0]->getId())) { // return error 404 if post don't exist
            header("HTTP/1.0 404 Not Found");
            echo $this->twig->render('404.html.twig');
        }
        $this->render('/front/single.html.twig', ['post' => $single[0], 'comments' => $comments, 'user' => $userConnected, 'errors' => $errors]);
    }

    /**
     * @param $newUser
     */
    public function registerNewUser($newUser)
    {
        $errors = $this->validation->validate($newUser, 'register');
        if (!$errors) {
            if (!$this->emailIsUniq($newUser['user_email'])) {
                $email = ['exist' => 'cet email est déjà pris.'];
                $this->render('/front/register.html.twig', ['email' => $email]);
            } elseif (!$this->userNameIsUniq($newUser['username'])) {
                $pseudo = ['exist' => 'ce pseudo est déjà pris.'];
                $this->render('/front/register.html.twig', ['pseudo' => $pseudo]);
            } else {
                $password = $newUser['password'];
                $hashPass = password_hash($password, PASSWORD_DEFAULT);
                $newUser['password'] = $hashPass;
                $this->user->createNewUser($newUser);
                $this->session->setSession('confirm', 'Compte Créé !');
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:../');
            }
        } else {
            $this->render('/front/register.html.twig', ['user' => $newUser, 'errors' => $errors]);
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

    /**
     * @param $loginInfo array
     */
    public function login($loginInfo)
    {
        $errors = $this->validation->validate($loginInfo, 'login');
        if (!$errors) {
            $result = $this->user->login($loginInfo['username'], $loginInfo['password']);
            if ($result['usernameExist'] && $result['isPasswordValid']) {
                $user = $this->user->getUserByName($loginInfo['username']);

                $this->session->setSession('id', $user->getId());
                $this->session->setSession('username', $user->getUsername());
                $this->session->setSession('role', $user->getRoleId());
                $this->session->setSession('connected', true);
                $this->session->setSession('confirm', 'Bonjour ' . $this->session->getSession('username'));
                header('Location:/');
            } else {
                $this->session->setSession('error', 'Erreur de connexion');
                header('Location:/connexion');
            }
        } else {
            $this->render('/front/login.html.twig', ['user' => $loginInfo, 'errors' => $errors]);
        }
    }

    /**
     *
     */
    public function displayRegisterForm()
    {
        $this->render('/front/register.html.twig');
    }

    /**
     *
     */
    public function displayLoginForm()
    {
        $this->render('/front/login.html.twig');
    }
}
