<?php

namespace Blog\src\controller;

class FrontController extends Controller
{
    public function homePage()
    {
        echo $this->twig->render('base.html.twig');
    }
}
