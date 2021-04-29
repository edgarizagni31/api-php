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
            self::$instance = new PDO("mysql:host=btvkmjs5uo9uqclt2mrc-mysql.services.clever-cloud.com;dbname=btvkmjs5uo9uqclt2mrc", "uiih49qxgf7zjelx", "URMK9bqSEpFHl9lMGVGH");
        }

        return self::$instance;
    }
}