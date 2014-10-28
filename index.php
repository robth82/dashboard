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
    <div>
        <div style="float:left"
        ">
        <select id="select-beast" style="width: 300px; z-index: 100;" onchange="dashboardAddWidget(this);">
        <option value="">Voeg een widget toe</option>
        <?php

        $widgets = $dashboardCollection->getRegisteredWidgets();
        foreach ($widgets as $widget) {
            /** @var $widget \Robth82\Dashboard\Widget\Widget */
            echo '<option value="' . $widget->getTitle() . '">' . $widget->getTitle() . ' </option>';
        }
        ?>

    </select>
    </div>

    <div style="float:right">
        <select id="select-dashboard" style="width: 300px; z-index: 100;" onchange="changeDashboard(this);">
            <?php
            $dashboards = array(
                'abcd123' => 'Dashboard 1',
                'abcd124' => 'Dashboard 2'
            );

            if (isset($_GET['dashboard'])) {
                $activeDashboard = $_GET['dashboard'];
            } else {
                $activeDashboard = key($dashboards);
            }


            foreach ($dashboards as $key => $name) {
                /** @var $widget \Robth82\Dashboard\Widget\Widget */
                $selected = ($activeDashboard == $key) ? 'selected' : '';
                echo '<option ' . $selected . ' value="' . $key . '">' . $name . ' </option>';
            }
            ?>

        </select>
    </div>
    </div>
    <div style="clear: both"></div>

    <script>
        jQuery('#select-dashboard').selectize({
            sortField: 'text'
        });
        var select = jQuery('#select-beast').selectize({
            sortField: 'text'
        });
    </script>
    <?php

    $dashboard = new Dashboard($activeDashboard);

    $template = $twig->loadTemplate('index.twig');
    echo $template->render(array('dashboard' => $dashboard));
    ?>


</section>

<script>
    jQuery(function () {
        initDashboard();
    });
</script>
</body>
</html>
