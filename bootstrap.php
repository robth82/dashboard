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


$loader = new Twig_Loader_Filesystem(__DIR__ . '/twig');

$twig = new Twig_Environment($loader, array(
    'cache' => 'twigCache',
    'debug' => true

));

$twig->addExtension(new Twig_Extension_Debug());

$function = new Twig_SimpleFunction('addJavascript', function($javascript) {
    Robth82\Dashboard\Helpers\JavascriptLoader::addScript($javascript);
});
$twig->addFunction($function);

$function = new Twig_SimpleFunction('getJavascript', function() {
    return Robth82\Dashboard\Helpers\JavascriptLoader::getScript();
});
$twig->addFunction($function);

$function = new Twig_SimpleFunction('testje', function() {
    return 'testje';
});
$twig->addFunction($function);

include('config.php');
?>