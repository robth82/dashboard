<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 26-10-14
 * Time: 23:54
 */

include('bootstrap.php');

$dashboard = new \Robth82\Dashboard\Dashboard($_REQUEST['dashboardId'], new \Robth82\Dashboard\Store\SessionStore(), $dashboardCollection);

switch ($_GET['action']) {
    case 'addWidget':
        $widget = $dashboardCollection->getWidget($_POST['title']);
        $dashboard->addWidgets('no1', $widget);
        \Robth82\Dashboard\DashboardHelper::renderDashboard($twig, $widget);
        break;
    case 'saveConfig':
        $config = json_decode($_POST['config']);
        $dashboard->saveConfig($config);
        break;
    case 'addDashboard':
        $_SESSION['dashboards'][uniqid()] = $_POST['option'];
        break;
    case 'refreshWidget':
        $widget = $dashboard->getWidget($_GET['widgetId']);
        \Robth82\Dashboard\DashboardHelper::renderDashboard($twig, $widget);
        break;


}








