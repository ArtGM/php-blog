<?php


namespace Blog\src\controller;

use Blog\src\model\Post;
use PDO;

class PostController extends Controller
{
    /**
     * @param null $id
     * @return Post
     */
    public function getPosts($id = null)
    {
        $empty_array = array(array());
        if (is_null($id)) {
            $fetch_posts = $this->db->query('SELECT * FROM post');
            $array_all_posts = $fetch_posts->fetchAll(PDO::FETCH_ASSOC);
            foreach ($array_all_posts as $post) {
                $new_post = new Post($post);
                $all_posts[] = $new_post;
            }
            return $all_posts;
        } else {
            $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = ?");
            $fetch_posts->execute([$id]);
            return new Post($fetch_posts->fetch(PDO::FETCH_ASSOC));
        }
        // return $fetch_posts->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\Post');
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
        $single[] = $this->getPosts($id);
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
    }
}
