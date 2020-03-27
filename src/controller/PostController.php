<?php


namespace Blog\src\controller;
use Blog\src\tools\Slug;
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

}
