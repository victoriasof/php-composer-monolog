<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
echo '<h2>$_GET</h2>';
var_dump($_GET);
echo '<h2>$_POST</h2>';
var_dump($_POST);
echo '<h2>$_COOKIE</h2>';
var_dump($_COOKIE);
echo '<h2>$_SESSION</h2>';
var_dump($_SESSION);
}

whatIsHappening();

require_once 'vendor/autoload.php';
require 'vendor/monolog/monolog/src/Monolog/Handler/NativeMailerHandler.php';
require 'buttons.html';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

