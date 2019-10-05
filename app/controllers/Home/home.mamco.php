<?php
declare(strict_types=1);
namespace Olimpuss;
//use Olimpuss\Renderer;
use Olimpuss\Helpers\Renderer;
umask(0000);
/**
 * Controller Class for Home
 */

//use Symfony\Component\HttpKernel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Olimpuss\Courses;

class Home extends Controller {

	public function __construct($argvs=null) {
		flog(['Home Controller' => $argvs]);
	}

    public function index(Request $request) {
        //$year = $request->attributes->get('year'); //get a parameter by key
        $templ = Renderer::renderTemplate('home', array(
			'message' => 'My Home Page: ' . print_r($request->getPathInfo(), true)
      	));//*/
        $cadd = Courses::addCourrse('Curso '.uniqid());
        flog(['cadd' => $cadd]);
        $questions = Courses::all()->toArray();
        flog(['questions' => $questions]);
        $response = new Response($templ);
        $response->setTtl(10);
        return $response;        
    }
}
