<?php
/**
 * Created by PhpStorm.
 * User: eboch
 * Date: 9/29/2017
 * Time: 12:27 PM
 */

namespace skillup\Core;


class Redirect
{
    private function __construct() {

    }

    public static function go(string $url, bool $permanent = false) {
        $server_name = $_SERVER['HTTP_HOST']
            ? $_SERVER['HTTP_HOST']
            : $_SERVER['SERVER_NAME'];

        header('Location: ' . $server_name . '/' . $url,
            true,
            $permanent ? 301 : 302);

        exit();
    }
}