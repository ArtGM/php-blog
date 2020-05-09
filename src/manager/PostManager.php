<?php

namespace Blog\src\manager;
use Blog\src\model\Post;

class PostManager extends Manager
{
    /**
     * @param null $id
     * @param bool $is_admin
     * @return array|Post|string
     */
    public function getPosts($id = null, $is_admin = false)
    {
        $query = $is_admin ? 'SELECT * FROM post' : 'SELECT * FROM post WHERE status = 1';

        if (is_null($id)) {
            $fetch_posts = $this->db->query($query);
            $array_all_posts = $fetch_posts->fetchAll($this->fetch_style);
            foreach ($array_all_posts as $post) {
                $new_post = new Post($post);
                $all_posts[] = $new_post;
            }
            if (!empty($all_posts)) {
                return $all_posts;
            } else {
                echo 'Aucun article';
            }
        } else {
            $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = ?");
            $fetch_posts->execute([$id]);
            return new Post($fetch_posts->fetch($this->fetch_style));
        }
    }

    public function insertNewPost($newPost)
    {
        $insert = $this->db->prepare("INSERT INTO post (title, content, status, created_at, updated_at, post_type, user_id, user_roles_id) VALUES (?, ?, ?, NOW(), NOW(), 1, ?, ?)");
        $insert->execute(array_values($newPost));

    }

    public function updatePost($update)
    {
        var_dump($update);
        $insert = $this->db->prepare("UPDATE post SET title = ?, content = ?, status = ?, updated_at = NOW() WHERE id = ?");
        $insert->execute(array_values($update));

    }

}
