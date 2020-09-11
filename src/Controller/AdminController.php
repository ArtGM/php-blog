<?php
namespace Blog\Controller;

/**
 * Class AdminController
 * @package Blog\src\Controller
 */
class AdminController extends Controller
{
    /**
     * @return bool
     */
    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if ($this->session->getSession('role') !== '1') {
            header('Location:../');
        }
        return true;
    }

    /**
     * @return bool
     */
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
            var_dump($_SESSION);
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

    /**
     * @param $post_id
     */
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


    /**
     * @param $post
     */
    public function addOrUpdatePost($post)
    {
        if ($this->checkAdmin()) {
            $errors = $this->validation->validate($post, 'post');
            if (!$errors) {
                if (empty($post['id'])) {
                    $this->post->insertNewPost($post);
                    $this->session->setSession('confirm', 'Le nouvel article a bien été ajouté');
                } else {
                    $this->post->updatePost($post);
                    $this->session->setSession('confirm', 'l\'article à été mis à jour.');
                }
                $this->session->setSession('history', $_SERVER['HTTP_REFERER']);
                header('Location:/');
            } else {
                $this->render('/admin/post_form.html.twig', ['post' => $post, 'errors' => $errors]);
            }
        }
    }

    /**
     * @param $post_id
     */
    public function deletePost($post_id)
    {
        if ($this->checkAdmin()) {
            $this->post->deletePost($post_id);
            header("location:/admin/gestion-articles");
        }
    }

    /**
     * @param string $comment_id
     */
    public function deleteComment(string $comment_id)
    {
        if ($this->checkAdmin()) {
            $this->comment->deleteComment($comment_id);
            header("location:/admin/gestion-commentaires");
        }
    }

    /**
     * @param string $comment_id
     */
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

    /**
     * @param $user_id
     * @param string $path_info
     */
    public function showAndEditUserProfile($user_id, string $path_info)
    {
        if ($this->session->getSession('connected')) {
            if ($this->session->getSession('role') === '1') {
                $user_data = $this->user->getUserById($user_id);
            } else {
                $user_data = $this->user->getUserById($this->session->getSession('id'));
            }
            if (strstr($path_info, 'edit')) {
                $this->render('/admin/edit_profile.html.twig', ['user' => $user_data]);
            } elseif (strstr($path_info, 'password')) {
                $this->render('/admin/password.html.twig', ['user' => $user_data]);
            } else {
                $this->render('/admin/profile.html.twig', ['user' => $user_data]);
            }
        }
    }

    /**
     * @param $update
     */
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

    /**
     * @param $update
     */
    public function updatePassword($update)
    {
        if ($this->session->getSession('connected')) {
            $errors = $this->validation->validate($update, 'password');
            if (!$errors) {
                $update['password'] = $this->hashPassword($update['password']);
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
