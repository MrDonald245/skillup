<?php
/**
 * User: eboch
 * Date: 9/10/2017
 * Time: 12:36 PM
 */

use skillup\Core\Request;
use skillup\Core\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
$response = $router->route(new Request());
echo $response;