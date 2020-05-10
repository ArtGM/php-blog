<?php

namespace Blog\src\tools;

class Slug
{
    public function generate(string $string): string
    {
        $string = preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
        $string = preg_replace('#[àáâãäå]#', 'a', $string);
        $string = preg_replace('#ç#', 'c', $string);
        $string = preg_replace('#[èéêë]#', 'e', $string);
        $string = preg_replace('#[ìíîï]#', 'i', $string);
        $string = preg_replace('#[ðòóôõö]#', 'o', $string);
        $string = preg_replace('#[ùúûü]#', 'u', $string);
        $string = preg_replace('#[ýÿ]#', 'y', $string);
        $string = preg_replace('#|_|:|\.|,|\'|"#', '', $string);
        $string = preg_replace('#\d$#', '', $string);// remove number at the end
        $string = preg_replace('#\W$#', '', $string);// remove character at the end
        return $string;
    }
}