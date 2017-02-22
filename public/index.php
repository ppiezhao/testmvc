<?php 
header("Content-type:text/html;charset=utf8");
error_reporting(E_ALL);
define("APPLICATION_PATH", realpath(dirname(__FILE__) . '/../'));
//自动加载
require (APPLICATION_PATH . "/framework/loader.php");

//$app = new Mmvc_Application();
$app = new Mmvc_Application();
//luyou
$app::dispatch();
die;
require "../config/routes.php";

