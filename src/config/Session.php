<?php


namespace Blog\src\config;

class Session
{
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;
    private static $instance;
    private $session = self::SESSION_NOT_STARTED;

    /**
     * Session constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Session
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }

    /**
     * @return bool
     */
    private function startSession()
    {
        if ($this->session == self::SESSION_NOT_STARTED) {
            $this->session = session_start();
        }

        return $this->session;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function setSession($name, $value): void
    {
        $_SESSION[$name] = $value;
    }
}
