<?php
declare(strict_types=1);
umask(0000);
/**
 * Index File
 */
define('ROOT', dirname(__DIR__, 1).DIRECTORY_SEPARATOR);
define('SITE', __DIR__.DIRECTORY_SEPARATOR);
require_once ROOT.'vendor/autoload.php';
