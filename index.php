<?php

use Robth82\Dashboard\Dashboard;

include('bootstrap.php');

//session_destroy();
$dashboard = new Dashboard('3', new \Robth82\Dashboard\Store\SessionStore(), $dashboardCollection);

$template = $twig->loadTemplate('dashboard.twig');

$template = $template->render(array('dashboard' => $dashboard, 'generatedJavascript' => \Robth82\Dashboard\Helpers\javascriptLoader::getScript()));

echo $template;

?>