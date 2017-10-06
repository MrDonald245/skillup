<?php
/**
 * Managing routes.
 * User: eboch
 * Date: 9/10/2017
 * Time: 8:03 PM
 */

namespace skillup\Core;

use skillup\Controllers\ErrorController;

class Router
{
    private $routeMap;
    private static $regexPatters = [
        'number' => '\d+',
        'string' => '\w',
        'date' => '	^\d{1,2}\/\d{1,2}\/\d{4}$'
    ];

    public function __construct() {
        $json = file_get_contents(
            __DIR__ . '/../../config/routes.json'
        );
        $this->routeMap = json_decode($json, true);
    }

    public function route(Request $request): string {
        $path = $request->getPath();

        foreach ($this->routeMap as $route => $info) {
            $regexRoute = $this->getRegexRoute($route, $info);
            if (preg_match("@/$regexRoute@", $path)) {
                return $this->executeController(
                    $route, $path, $info, $request
                );
            }
        }

        $errorController = new ErrorController($request);
        return $errorController->notFound();
    }

    private function getRegexRoute(string $route, array $info): string {
        if (isset($info['params'])) {
            foreach ($info['params'] as $name => $type) {
                $route = str_replace(
                    ':' . $name, self::$regexPatters[$type], $route
                );
            }
        }

        return $route;
    }

    private function extractParams(string $route, string $path): array {
        $params = [];

        $pathParts = explode('/', $path);
        $routeParts = explode('/', $route);

        foreach ($routeParts as $key => $routePart) {
            if (strpos($routePart, ':') === 0) {
                $name = substr($routePart, 1);
                $params[$name] = $pathParts[$key + 1];
            }
        }

        return $params;
    }

    private function executeController(
        string $route, string $path, array $info, Request $request): string {
        $controller_name =
            '\\' . Config::getInstance()->get('package_name') . '\Controllers\\' . $info['controller'] . 'Controller';
        $controller = new $controller_name($request);

        $params = $this->extractParams($route, $path);
        return call_user_func_array([$controller, $info['method']], $params);
    }
}