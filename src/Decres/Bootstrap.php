<?php
/**
 * This is a file in the Decres project.
 * The Decres project is released under a MIT
 * license.
 *
 * @copyright 2012 - Wouter J
 * @version 1.0
 */


define('PROJECT_ROOT', getcwd().DIRECTORY_SEPARATOR);
define('SRC_ROOT', realpath(__DIR__.'/../').DIRECTORY_SEPARATOR);
define('ROOT', realpath(__DIR__.'/../../').DIRECTORY_SEPARATOR);

require_once SRC_ROOT.'Decres/autoloader.php';

use Decres\Autoloader;

$classloader = new Autoloader();
$classloader->setNamespaces(array(
    'Decres' => 'src\Decres',
    'Symfony\Component' => 'src\vendor',
    'WouterJ' => 'src\vendor\WouterJ',
));

$classloader->setBaseDir(ROOT);

$classloader->register();
