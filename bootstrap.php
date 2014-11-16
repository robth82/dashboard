<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:32
 */
session_start();
//session_destroy();
include('vendor\autoload.php');
//var_dump(unserialize($_SESSION['dashboard']['5450976b1fa19']));
use \Robth82\Dashboard\Dashboard;

$config = array();


$loader = new Twig_Loader_Filesystem('twig');

$twig = new Twig_Environment($loader, array(
    'cache' => false, //'twigCache',
    'debug' => true

));

$twig->addExtension(new Twig_Extension_Debug());

include('config.php');
?>