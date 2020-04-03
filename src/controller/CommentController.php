<?php


namespace Blog\src\controller;

use PDO;

class CommentController extends Controller
{
    /**
     * @param $id
     * @return array
     */
    public function getPostComment($id)
    {
        $fetch_comments = $this->db->prepare("SELECT * FROM post_comment WHERE comment_status_id = 2 AND post_id =?");
        $fetch_comments->execute([$id]);
        return $fetch_comments->fetchAll(PDO::FETCH_CLASS, 'Blog\src\model\Comment');
    }

    /**
     * @param $id
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayPostComments($id)
    {
        $comments = $this->getPostComment($id);
        echo $this->twig->render('comment.html.twig', ['comments' => $comments]);
    }
}
