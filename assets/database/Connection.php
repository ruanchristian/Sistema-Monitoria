<?php

abstract class Connection {
    private static $pdo;
    private static $configs = [
        "dsn" => "mysql:host=127.0.0.1;dbname=monitoria_labs_eeepjas",
        "user" => "root",
        "pass" => ''
    ];
 
    public static function getConnection() {
        if(!self::$pdo) {
          self::$pdo = new PDO(self::$configs['dsn'], self::$configs['user'], self::$configs['pass']);
        }
        return self::$pdo;
    }
}
