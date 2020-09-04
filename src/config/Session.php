<?php


namespace Blog\src\config;

/**
 * Class Session
 * @package Blog\src\config
 */
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
     *    Destroys the current session.
     *
     * @return    bool    TRUE is session has been deleted, else FALSE.
     */
    public function destroy()
    {
        if ($this->session == self::SESSION_STARTED) {
            $this->session = !session_destroy();
            unset($_SESSION);

            return !$this->session;
        }

        return false;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function show($name)
    {
        if (isset($_SESSION[$name])) {
            $key = $this->getSession($name);
            $this->remove($name);
            return $key;
        }
        return null;
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

    /**
     * @param $name
     */
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }
}
