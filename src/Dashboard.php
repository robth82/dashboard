<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-10-14
 * Time: 21:05
 */

namespace Robth82\Dashboard;


use Robth82\Dashboard\Collection\DashboardCollection;
use Robth82\Dashboard\Store\SessionStore;
use Robth82\Dashboard\Store\Store;
use Robth82\Dashboard\Widget\Widget;

class Dashboard
{
    private $id;
    private $widgets = array();
    private $store;

    public function __construct($id, Store $store = null, DashboardCollection $dashboardCollection)
    {
        $this->id = $id;

        if ($store === null) {
            $this->store = new SessionStore();
        } else {
            $this->store = $store;
        }

        $config = $this->load();

        foreach ($config as $widgets) {
            /** @var $widget Widget */
            foreach ($widgets as $widget) {
                $newWidget = $dashboardCollection->getWidget($widget->getTitle());
                $newWidget->setUniqid($widget->getUniqid());
                $newWidget->prepare();
                $this->addWidgets($newWidget);
            }
        }
    }

    /**
     * @param array $widgets
     */
    public function addWidgets($widgets)
    {
        $this->widgets[] = $widgets;

    }

    /**
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @param array $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
    }


    public function getWidget($id)
    {
        foreach ($this->getWidgets() as $col) {
            foreach ($col as $widget) {
                //var_dump($widget);
                /** @var $widget Widget */
                if ($widget->getUniqid() === $id) {
                    return $widget;
                }
            }
        }
        return false;

    }

    public function saveConfig(array $config)
    {
        //TODO
    }

    public function removeWidget(Widget $widget)
    {

    }

    public function moveWidget(Widget $widget, $columnNumber, $posistion)
    {

    }

    protected function save()
    {
        //var_dump($this->getWidgets());
        $this->store->save($this->getId(), $this->getWidgets());
    }

    function __destruct()
    {

        $this->save();
    }


    protected function load()
    {
        return $this->store->load($this->getId());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}