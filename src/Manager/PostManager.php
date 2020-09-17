<?php

namespace Blog\Manager;

use Blog\Model\Post;
use Blog\Model\User;

/**
 * Class PostManager
 * @package Blog\src\Manager
 */
class PostManager extends Manager
{
    /**
     * @param null $id
     * @param bool $is_admin
     * @return array|Post|string
     */
    public function getPosts($id = null, $is_admin = false)
    {
        $query = $is_admin ? 'SELECT * FROM post' : 'SELECT * FROM post INNER JOIN user WHERE user.id = post.user_id AND status = 1';

        if (is_null($id)) {
            $fetch_posts = $this->db->query($query);
            $array_all_posts = $fetch_posts->fetchAll($this->fetch_style);
            foreach ($array_all_posts as $post) {

                $new_post = new Post($post);
                $excerpt = substr($new_post->getContent(), 0, 30);
                $author = new User($post);
                $all_posts[] = [$new_post, $author, $excerpt];
            }
            if (!empty($all_posts)) {
                return $all_posts;
            }
            echo 'Aucun article';
        }
        $fetch_posts = $this->db->prepare("SELECT * FROM post WHERE id = ?");
        $fetch_posts->execute([$id]);
        $fetching = $fetch_posts->fetch($this->fetch_style);
        return new Post($fetching);
    }

    /**
     * @param $newPost
     */
    public function insertNewPost($newPost)
    {
        $insert = $this->db->prepare("INSERT INTO post (title, content, status, created_at, updated_at, post_type, user_id, user_roles_id) VALUES (?, ?, ?, NOW(), NOW(), 1, ?, ?)");
        $insert->execute(array_values($newPost));
    }

    /**
     * @param $update
     */
    public function updatePost($update)
    {
        $insert = $this->db->prepare("UPDATE post SET title = ?, content = ?, status = ?, updated_at = NOW() WHERE id = ?");
        $insert->execute(array_values($update));
    }

    /**
     * @param int $id
     */
    public function deletePost(int $id)
    {
        $removePostComment = $this->db->prepare('DELETE FROM post_comment WHERE post_id = ?');
        $removePostComment->execute([$id]);
        $remove = $this->db->prepare('DELETE FROM post WHERE id = ?');
        $remove->execute([$id]);
    }
}
