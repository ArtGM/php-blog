<?php
namespace Blog\src\controller;

class AdminController extends Controller
{
    public function runDashboard()
    {
        $this->render('dashboard.html.twig');
    }

    public function listAllPosts()
    {
        $list_posts = $this->post->getPosts(null, true);
        $this->render('manage_posts.html.twig', ['list_posts' => $list_posts]);
    }

    public function displayPostForm()
    {
        $this->render('post_form.html.twig');
    }

    public function modifyPost($post_id)
    {
        $post_data = $this->post->getPosts($post_id, true);
        $this->render('post_form.html.twig', ['post' => $post_data]);
    }

    public function listAllComments()
    {
        $list_comments = $this->comment->getAllComments();
        $this->render('manage_comments.html.twig', ['list_comments' => $list_comments]);
    }
}
