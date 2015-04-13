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

        foreach ($config as $widget) {
            /** @var $widget Widget */
            /** @var $newWidget Widget */
            $newWidget = $dashboardCollection->getWidget($widget->getTitle());
            $newWidget->setUniqid($widget->getUniqid());
            //var_dump($widget->getUserOptions());
            $newWidget->setUserOptions($widget->getUserOptions());
            //var_dump($newWidget);
            $newWidget->prepare();

            //$widget->prepare();
            $this->addWidgets($newWidget);
        }

    }

    /**
     * @param array $widgets
     */
    public function addWidgets(Widget $widgets)
    {
        $this->widgets[$widgets->getUniqid()] = $widgets;
        //$this->save();

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
        foreach ($this->getWidgets() as $widget) {
                /** @var $widget Widget */
            if ($widget->getUniqid() === $id) {
                return $widget;
            }
        }
        return false;

    }

    private function transformRawWidgetToWidget(array $rawWidget)
    {
        return [
            'data-gs-x' => $rawWidget['x'],
            'data-gs-y' => $rawWidget['y'],
            'data-gs-width' => $rawWidget['width'],
            'data-gs-height' => $rawWidget['height']
        ];
    }

    public function saveConfig(array $config)
    {
        foreach($config as $rawWidget) {
            //var_dump($rawWidget);
            $widget = $this->getWidget($rawWidget['id']);
            var_dump($widget);
            $widget->setUserOptions($this->transformRawWidgetToWidget($rawWidget));
            var_dump($widget);
            echo '<hr>';
        }
        $this->save();

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