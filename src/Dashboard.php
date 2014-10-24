<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-10-14
 * Time: 21:05
 */

namespace Robth82\Dashboard;


use Robth82\Dashboard\Widget\Widget;

class Dashboard
{
    private $widgets = array();


    public function __construct(array $config)
    {
        foreach ($config as $columnNumber => $widgets) {
            foreach ($widgets as $widget) {
                $this->addWidgets($columnNumber, $widget);
            }
        }
    }

    /**
     * @param array $widgets
     */
    public function addWidgets($columnNumber, $widgets)
    {
        if (!isset($this->widgets[$columnNumber])) {
            $this->widgets[$columnNumber] = array();
        }
        $this->widgets[$columnNumber][] = $widgets;
    }

    /**
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }


}