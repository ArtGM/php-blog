<?php
namespace Blog\src\controller;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if ($this->session->getSession('role') !== '1') {
            header('Location:../');
        }
        return true;
    }


    public function runDashboard()
    {
        if ($this->checkAdmin()) {
            $this->render('dashboard.html.twig');
        }
    }

    public function listAllPosts()
    {
        if ($this->checkAdmin()) {
            $list_posts = $this->post->getPosts(null, true);
            $this->render('manage_posts.html.twig', ['list_posts' => $list_posts]);
        }
    }

    public function displayPostForm()
    {
        if ($this->checkAdmin()) {
            $this->render('post_form.html.twig');
        }
    }

    public function modifyPost($post_id)
    {
        if ($this->checkAdmin()) {
            $post_data = $this->post->getPosts($post_id, true);
            $this->render('post_form.html.twig', ['post' => $post_data]);
        }
    }

    public function listAllComments()
    {
        if ($this->checkAdmin()) {
            $list_comments = $this->comment->getAllComments();
            $this->render('manage_comments.html.twig', ['list_comments' => $list_comments]);
        }
    }

    public function addNewPost($newPost)
    {
        if ($this->checkAdmin()) {
            if (!empty($newPost)) {
                $this->post->insertNewPost($newPost);
            }
        }
    }

    public function updatePost($update)
    {
        if ($this->checkAdmin()) {
            if (!empty($update)) {
                $this->post->updatePost($update);
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
            $this->render('userlist.html.twig', ['users' => $userList]);
        }
    }
}
