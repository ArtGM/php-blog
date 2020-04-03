<?php


namespace Blog\src\controller;

use PDO;

class PostController extends Controller
{
    public function getPosts()
    {
        $fetch_posts = $this->db->prepare('SELECT * FROM post');
        $fetch_posts->execute();
        return $fetch_posts->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\Post');
    }

    public function displayPosts()
    {
        $posts = $this->getPosts();
        echo $this->twig->render('blog.html.twig', ['posts' => $posts]);
    }

    public function displaySinglePost($id)
    {
        $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = '".$id."'");
        $fetch_posts->execute();
        $single = $fetch_posts->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\Post');
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
    }
}
