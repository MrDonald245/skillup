<?php
/**
 * Created by PhpStorm.
 * User: eboch
 * Date: 9/29/2017
 * Time: 8:29 PM
 */

namespace skillup\Controllers;


class HomeController extends AbstractController
{
    public function index() {
        return $this->render('home.twig', []);
    }
}