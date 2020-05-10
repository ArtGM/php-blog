<?php


namespace Blog\src\controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostController extends Controller
{


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

    public function addNewPost($newPost)
    {
        if (!empty($newPost)) {
            $this->post->insertNewPost($newPost);
        }
    }

    public function updatePost($update)
    {
        if (!empty($update)) {
            $this->post->updatePost($update);
        }
    }

    public function deletePost($post_id)
    {
        $this->post->deletePost($post_id);
        header("location:/admin/gestion-articles");
    }
}
