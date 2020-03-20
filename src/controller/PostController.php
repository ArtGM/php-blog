<?php


namespace Blog\src\controller;

use Blog\src\model\Post;
use PDO;

class PostController extends Controller
{
    public function getPosts()
    {
        $fetch_posts = $this->db->prepare('SELECT * FROM post');
        $fetch_posts->execute();
        return $fetch_posts->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayPosts()
    {
        foreach ($this->getPosts() as $post) {
            $instance = new Post($post);
            echo '<h2>' . $instance->getTitle() . '</h2>';
            echo '<time>'. $instance->getCreatedAt() .'</time>';
            echo '<p>' . $instance->getContent() .'</p>';
        }
    }
}
