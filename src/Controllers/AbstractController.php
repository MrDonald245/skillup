<?php
/**
 * Abstract controller with a dependency injection in it.
 * User: eboch
 * Date: 9/11/2017
 * Time: 3:42 PM
 */

namespace skillup\Controllers;


use skillup\Core\Config;
use skillup\Core\Request;
use Twig_Environment;
use Twig_Loader_Filesystem;

class AbstractController
{
    protected $request;
    protected $config;
    protected $view;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->config = Config::getInstance();
        $loader = new Twig_Loader_Filesystem(
            $_SERVER['DOCUMENT_ROOT'] . '/src/Views'
        );
        $this->view = new Twig_Environment($loader);
    }

    protected function render(string $template, array $params): string {
        return $this->view->loadTemplate($template)->render($params);
    }
}