<?php

namespace Blog\src\manager;

use Blog\src\model\Comment;

class CommentManager extends Manager
{
    /**
     * @param $id
     * @return array
     */
    public function getPostComment($id)
    {
        $all_comments = [];
        $fetch_comments = $this->db->prepare("SELECT * FROM post_comment LEFT JOIN user ON post_comment.user_id = user.id WHERE comment_status_id = 2 AND post_id = ? ");
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

}
