<?php
class DB
{

    private static $instance;

    private function __construct()
    {
        //!private
    }

    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO("mysql:host=localhost;dbname=cita", "root", "");
        }

        return self::$instance;
    }
}
