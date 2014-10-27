<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:33
 */

$test = array(
    array('col1' => 1, 'col2' => 2, 'col3' => 2, 'col4' => 2),
    array(11, 12),
    array(11, 12),
    array(11, 12),
    array(11, 12),
    array(11, 12),
    array(11, 12),
    array(11, 12),
);

$dashboardCollection = new \Robth82\Dashboard\Collection\DashboardCollection();
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Buienradar voorspellingen', 'content' => '<IFRAME SRC="http://gratisweerdata.buienradar.nl/weergadget/index6260.html" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=300 HEIGHT=190></IFRAME>')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Buienradar', 'content' => '<a href="http://www.buienradar.nl" target="_blank"><img border="0" src="http://www.buienradar.nl/images.aspx?jaar=-3&soort=sp-loop"></a>')));
//$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget('Buienradar', array('content' => '<a href="http://www.buienradar.nl" target="_blank"><img border="0" src="http://www.buienradar.nl/images.aspx?jaar=-3&soort=sp-loop"></a>')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\TableWidget(array('title' => 'Robs table', 'content' => $test)));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\TableWidget(array('title' => 'Robs tsable', 'content' => $test)));