<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 1:45 PM
 */

if(!isset($_SESSION)); session_start();

require_once __DIR__.'/../app/config/_env.php';


//INSTANTIATE DB CLASS
new \App\Classes\Database();


//SET CUSTOM ERROR HANDLER
set_error_handler([new \App\Classes\ErrorHandler(), 'handleError']);

require_once __DIR__.'/../app/routing/route.php';

new \App\routing\RouteDispatcher($router);




