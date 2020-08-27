<?php
namespace Blog\src\controller;


class AdminController extends Controller
{
    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if ($this->session->getSession('role') !== '1') {
            header('Location:../');
        }
        return true;
    }

    private function checkLoggedIn()
    {
        if ($this->session->getSession('connected')) {
            return true;
        }
        header('location:../');
    }

    public function runDashboard()
    {

        if ($this->checkAdmin()) {
            $this->render('admin/dashboard.html.twig');
        }
    }

    public function listAllPosts()
    {
        if ($this->checkAdmin()) {
            $list_posts = $this->post->getPosts(null, true);
            $this->render('admin/manage_posts.html.twig', ['list_posts' => $list_posts]);
        }
    }

    public function displayPostForm()
    {
        if ($this->checkAdmin()) {
            $this->render('admin/post_form.html.twig');
        }
    }

    public function modifyPost($post_id)
    {
        if ($this->checkAdmin()) {
            $post_data = $this->post->getPosts($post_id, true);
            $this->render('admin/post_form.html.twig', ['post' => $post_data]);
        }
    }

    public function listAllComments()
    {
        if ($this->checkAdmin()) {
            $list_comments = $this->comment->getAllComments();
            $this->render('admin/manage_comments.html.twig', ['list_comments' => $list_comments]);
        }
    }

    public function addNewPost($newPost)
    {
        if ($this->checkAdmin()) {
            $errors = $this->validation->validate($newPost, 'post');
            if (!$errors) {
                $this->post->insertNewPost($newPost);
                $this->session->setSession('confirm', 'Le nouvel article a bien été ajouté');
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:../');
            } else {
                $this->render('/admin/post_form.html.twig', ['post' => $newPost, 'errors' => $errors]);
            }
        }
    }

    public function updatePost($update)
    {
        if ($this->checkAdmin()) {
            $errors = $this->validation->validate($update, 'post');
            if (!$errors) {
                $this->post->updatePost($update);
                $this->session->setSession('confirm', 'l\'article à été mis à jour.');
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:../');
            } else {
                $this->render('/admin/post_form.html.twig', ['post' => $update, 'errors' => $errors]);
            }
        }
    }

    public function deletePost($post_id)
    {
        if ($this->checkAdmin()) {
            $this->post->deletePost($post_id);
            header("location:/admin/gestion-articles");
        }
    }

    public function deleteComment(string $comment_id)
    {
        if ($this->checkAdmin()) {
            $this->comment->deleteComment($comment_id);
            header("location:/admin/gestion-commentaires");
        }
    }

    public function approveComment(string $comment_id)
    {
        if ($this->checkAdmin()) {
            $this->comment->changeCommentStatus($comment_id);
            header("location:/admin/gestion-commentaires");
        }
    }

    public function displayUsersList()
    {
        if ($this->checkAdmin()) {
            $userList = $this->user->getAllUsers();
            $this->render('/admin/userlist.html.twig', ['users' => $userList]);
        }
    }

    public function showUserProfile($user_id)
    {
        if ($this->session->getSession('connected')) {
            if ($this->session->getSession('role') === '1') {
                $user_data = $this->user->getUserById($user_id);
            } else {
                $user_data = $this->user->getUserById($this->session->getSession('id'));
            }
            $this->render('/admin/profile.html.twig', ['user' => $user_data]);
        }
    }

    public function editUserProfile($user_id)
    {
        if ($this->session->getSession('connected')) {
            if ($this->session->getSession('role') === '1') {
                $user_data = $this->user->getUserById($user_id);
            } else {
                $user_data = $this->user->getUserById($this->session->getSession('id'));
            }
            $this->render('/admin/edit_profile.html.twig', ['user' => $user_data]);
        }
    }

    public function editUserPassword($user_id)
    {
        if ($this->session->getSession('connected')) {
            if ($this->session->getSession('role') === '1') {
                $user_data = $this->user->getUserById($user_id);
            } else {
                $user_data = $this->user->getUserById($this->session->getSession('id'));
            }
            $this->render('/admin/password.html.twig', ['user' => $user_data]);
        }
    }

    public function updateUser($update)
    {
        if ($this->session->getSession('connected')) {
            $errors = $this->validation->validate($update, 'update');
            if (!$errors) {
                $this->user->updateUser($update);
                $this->session->setSession('username', $update['username']);
                $this->session->setSession('confirm', 'Vos informations ont été mis à jour.');
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:../');
            } else {
                var_dump($update);
                $this->render('/admin/edit_profile.html.twig', ['user' => $update, 'errors' => $errors]);
            }
        }
    }

    public function updatePassword($update)
    {
        if ($this->session->getSession('connected')) {
            $errors = $this->validation->validate($update, 'password');
            if (!$errors) {
                $password = $update['password'];
                $hashPass = password_hash($password, PASSWORD_DEFAULT);
                $update['password'] = $hashPass;
                $this->user->updatePassword($update);
                $this->session->setSession('confirm', 'Votre mot de passe a été mis à jour.');
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:../');
            } else {

                $this->render('/admin/password.html.twig', ['errors' => $errors]);
            }
        }
    }
}
