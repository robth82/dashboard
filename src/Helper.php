<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:43
 */

namespace Robth82\Dashboard;

class Helper
{
    public static function renderDashboard($twig, $widgetCollection, $title)
    {
        $widget = $widgetCollection->getWidget($title);

        if ($widget) {
            $template = $twig->loadTemplate('/plugins/' . $widget->getName() . '.twig');
            echo $template->render(array('box' => $widget));
        } else {
            echo 'oops';
        }
    }
}