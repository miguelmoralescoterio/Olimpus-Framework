<?php
declare(strict_types=1);
namespace Olimpuss;

umask(0000);
/**
 * Controller Class for Home
 */
use Olimpuss\Models\Course;
use Olimpuss\Helpers\Renderer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Courses extends Controller {

	public static function addCourrse($name){
        $course = Course::create(['course' => $name,]);
        return $course;
    }

    public static function all(){
        $course = Course::orderBy('created_at', 'desc')->get();
        return $course;
    }

}
