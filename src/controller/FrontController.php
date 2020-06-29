<?php

namespace Blog\src\controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontController extends Controller
{
    public function homePage()
    {


        try {
            echo $this->twig->render('base.html.twig');
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    /**
     * Display all posts
     * Display all posts
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displayPosts()
    {
        $posts = $this->post->getPosts();
        echo $this->twig->render('blog.html.twig', ['posts' => $posts]);
    }

    /**
     * Display a single post by id
     * @param $post_id
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displaySinglePost($post_id)
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
        echo $this->twig->render('single.html.twig', ['post' => $single[0], 'comments' => $comments, 'user' => $userConnected]);
    }

    /**
     * @param array $newComment
     */
    public function addComment($newComment)
    {
        if (!empty($newComment)) {
            $this->comment->insertNewComment($newComment);
        }
    }

    /**
     * @param $newUser
     */
    public function registerNewUser($newUser)
    {
        $errors = $this->validation->validate($newUser, 'register');
        var_dump($newUser);
        if (!$errors) {
            if (!$this->emailIsUniq($newUser['user_email'])) {
                $email = ['exist' => 'cet email est déjà pris.'];
                $this->render('register.html.twig', ['email' => $email]);
            } elseif (!$this->userNameIsUniq($newUser['username'])) {
                $pseudo = ['exist' => 'ce pseudo est déjà pris.'];
                $this->render('register.html.twig', ['pseudo' => $pseudo]);
            } else {
                $password = $newUser['password'];
                $hashPass = password_hash($password, PASSWORD_DEFAULT);
                $newUser['password'] = $hashPass;
                $this->user->createNewUser($newUser);
                $this->session->setSession('confirm', 'Compte Créé !');
                $this->render('confirm.html.twig');
            }
        } else {
            $this->render('register.html.twig', ['user' => $newUser, 'errors' => $errors]);
        }

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
     * @param $email
     * @return bool
     */
    public function emailIsUniq($email)
    {
        return $this->user->checkEmail($email);
    }

    /**
     * @param $loginInfo array
     */
    public function login($loginInfo)
    {
        if (!empty(array_filter($loginInfo))) {
            $result = $this->user->login($loginInfo['login-username'], $loginInfo['login-password']);
            if ($result['usernameExist'] && $result['isPasswordValid']) {

                $user = $this->user->getUserByName($loginInfo['login-username']);

                $this->session->setSession('id', $user->getId());
                $this->session->setSession('username', $user->getUsername());
                $this->session->setSession('role', $user->getRoleId());
                $this->session->setSession('connected', true);
                echo "<div class=\"alert alert-success\">Heureux de vous revoir " . $loginInfo['login-username'] . " !</div>";
                return;
            }
            echo "<div class=\"alert alert-danger\"> Erreur de connexion !</div>";
            return;
        }
        echo "<div class=\"alert alert-warning\">Veuillez remplir tout les champs.</div>";
        return;
    }

    public function displayRegisterForm()
    {
        $this->render('register.html.twig');
    }
}
