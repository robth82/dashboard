<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 22-10-14
 * Time: 22:56
 */

namespace Robth82\Dashboard\Collection;


use Robth82\Dashboard\Widget\Widget;

class   DashboardCollection
{
    private $collection = array();

    public function registerWidget(Widget $widget)
    {
        if (!self::titleExists($widget->getTitle(), $this->collection)) {
            $this->collection[] = $widget;
        } else {
            throw new DashboardCollectionException($widget);
        }

    }

    public function getRegisteredWidgets()
    {
        return $this->collection;
    }

    public function getWidget($title)
    {
        $id = self::titleExists($title, $this->collection);
        if ($id !== false) {
            return $this->collection[$id];
        } else {
            return false;
        }
    }

    private static function titleExists($title, $collection)
    {
        foreach ($collection as $id => $widget) {
            if ($widget->getTitle() == $title) {
                return $id;
            }
        }
        return false;
    }
} 