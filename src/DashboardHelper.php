<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:43
 */

namespace Robth82\Dashboard;

use Robth82\Dashboard\Widget\Widget;

class DashboardHelper
{
    public static function renderDashboard($twig, Widget $widget)
    {
        if ($widget) {
            $widget->prepare();
            $template = $twig->loadTemplate('/plugins/' . $widget->getName() . '.twig');
            echo $template->render(array('box' => $widget, 'options' => array('ajax' => true)));
        } else {
            echo 'oops';
        }
    }
}