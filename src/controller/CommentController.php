<?php

namespace Blog\src\controller;

use Twig\Error\LoaderError;

class CommentController extends Controller
{


    /**
     * @param $post_id
     * @throws LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayPostComments($post_id)
    {
        $comments = $this->comment->getPostComment($post_id);
        if (!empty($comments)) {
            echo $this->twig->render('comment.html.twig', ['comments' => $comments]);
        }
    }

    /**
     * @param $post_id
     * @throws LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayCommentForm($post_id)
    {
        $post['id'] = $post_id; // TODO: transform args to array for passing extra data (ex: User_id)
        echo $this->twig->render('comment_form.html.twig', ['post' => $post]);
    }

    /**
     * @param array $newComment
     */
    public function addComment($newComment)
    {
        if (!empty($newComment)) {
            $this->comment->insertNewComment($newComment);
        }
    }
}
