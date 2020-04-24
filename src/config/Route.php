<?php


namespace Blog\src\config;

class Route
{
    private $path;
    private $fn;
    private $matches = [];
    private $params = [];
    /**
     * Route constructor.
     * @param $path
     * @param $fn
     */
    public function __construct($path, $fn)
    {
        $this->path = trim($path, '/');
        $this->fn = $fn;
    }

    /**
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = '#^$path$#i';
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * @return mixed
     */
    public function call()
    {
        return call_user_func($this->fn, $this->matches);
    }
}
