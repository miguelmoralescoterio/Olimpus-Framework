<?php
declare(strict_types=1);
umask(0000);
/**
 * Controller Class 
 */
//use Symfony\Component\HttpKernel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LeapYearController {

    public function index(Request $request) {
        $year = $request->attributes->get('year'); //get a parameter by key
        if (is_leap_year($year)) {
            return new Response('Sí, este es un año bisiesto! => '.$year);
            //return 'Sí, este es un año bisiesto!';
        }

        return new Response('No, este no es un año ('.$year.') bisiesto. only <br/>');
        //return 'No, este no es un año bisiesto.';
    }
}