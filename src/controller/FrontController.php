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

        if (is_null($single[0]->getId())) { // return error 404 if post don't exist
            header("HTTP/1.0 404 Not Found");
            echo $this->twig->render('404.html.twig');
        }
        echo $this->twig->render('single.html.twig', ['post' => $single[0], 'comments' => $comments]);
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
        if (!empty(array_filter($newUser))) {
            if (!$this->emailIsUniq($newUser['user-email'])) {
                echo '<div class="alert alert-danger" role="alert">cet email est déjà pris</div>';
                return;
            } elseif (!$this->userNameIsUniq($newUser['username'])) {
                echo '<div class="alert alert-danger" role="alert">le pseudo existe déjà</div>';
                return;
            }
            $password = $newUser['password'];
            $hashPass = password_hash($password, PASSWORD_DEFAULT);
            $newUser['password'] = $hashPass;
            $this->user->createNewUser($newUser);
            echo '<div class="alert alert-success" role="alert">Compte créé !</div>';
            return;
        }
        echo '<div class="alert alert-warning" role="alert">Merci de remplir tout les champs</div>';
        return;
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

    public function login($loginInfo)
    {
        if (!empty(array_filter($loginInfo))) {
            $result = $this->user->login($loginInfo['login-username'], $loginInfo['login-password']);
            if ($result['usernameExist'] && $result['isPasswordValid']) {
                $this->session->setSession('id', $result['id']);
                $this->session->setSession('username', $loginInfo['login-username']);
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
}
