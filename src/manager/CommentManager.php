<?php

namespace Blog\src\manager;

use Blog\src\model\Comment;

class CommentManager extends Manager
{
    /**
     * @param $id
     * @return array
     */
    public function getComment($id = null)
    {
        if (is_null($id)) {
            $query = "SELECT post_comment.id, post_comment.content, post_comment.create_time, user.first_name, user.last_name, post.title, post_comment.comment_status_id FROM post_comment INNER JOIN post ON post_comment.post_id = post.id INNER JOIN user ON post_comment.user_id = user.id";
        } else {
            $query = "SELECT * FROM post_comment INNER JOIN user ON post_comment.user_id = user.id WHERE comment_status_id = 2 AND post_id = ? ";
        }
        $all_comments = [];
        $fetch_comments = $this->db->prepare($query);
        $fetch_comments->execute([$id]);
        $array_all_comments = $fetch_comments->fetchAll($this->fetch_style);
        foreach ($array_all_comments as $comment) {
            $new_comment = new Comment($comment);
            $all_comments[] = $new_comment;
        }
        return $all_comments;
    }

    public function insertNewComment($newComment)
    {
        $insert = $this->db->prepare("INSERT INTO post_comment (content, create_time, comment_status_id, user_id, post_id) VALUES (?, NOW(), 1, ?, ?)");
        $insert->execute(array_values($newComment));
    }

    public function getAllComments()
    {
        $all_comments = [];
        $fetch_all_comments = $this->db->prepare("SELECT post_comment.id, post_comment.content, post_comment.create_time, user.first_name, user.last_name, post.title, post_comment.comment_status_id, post_comment.post_id, post_comment.user_id FROM post_comment INNER JOIN post ON post_comment.post_id = post.id INNER JOIN user ON post_comment.user_id = user.id");
        $fetch_all_comments->execute();
        $array_all_comments = $fetch_all_comments->fetchAll($this->fetch_style);
        foreach ($array_all_comments as $comment_data) {
            $comment = new Comment($comment_data);
            $all_comments[] = $comment;
        }
        return $all_comments;
    }

}
