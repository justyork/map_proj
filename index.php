<?php
define('DEBUG', true);

if(DEBUG){
    error_reporting(E_ALL | E_STRICT) ;
    ini_set('display_errors', 'On');
}

//session_start();
require_once( 'config.php' );
require_once ( MODELS_DIR . '/JL.php' );

/*
//Создаём новый объект. Также можно писать и в процедурном стиле
$MC = new Memcache;

//Соединяемся с нашим сервером
$MC->connect('127.0.0.1', 11211) or die("Could not connect");
*/
require_once ( 'core/Controller.php' );
spl_autoload_register( 'JL::AutoLoad' );

global $DB;
$DB = startup();


if( isset( $_GET['type'] ) ){ 
    $contr = 'C_' . $_GET['type'];
    $controller = new $contr;
}
else
    $controller = new C_Index();

$controller->Request();


//Закрываем соединение с сервером Memcached
//$MC->close();