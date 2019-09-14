<?php
declare(strict_types=1);
umask(0000);
/**
 * Index File
 */
// Access-Control headers are received during OPTIONS requests
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, PUT, POST, PATCH, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:  {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
} else {
	header('Access-Control-Max-Age: 10000');
	header("Access-Control-Allow-Origin: *", true);
}
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE', true);
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Access-Control-Allow-Origin, Origin, X-CSRF-TOKEN', true);
header('X-Xss-Protection: 1; mode=block', true);
header('X-Content-Type-Options: nosniff', true);
header('X-Permitted-Cross-Domain-Policies: *', true);
header('Cache-Control: no-cache env=NO_CACHE', true);
header('Cache-Control: no-store env=NO_STORE', true);
header('Pragma: no-cache env=NO_CACHE', true);
header('Pragma: no-store env=NO_STORE', true);

//defined('SITE') or define('SITE', dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'test'.DIRECTORY_SEPARATOR);
if (is_array($env = @include SITE.'/.env.local.php')) {
    foreach ($env as $k => $v) {
        $_ENV[$k] = $_ENV[$k] ?? (isset($_SERVER[$k]) && 0 !== strpos($k, 'HTTP_') ? $_SERVER[$k] : $v);
    }
} elseif (!class_exists(Dotenv\Dotenv::class)) {
    throw new RuntimeException('Please run "composer require vlucas/phpdotenv" to load the ".env" files configuring the application.');
} else {
    $dotenv = \Dotenv\Dotenv::create(SITE, '.env');
	$dotenv->overload();
	$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','APP_ENV','APP_SESSID'])->notEmpty();
	$dotenv->required('DB_PORT')->notEmpty()->isInteger();
}

foreach ($_ENV as $k => $v) {
	defined($k) or define($k, $v);
}


defined('APP_ENV') or define('APP_ENV', env('APP_ENV') ?? 'development');
switch (APP_ENV) {
    case 'deve':
    case 'devel':
    case 'develop':
    case 'development':
        error_reporting(E_ALL);
        //error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        ini_set('display_errors', 'On');
    break;

    case 'test':
    case 'testing':
    case 'production':
        ini_set('display_errors', 'Off');
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
    break;

    case 'maintenance':
        $protocol = 'HTTP/1.0';

        if ( $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' ) {
            $protocol = 'HTTP/1.1';
        }
        echo 'The application is in maintenance, please excuse the inconvenience and try later, thanks ...<br><hr>La aplicación se encuentra en mantenimiento, por favor disculpe las molestias e intente mas tarde, gracias...';

        header( $protocol . ' 503 Service Unavailable', true, 503 );
        header( 'Retry-After: 3600' );
        exit(1); // EXIT_ERROR

    default:
        $protocol = 'HTTP/1.0';

        if ( $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' ) {
            $protocol = 'HTTP/1.1';
        }
        header($protocol . ' 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

defined('APP_SESSID') or define('APP_SESSID',str_replace('.', '', ($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'])));
define('SESSIONAME', APP_SESSID);
defined("TAB1") or define("TAB1", "\t");
defined("TAB2") or define("TAB2", str_repeat("\t",  2));
defined("TAB3") or define("TAB3", str_repeat("\t",  3));
defined("TAB4") or define("TAB4", str_repeat("\t",  4));
defined("TAB5") or define("TAB5", str_repeat("\t",  5));
defined("TAB6") or define("TAB6", str_repeat("\t",  6));
defined("TAB7") or define("TAB7", str_repeat("\t",  7));
defined("TAB8") or define("TAB8", str_repeat("\t",  8));
defined("TAB9") or define("TAB9", str_repeat("\t",  9));
defined("TABA") or define("TABA", str_repeat("\t", 10));
defined("TABB") or define("TABB", str_repeat("\t", 11));
defined("TABC") or define("TABC", str_repeat("\t", 12));
defined("TABD") or define("TABD", str_repeat("\t", 13));
defined("TABE") or define("TABE", str_repeat("\t", 14));
defined("TABF") or define("TABF", str_repeat("\t", 15));

define('APP_ROOT', ROOT.'app'.DIRECTORY_SEPARATOR);
define('RESOURCES', ROOT.'src'.DIRECTORY_SEPARATOR);
define('HLP_ROOT', APP_ROOT.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR);
define('STORAGE', ROOT.'storage'.DIRECTORY_SEPARATOR);
define('SITENAME', basename(SITE));
define('SITESRC', RESOURCES.SITENAME.DIRECTORY_SEPARATOR);
define('ROUTES', APP_ROOT.'routes'.DIRECTORY_SEPARATOR.SITENAME.DIRECTORY_SEPARATOR);

if(!is_dir(ROOT . 'storage/cache')) {
	@mkdir(ROOT . 'storage/cache', 0777, true);
}
require_once HLP_ROOT.'posthelpers.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Olimpuss\App;

$request = Request::createFromGlobals();

$routes = include ROUTES.'routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();


$App = new App($matcher, $controllerResolver, $argumentResolver);

$response = $App->handle($request);
if($response instanceof Response) {
	$response->send();
} else {
	return $response;
}