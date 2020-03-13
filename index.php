<?php
//front controller

//Common settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//install filesize
define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Autoload.php');

//run Router
$router = new Router();
$router->run();
