<?php


define('BASE_PATH', realpath(__DIR__.'/../../'));

require_once(BASE_PATH.'/vendor/autoload.php');

define('DS', DIRECTORY_SEPARATOR);//DIRECTORY SEPARATOR




define('PROOT', dirname(__FILE__).DS . '..' . DS . '..'. DS);//PROJECT ROOT OF THE PROJECT



$dotEnv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotEnv->load();
































?>
