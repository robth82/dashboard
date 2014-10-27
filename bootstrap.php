<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:32
 */

include('vendor\autoload.php');

use \Robth82\Dashboard\Dashboard;

$config = array();

$dashboard = new Dashboard($config);

$loader = new Twig_Loader_Filesystem('twig');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => true,
));

$twig->addExtension(new Twig_Extension_Debug());


include('config.php');
?>