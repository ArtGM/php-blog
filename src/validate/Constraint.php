<?php

namespace Blog\src\validate;

/**
 * Class Constraint
 * @package Blog\src\validate
 */
class Constraint
{
    /**
     * @param $name
     * @param $value
     * @return string
     */
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return 'Le champ ' . $name . ' saisi est vide';
        }
    }

    /**
     * @param $name
     * @param $value
     * @param $minSize
     * @return string
     */
    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            return 'Le champ ' . $name . ' doit contenir au moins ' . $minSize . ' caractères';
        }
    }

    /**
     * @param $name
     * @param $value
     * @param $maxSize
     * @return string
     */
    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            return 'Le champ ' . $name . ' doit contenir au maximum ' . $maxSize . ' caractères';
        }
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public function isEmail($name, $value)
    {
        $regex = '/[a-zA-Z0-9\_\-\.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/';
        if (!preg_match($regex, $value)) {
            return 'veuillez entrer un ' . $name . ' valide.';
        }
    }
}
