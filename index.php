<!doctype html>

<?php

use \Robth82\Dashboard\Dashboard;

include('bootstrap.php');

?>

<head>
    <meta charset="utf-8">
    <title>HTML5 Sortable jQuery Plugin</title>
    <link rel="stylesheet" href="css/dashboard.css"/>
    <link rel="stylesheet" href="css/selectize.default.css"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/jquery.sortable.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/selectize.min.js"></script>

</head>
<?php

?>
<body>
<header>
    <h1>Dashboard</h1>
</header>

<section id="connected">

    <?php

    $config = array(
        'no1' => array(
            //new \Robth82\Dashboard\Widget\TableWidget('Robs table', $test),
            //new \Robth82\Dashboard\Widget\TableWidget('Robs table', $test),
            //new \Robth82\Dashboard\Widget\Widget(array('title' => 'Buienradar voorspellingen', 'content' => '<IFRAME SRC="http://gratisweerdata.buienradar.nl/weergadget/index6260.html" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=300 HEIGHT=190></IFRAME>')),
            //new \Robth82\Dashboard\Widget\Widget(array('title' => 'Buienradar', 'content' => '<a href="http://www.buienradar.nl" target="_blank"><img border="0" src="http://www.buienradar.nl/images.aspx?jaar=-3&soort=sp-loop"></a>')),
            new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8')),
            new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8'))
        ),
        'no2' => array(
            new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8')),
            new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8')),
            new \Robth82\Dashboard\Widget\Widget(array('title' => 'Robs dashboard', 'content' => 'wtf8'))
        )
    );

    ?>

    <select id="select-beast" style="width: 300px" onchange="dashboardAddWidget(this);">
        <option value="">Voeg een widget toe</option>
        <?php

        $widgets = $dashboardCollection->getRegisteredWidgets();
        foreach ($widgets as $widget) {
            /** @var $widget \Robth82\Dashboard\Widget\Widget */
            echo '<option value="' . $widget->getTitle() . '">' . $widget->getTitle() . ' </option>';
        }
        ?>

    </select>
    <script>
        var select = jQuery('#select-beast').selectize({

            sortField: 'text'
        });
    </script>
    <br/>
    <?php
    $dashboard = new Dashboard($config);

    $template = $twig->loadTemplate('index.twig');
    echo $template->render(array('dashboard' => $dashboard));
    ?>


</section>

<script>
    $(function () {
        initDashboard();

    });
</script>
</body>
</html>
