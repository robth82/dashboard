<!doctype html>

<?php

use \Robth82\Dashboard\Dashboard;

include('vendor\autoload.php');

$config = array();

$dashboard = new Dashboard($config);


$loader = new Twig_Loader_Filesystem('twig');
$twig = new Twig_Environment($loader, array(
    //'cache' => 'twigCache'
    'cache' => false,
    'debug' => true,
));

$twig->addExtension(new Twig_Extension_Debug());

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
    <input type="button" value="Add widget (not working)" onClick="dashboardAddWidget();"/>
    <select id="select-beast" style="width: 300px" onchange="console.log(jQuery(this).val());">
        <option value="">Voeg een widget toe</option>
        <option value="test">testtest</option>
        <option value="test2">tes2</option>
    </select>
    <script>
        $('#select-beast').selectize({

            sortField: 'text'
        });
    </script>
    <br/>
    <?php

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

    $config = array(
        'no1' => array(
            //new \Robth82\Dashboard\Widget\TableWidget('Robs table', $test),
            //new \Robth82\Dashboard\Widget\TableWidget('Robs table', $test),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8'),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8'),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8'),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8')
        ),
        'no2' => array(
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8'),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8'),
            new \Robth82\Dashboard\Widget\Widget('Robs dashboard', 'wtf8')
        )
    );

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
