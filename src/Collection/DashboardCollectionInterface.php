<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 21-4-2015
 * Time: 22:12
 */
namespace Robth82\Dashboard\Collection;

use Robth82\Dashboard\Widget\Widget;

interface DashboardCollectionInterface
{
    public function registerWidget(Widget $widget);

    public function getRegisteredWidgets();

    public function getWidget($title);
}