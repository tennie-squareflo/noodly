<?php
class Session
{
    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }
    public function clear()
    {
        session_unset();
    }
}
session_start();
