<?php


namespace Blog\src\controller;

use PDO;

class PostController extends Controller
{
    public function getPosts($id = null)
    {
        if (is_null($id)) {
            $fetch_posts = $this->db->prepare('SELECT * FROM post');
        } else {
            $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = '".$id."'");
        }
        var_dump($fetch_posts);
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
        $single = $this->getPosts($id);
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
    }
}
