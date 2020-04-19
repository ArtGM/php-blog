<?php


namespace Blog\src\controller;

class CommentController extends Controller
{


    /**
     * @param $id
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayPostComments($id)
    {
        $comments = $this->comment->getPostComment($id);
        if (!empty($comments)) {
            echo $this->twig->render('comment.html.twig', ['comments' => $comments ]);
        }
    }
}
