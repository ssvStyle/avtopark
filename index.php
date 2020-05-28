<?php
session_start();

include __DIR__ . '/vendor/autoload.php';

use Core\FrontController;

/**
 * SIMON-LIB
 *
 *
 *
 */

$myApp = new FrontController();

$myApp->run();

var_dump($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

