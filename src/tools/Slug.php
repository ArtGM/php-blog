<?php

//change namespace
namespace Blog\src\tools;

class Slug
{
    public function generate(string $string): string
    {
        $string = preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
        $string = preg_replace('#à|á|â|ã|ä|å#', 'a', $string);
        $string = preg_replace('#ç#', 'c', $string);
        $string = preg_replace('#è|é|ê|ë#', 'e', $string);
        $string = preg_replace('#ì|í|î|ï#', 'i', $string);
        $string = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $string);
        $string = preg_replace('#ù|ú|û|ü#', 'u', $string);
        $string = preg_replace('#ý|ÿ#', 'y', $string);
        $string = preg_replace('#|_|:|,|\'|"#', '', $string);
        return $string;
    }
}