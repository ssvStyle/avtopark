<?php
session_start();
$start = microtime(true);

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

echo '<div style="position: relative"><div style="border-radius: 10px; position: fixed; bottom: 20px; right: 20px; z-index: 9999; background: #90acca6b; color: #343a40; font-size: 20px; opacity: 0.5; padding: 5px 15px"> Время выполнения: '.round(microtime(true) - $start, 4).' сек.</div></div>';

var_dump($_SESSION);