<?php
declare(strict_types=1);
umask(0000);
/**
 * Routes File For "public" Site
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
$routes = new Routing\RouteCollection();

/**
 * Routes Definition
 * add(name, Routing\Route('route'), $options)
 * @param name: nombre de la ruta
 * @param 'route': ruta que se usara 
 * @param $options: opciones de configuración
 * 		de la ruta, obligatorio el parametro _controller
 * @param $options['_controller']: debe ser un controlador
 * 		en una Clase para que pueda ser vinculado a la ruta
 *
**/
$routes->add('home', new Routing\Route('/', [
    'year' => 'World',
    '_controller' => 'Home::index',
    'utf8' => true,
]));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'LeapYearController::index'
]));

return $routes;
