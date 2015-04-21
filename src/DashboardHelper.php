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
    public static function renderDashboard(\Twig_Environment $twig, Widget $widget)
    {
        $widget->prepare();
        $template = $twig->loadTemplate('/plugins/' . $widget->getName() . '.twig');
        $html = $template->render(array('widget' => $widget, 'options' => array('ajax' => true)));
        $javascript = Helpers\JavascriptLoader::getScript();
        echo json_encode(['html' => $html, 'javascript' => $javascript]);
        //echo ;
    }
}