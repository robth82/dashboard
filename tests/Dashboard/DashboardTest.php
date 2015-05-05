<?php


use Robth82\Dashboard\Dashboard;

class DashboardTest extends PHPUnit_Framework_TestCase {


    const DASHBOARD_ID = 'test';

    private function generateCollection() {
        $collection = new Robth82\Dashboard\Collection\DashboardCollection();
        $collection->registerWidget(new \Robth82\Dashboard\Widget\Widget(['title' => 'test1', 'content' => uniqid()]));
        return $collection;
    }

    private function getNewDashboard() {
        $col = $this->generateCollection();
        $dashboard = new Dashboard(self::DASHBOARD_ID, new \Robth82\Dashboard\Store\ArrayStore(), $col);
        return $dashboard;
    }

    public function testEmptyDashboard()
    {
        $dashboard = $this->getNewDashboard();
        $this->assertCount(0, $dashboard->getWidgets());
    }

    public function testNotExistingWidget() {
        $dashboard = $this->getNewDashboard();
        $this->assertFalse($dashboard->getWidget(1));
    }

    public function testCollectionImplementsInterface() {
        $dashboard = $this->getNewDashboard();
        $collection = $dashboard->getDashboardCollection();

        $this->assertInstanceOf('Robth82\Dashboard\Collection\DashboardCollectionInterface', $collection);
    }

    public function test123() {
        $a = new stdClass();
        $b = new stdClass();

        $a->test = 1;
        $dashboards = $this->getNewDashboard();
        $col = $dashboards->getDashboardCollection();
        $widget1 = $col->getWidget('test1');

        $dashboards->addWidgets($widget1);


        $dashboards2 = $this->getNewDashboard();
        $col2 = $dashboards2->getDashboardCollection();
        $widget2 = $col2->getWidget('test1');

        $dashboards2->addWidgets($widget2);

        //var_dump($dashboards->getWidgets());
        $this->assertTrue($widget1->getUniqid() != $widget2->getUniqid());
        $this->assertCount(2, $dashboards2->getWidgets());


   }

    public function testHuh() {
        $col1 = $this->getNewDashboard();
        $col2 = $this->getNewDashboard();
        $a = 1;
    }
}
 