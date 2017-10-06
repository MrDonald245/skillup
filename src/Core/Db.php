<?php
/**
 * Managing database.
 * User: eboch
 * Date: 9/10/2017
 * Time: 9:32 PM
 */

namespace skillup\Core;

use PDO;

class Db
{
    private static $instance;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = self::connect();
        }

        return self::$instance;
    }

    private static function connect(): PDO {
        $dbConfig = Config::getInstance()->get('db');
        return new PDO(
            $dbConfig['type'] . ':host=' . $dbConfig['host'] . ';'
            . 'dbname=' . $dbConfig['dbname'],
            $dbConfig['username'],
            $dbConfig['password']
        );
    }

}