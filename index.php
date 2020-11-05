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
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('BrowserConsoleHandler');
//$log->pushHandler(new BrowserConsoleHandler('logs/warning.log', Logger::WARNING));
$log->pushHandler(new BrowserConsoleHandler);

$type = $_GET['type'];
$message = $_GET['message'];

switch ($type){

    case 'INFO':
        $log->pushHandler(new StreamHandler( __DIR__ . '/logs/info.log', Logger::INFO));
        $log->info($message);
        break;

    case 'DEBUG':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::DEBUG));
        $log->debug($message);
        break;

    case 'NOTICE':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::NOTICE));
        $log->notice($message);
        break;

    case 'WARNING':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::WARNING));
        $log->warning($message);
        break;

    case 'ALERT':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ALERT));
        $log->alert($message);
        break;

    case 'ERROR':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ERROR));
        $log->error($message);
        break;

    case 'CRITICAL':
        $log->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::CRITICAL));
        $log->critical($message);
        break;

    case 'EMERGENCY':
        $log->pushHandler(new StreamHandler( __DIR__ . '/log/emergency.log', Logger:: EMERGENCY));
        $log->emergency($message);
        break;

}

$log->$type($message);

// add records to the log
$log->warning('Foo');
$log->error('Bar');

/*
Use the buttons.html page to submit log messages and write the message in a log file.

Write each color of buttons to a different file:

    info: info.log and send the messages to browser console using BrowserConsoleHandler
    warning: warning.log
    danger: warning.log and email these messages using NativeMailerHandler
    dark: emergency.log and email these messages using NativeMailerHandler

You do not need to use an if to get the messages written in different files
*/
