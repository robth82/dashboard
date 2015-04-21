<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 7:33
 */

$test = array(
    array('col1' => 1, 'col2' => 2, 'col3' => 2, 'col4' => 2),
    array(11, 12, 10, 10),
    array(11, 12, 10, 10),
    array(11, 12, 10, 10),
    array(11, 12),
    array(11, 12, 10, 10),
    array(11, 12),
    array(11, 12),
);

$dashboardCollection = new \Robth82\Dashboard\Collection\DashboardCollection();

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\DataWidget([
    'title' => 'De titel',
    'data' => [
        1 => 5,
        2 => 6,
        3 => 7,
        4 => 3,
        5 => 9,
        6 => 10,
        7 => 4,
        8 => 12,


    ]
]));

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Buienradar voorspellingen', 'content' => '<IFRAME SRC="http://gratisweerdata.buienradar.nl/weergadget/index6260.html" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=300 HEIGHT=190></IFRAME>')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array(
    'title' => 'Buienradar',
    'content' => '<a href="http://www.buienradar.nl" target="_blank"><img style="width:95%" border="0" src="http://www.buienradar.nl/images.aspx?jaar=-3&soort=sp-loop"></a>',
    'refreshInterval' => (60 * 15)

)));

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array(
    'title' => 'Users',
    'content' => '<div class="table-responsive"><table class="table"><thead><tr><th>#</th><th>First Name</th><th>Last Name</th><th>Username</th></tr></thead><tbody><tr class="success"><td>1</td><td>Mark</td><td>Otto</td><td>@mdo</td></tr><tr class="info"><td>2</td><td>Jacob</td><td>Thornton</td><td>@fat</td></tr><tr class="warning"><td>3</td><td>Larry</td><td>the Bird</td><td>@twitter</td></tr><tr class="danger"><td>4</td><td>John</td><td>Smith</td><td>@jsmith</td></tr></tbody></table></div>',
    'refreshInterval' => (60 * 15)

)));

//$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget('Buienradar', array('content' => '<a href="http://www.buienradar.nl" target="_blank"><img border="0" src="http://www.buienradar.nl/images.aspx?jaar=-3&soort=sp-loop"></a>')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf82')));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\TableWidget(array('title' => 'Robs table', 'content' => $test)));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\TableWidget(array('title' => 'Robs tsable', 'content' => $test)));
$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\ClockWidget(array('title' => 'Klok')));

$dilbert = '<div style="margin-left:59px;">
<!--[if IE]><object width="400" height="300" type="application/x-shockwave-flash" quality="high" id="W478cf2052d7472a1"><param value="http://widget.dilbert.com/o/4782b1ae641c3eb6/478cf2052d7472a1/4782b1ae641c3eb6/74b9dd60" name="movie"/><![endif]-->
<!--[if !IE]><!--><object width="400" height="300" type="application/x-shockwave-flash" id="W478cf2052d7472a1" data="http://widget.dilbert.com/o/4782b1ae641c3eb6/478cf2052d7472a1/4782b1ae641c3eb6/74b9dd60"><!--<![endif]--><param name="wmode" value="transparent"><param name="allowScriptAccess" value="always"><param name="allowNetworking" value="all"></object><script type="text/javascript" src="http://widget.dilbert.com/o/4782b1ae641c3eb6/478cf2052d7472a1/4782b1ae641c3eb6/74b9dd60/widget.js"></script>
</div>';

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\Widget(array('title' => 'Dilbert', 'content' => $dilbert)));

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\PieChartWidget(array(
    'title' => 'Alarmen',
    'titleLong' => 'Alarmen per prioriteit',
    'ajaxLoad' => true,
    'data' => array(
        'Urgent' => 100,
        'Niet urgent' => 120,
        'Geen prrioriteit' => 70
    )
)));

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\PieChartWidget(array(
    'title' => 'Alarmen en events',
    'titleLong' => 'Alarmen en events',
    'data' => array(
        'Alarm' => 100,
        'Event' => 140,
    )
)));

$dashboardCollection->registerWidget(new \Robth82\Dashboard\Widget\GaugeWdiget(array('title' => 'Speed')));