<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 26-10-14
 * Time: 23:54
 */

include('bootstrap.php');

\Robth82\Dashboard\Helper::renderDashboard($twig, $dashboardCollection, $_POST['title']);

