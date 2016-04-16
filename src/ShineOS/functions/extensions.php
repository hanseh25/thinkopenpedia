<?php

function callPluginController($folder, $plugin, $method, $ID) {

    include_once(plugins_path().'FamilyPlanning'.DS.'FamilyPlanning'.'Controller.php');
    $test = (new \plugins\FamilyPlanning\FamilyPlanningController)->testFunction();
    return $test;
}
