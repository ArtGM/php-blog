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
        var_dump($posts);

        echo $this->twig->render('blog.html.twig', ['posts' => $posts]);
    }

    /**
     * Display a single post by id
     * @param $id
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function displaySinglePost($id)
    {
        $comment = new CommentController();
        $single[] = $this->post->getPosts($id);
        echo $this->twig->render('single.html.twig', ['single' => $single[0]]);
        $comment->displayPostComments($id);
        $comment->displayCommentForm($id);
    }
}
