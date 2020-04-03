<?php


namespace Blog\src\controller;

use PDO;

class PostController extends Controller
{
    /**
     * @param null $id
     * @return array
     */
    public function getPosts($id = null)
    {
        if (is_null($id)) {
            $fetch_posts = $this->db->prepare('SELECT * FROM post');
        } else {
            $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = '".$id."'");
        }
        $fetch_posts->execute();
        return $fetch_posts->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\Post');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayPosts()
    {
        $posts = $this->getPosts();
        echo $this->twig->render('blog.html.twig', ['posts' => $posts]);
    }

    /**
     * @param $id
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displaySinglePost($id)
    {
        $single = $this->getPosts($id);
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
    }
}
