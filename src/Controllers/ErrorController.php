<?php
/**
 * Created by PhpStorm.
 * User: eboch
 * Date: 9/11/2017
 * Time: 3:47 PM
 */

namespace skillup\Controllers;


class ErrorController extends AbstractController
{
    public function notFound():string {
        $properties = ['errorMessage' => 'Page was not found!'];
        return $this->render('error.twig', $properties);
    }
}