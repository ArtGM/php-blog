<?php

namespace Blog\Controller;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class FrontController
 * @package Blog\src\Controller
 */
class FrontController extends Controller
{
    public function homePage()
    {
        $this->render('/front/index.html.twig');
    }

    public function blogPage()
    {
        $posts = $this->post->getPosts();
        $this->render('/front/blog.html.twig', ['posts' => $posts]);
    }

    /**
     * @param array $newComment
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addComment(array $newComment)
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
        $get_the_id = $single[0]->getId();
        if (is_null($get_the_id)) { // return error 404 if post don't exist
            header("HTTP/1.0 404 Not Found");
            echo $this->twig->render('404.html.twig');
        }

        $user = $this->user->getUserById($get_the_id);
        $author[] = $user->getUsername();
        $comments = $this->comment->getComment($post_id);
        $userConnected = [
            'id' => $this->session->getSession('id'),
            'username' => $this->session->getSession('username'),
            'role' => $this->session->getSession('role'),
            'connected' => $this->session->getSession('connected')
        ];
        $this->render('/front/single.html.twig', ['post' => $single[0], 'author' => $author, 'comments' => $comments, 'user' => $userConnected, 'errors' => $errors]);
    }

    /**
     * @param $newUser
     */
    public function registerNewUser($newUser)
    {
        $errors = $this->validation->validate($newUser, 'register');
        if (!$errors) {
            var_dump($newUser);
            if ($this->emailIsUniq($newUser['user_email'])) {
                $email = ['exist' => 'cet email est déjà pris.'];
                $this->render('/front/register.html.twig', ['email' => $email]);
            } elseif ($this->userNameIsUniq($newUser['username'])) {
                $pseudo = ['exist' => 'ce pseudo est déjà pris.'];
                $this->render('/front/register.html.twig', ['pseudo' => $pseudo]);
            } else {
                $newUser['password'] = $this->hashPassword($newUser['password']);
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
     * @param $loginInfo array
     */
    public function login(array $loginInfo)
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

    /**
     * @param $contactInfo
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function contactForm($contactInfo)
    {
        $errors = $this->validation->validate($contactInfo, 'contact');
        if (!$errors) {
            $admin_info = $this->user->getAdmin();
            $message = $this->createEmailMessage($contactInfo, $admin_info);
            $success = $this->setMailConfig()->send($message);

            if ($success) {
                $this->session->setSession('confirm', 'Message envoyé');
                header('Location:/');
            } else {
                $this->session->setSession('error', 'erreur lors de l\'envoi du message');
            }
        } else {
            $this->session->setSession('error', 'veuillez remplir tout les champs');
            header('Location:/');
        }
    }

    /**
     * @param $from
     * @param $to
     * @return Swift_Message
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function createEmailMessage($from, $to)
    {
        $message = new Swift_Message('Contact via Blog');

        $toMail = $to->getEmail();
        $toName = $to->getUsername();

        return $message->setFrom([
            $from['email'] => $from['name'],
        ])->setTo([
            $toMail => $toName
        ])->setBody(
            $this->twig->render('/front/email.html.twig', ['message' => $from]),
            'text/html'
        );
    }

    /**
     * @return Swift_Mailer
     */
    private function setMailConfig()
    {
        $transport = new Swift_SmtpTransport(MAIL_HOST, SMTP_PORT, 'ssl');
        $transport->setUsername(AUTH);
        $transport->setPassword(PASS);

        return new Swift_Mailer($transport);
    }

    public function notFound()
    {
        $this->render('404.html.twig');
    }
}
