<?php
/**
 * Created by PhpStorm.
 * User: eboch
 * Date: 10/6/2017
 * Time: 3:30 PM
 */

namespace skillup\Core;


use skillup\Exceptions\NotFoundException;

class Config
{
    private $data;
    private static $instance;

    private function __construct() {
        $json = file_get_contents(__DIR__ . '/../../config/app.json');
        $this->data = json_decode($json, true);
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function get($key) {
        if (!isset($this->data[$key])) {
            throw new NotFoundException("Key $key not in the config");
        }

        return $this->data[$key];
    }
}