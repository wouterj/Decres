<?php

define('SRC_ROOT', __DIR__.DIRECTORY_SEPARATOR);
define('ROOT', realpath(__DIR__.'/../').DIRECTORY_SEPARATOR);

require_once SRC_ROOT.'Autoloader.php';

$classloader = new Autoloader();
$classloader->setBaseDir(SRC_ROOT);
$classloader->register();
