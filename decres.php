#!E:\wouter\web\wamp\bin\php\php5.3.5\php.exe
<?php

require_once __DIR__.'/src/Decres/Bootstrap.php';

use Decres\Console\Application;

$application = new Application();
$application->run();
