<?php
use Robth82\Dashboard\Dashboard;

include('bootstrap.php');


$dashboard = new Dashboard('3', new \Robth82\Dashboard\Store\SessionStore(), $dashboardCollection);

$widget = $dashboardCollection->getWidget('Buienradar');
//$dashboard->addWidgets($widget);

$widget = $dashboardCollection->getWidget('Users');
//$dashboard->addWidgets($widget);
//$dashboard->addWidgets($widget);


$template = $twig->loadTemplate('dashboard.twig');
echo $template->render(array('dashboard' => $dashboard));

?>