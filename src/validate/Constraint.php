<?php

namespace Blog\src\validate;

class Constraint
{
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return 'Le champ ' . $name . ' saisi est vide';
        }
    }

    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            return 'Le champ ' . $name . ' doit contenir au moins ' . $minSize . ' caractères';
        }
    }

    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            return 'Le champ ' . $name . ' doit contenir au maximum ' . $maxSize . ' caractères';
        }
    }

    public function isEmail($name, $value)
    {
        $regex = '/[a-zA-Z0-9\_\-\.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/';
        if (!preg_match($regex, $value)) {
            return 'veuillez entrer un ' . $name . ' valide.';
        }
    }


}
