<?php


namespace Blog\Config;

/**
 * Class Route
 * @package Blog\src\Config
 */
class Route
{
    private $path;
    private $params = [];

    /**
     * Route constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = trim($path, '/');
    }

    /**
     * ADD PARAMETERS TO CHECK URL
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    /**
     * Test matching url
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, '/');

        $path = preg_replace_callback('/:([\w]+)/', [$this, 'matchingParams'], $url);

        $hash_path = explode('/', $path);

        if (in_array('admin', $hash_path)) {
            $path = preg_replace('/\//', '\/', $path);
        }

        $regex = '/^' . $path . '$/i';
        if (!preg_match($regex, $this->path)) {
            return false;
        }
        return true;
    }

    /**
     * return the id parameters
     * @return false|string
     */
    public function getRouteIdParam()
    {
        preg_match_all('!\d+!', $this->path, $route_id);
        return implode('', $route_id[0]);
    }

    /**
     * Return the good regex to test
     * @param $match
     * @return mixed|string
     */
    private function matchingParams($match)
    {
        if (isset($this->params[$match[1]])) {
            return $this->params[$match[1]];
        }
        return '([^/]+)';
    }
}
