<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 26-10-14
 * Time: 23:54
 */

include('bootstrap.php');

$dashboard = new \Robth82\Dashboard\Dashboard('3', new \Robth82\Dashboard\Store\SessionStore(), $dashboardCollection);

switch ($_GET['action']) {
    case 'addWidget':
        /** @var \Robth82\Dashboard\Widget\Widget $widget */
        $widget = $dashboardCollection->getWidget($_GET['title']);
        $widget->setUserOptions();

        $dashboard->addWidgets($widget);
        \Robth82\Dashboard\DashboardHelper::renderDashboard($twig, $widget);
        break;
    case 'removeWidget':
        /** @var \Robth82\Dashboard\Widget\Widget $widget */
        //$widget = $dashboardCollection->getWidget($_GET['title']);
        //$widget->setUserOptions();
        $widget = $dashboard->getWidget($_GET['widgetId']);
        $dashboard->removeWidget($widget);
        //\Robth82\Dashboard\DashboardHelper::renderDashboard($twig, $widget);
        break;
    case 'saveConfig':
        $data = json_decode($_POST['data'], true);
        $dashboard->saveConfig($data);
        break;
    case 'addDashboard':
        $_SESSION['dashboards'][uniqid()] = $_POST['option'];
        break;
    case 'refreshWidget':
        $widget = $dashboard->getWidget($_GET['widgetId']);
        \Robth82\Dashboard\DashboardHelper::renderDashboard($twig, $widget);
        break;


}








