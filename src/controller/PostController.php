<?php


namespace Blog\src\controller;
use Blog\src\config\DatabaseFactory;
use PDO;
use Blog\src\model\Post;

class PostController
{
    public function getPosts()
    {
        $db = new DatabaseFactory();
        $fetch_posts = $db->dbConnect()->prepare('SELECT * FROM post');
        $fetch_posts->execute();
        $posts = $fetch_posts->fetchAll(PDO::FETCH_ASSOC);
        foreach ($posts as $post) {
            $instance = new Post($post);
            echo '<h2>' . $instance->getTitle() . '</h2>';
            echo '<time>'. $instance->getCreatedAt() .'</time>';
            echo '<p>' . $instance->getContent() .'</p>';
        }
    }
}
