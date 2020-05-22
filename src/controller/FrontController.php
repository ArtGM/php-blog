<?php

namespace Blog\src\controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontController extends Controller
{
    public function homePage()
    {
        echo $this->twig->render('base.html.twig');
    }

    /**
     * Display all posts
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displayPosts()
    {
        $posts = $this->post->getPosts();
        echo $this->twig->render('blog.html.twig', ['posts' => $posts]);
    }

    /**
     * Display a single post by id
     * @param $post_id
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displaySinglePost($post_id)
    {
        $comment = new CommentController();
        $single[] = $this->post->getPosts($post_id);

        if (is_null($single[0]->getId())) { // return error 404 if post don't exist
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
        $comment->displayPostComments($post_id);
        $comment->displayCommentForm($post_id);
    }

    /**
     * @param $post_id
     * @throws LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function displayPostComments($post_id)
    {
        $comments = $this->comment->getComment($post_id);
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
