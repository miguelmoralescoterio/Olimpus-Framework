<?php
declare(strict_types=1);
umask(0000);
/**
 * Controller Class for Home
 */
use Symfony\Component\HttpKernel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Home {
    public function index(Request $request) {
        //$year = $request->attributes->get('year'); //get a parameter by key
        die('Home Page: '.print_r($request->getPathInfo(), true));
    }
}