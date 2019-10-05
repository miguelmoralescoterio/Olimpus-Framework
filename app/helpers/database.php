<?php
declare(strict_types=1);
umask(0000);
/**
 * Helpers Database File
 */
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

if(!file_exists(ROOT.'config/config.defs.php')) {
	trigger_error("No se encontro el archivo de configuracion de Bases de Datos, por favor verifque", E_USER_ERROR);
}
GLOBAL $DB;
$DB = null;
$config = include ROOT.'config/config.defs.php';

if(isset($config['dbconnections']) && is_array($config['dbconnections'])) {
	$DB = new DB;
	$dbc = $config['dbconnections'];
	if(isset($dbc['default']) && !empty($dbc['default'])) {
		$default = $dbc['default'];
		unset($dbc['default']);
		if(isset($dbc[$default])) {
			if(is_array($dbc[$default])) {
				$defaultc = $dbc[$default];
				$DB->addConnection($defaultc, 'default');
			}
			unset($dbc[$default]);
		}
	}
	foreach ($dbc as $name => $config) {
		if(is_array($config)) {
			$DB->addConnection($config, $name);
		}
	}
	$DB->setEventDispatcher(new Dispatcher(new Container));
	$DB->setAsGlobal();
	$DB->bootEloquent();
}

