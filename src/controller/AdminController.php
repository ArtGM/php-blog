<?php
namespace Blog\src\controller;

class AdminController extends Controller
{
    public function runDashboard()
    {
        $this->render('dashboard.html.twig');
    }

    public function listAllPost()
    {
        $list_posts = $this->post->getPosts(null, true);
        $this->render('manage_post.html.twig', ['list_posts' => $list_posts]);
    }

    public function displayPostForm()
    {
        $this->render('post_form.html.twig');
    }

    public function modifyPost($id)
    {
        $post_data = $this->post->getPosts($id, true);
        $this->render('post_form.html.twig', ['post' => $post_data]);
    }
}
