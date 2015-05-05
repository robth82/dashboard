<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-10-14
 * Time: 21:05
 */

namespace Robth82\Dashboard;


use Robth82\Dashboard\Collection\DashboardCollection;
use Robth82\Dashboard\Collection\DashboardCollectionInterface;
use Robth82\Dashboard\Store\SessionStore;
use Robth82\Dashboard\Store\Store;
use Robth82\Dashboard\Widget\Widget;

class Dashboard
{
    private $id;
    private $widgets = array();
    private $store;
    private $dashboardCollection;

    public function __construct($id, Store $store = null, DashboardCollectionInterface $dashboardCollection)
    {
        $this->dashboardCollection = $dashboardCollection;
        $this->id = $id;

        if ($store === null) {
            $this->store = new SessionStore();
        } else {
            $this->store = $store;
        }

        $config = $this->load();
        if($config === false) {
            return;
        }

        if(count($config) > 0) {

            foreach ($config as $widget) {
                /** @var $widget Widget */
                /** @var $newWidget Widget */
                $newWidget = clone $dashboardCollection->getWidget($widget->getTitle());
                $newWidget->setUniqid($widget->getUniqid());
                //var_dump($widget->getUserOptions());
                $newWidget->setUserOptions($widget->getUserOptions());
                $newWidget->prepare();

                //$widget->prepare();
                $this->addWidgets($newWidget);
            }
        }

    }


    /**
     * @param Widget $widget
     */
    public function addWidgets(Widget $widget)
    {
        //var_dump($this->widgets);
        $this->widgets[$widget->getUniqid()] = $widget;
        $this->save();

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

    private function transformUserOptions(array $rawWidget)
    {
        return [
            $rawWidget['option'] => $rawWidget['value']
        ];
    }

    public function saveConfig(array $config)
    {
        foreach($config as $rawWidget) {
            $widget = $this->getWidget($rawWidget['id']);

            switch ($rawWidget['method']) {
                case 'widgetConf':
                    $userOptions = $this->transformRawWidgetToWidget($rawWidget);
                    break;
                case 'userOptions':
                    $userOptions = $this->transformUserOptions($rawWidget);
                    break;
                default:
                    throw new \Exception('Method not supported');
            }
            $widget->setUserOptions(array_merge($widget->getUserOptions(), $userOptions));
        }
        $this->save();

    }

    public function removeWidget(Widget $widget)
    {
        unset($this->widgets[$widget->getUniqid()]);
        $this->save();
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

    /**
     * @return DashboardCollection
     */
    public function getDashboardCollection()
    {
        return $this->dashboardCollection;
    }

}