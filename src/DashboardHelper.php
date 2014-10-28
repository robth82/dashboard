<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:43
 */

namespace Robth82\Dashboard;

class DashboardHelper
{
    public static function renderDashboard($twig, $widget)
    {
        if ($widget) {
            $template = $twig->loadTemplate('/plugins/' . $widget->getName() . '.twig');
            echo $template->render(array('box' => $widget));
        } else {
            echo 'oops';
        }
    }
}