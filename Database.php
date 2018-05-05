<?php

class Database {
    private static $instance = null;

    public function __construct() {}

    public function __clone() {}

    public static function getInstance() {
        if(!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost:3306;dbname=photos;charset=utf8', 'photos', 'Xx123456',
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }
        return self::$instance;
    }
}
