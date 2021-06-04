<?php
session_start();

$count = 0;
if(isset($_SESSION["previous"])) {
    $historial = array();
    $historial = $_SESSION["previous"];
    $count =  count($historial);
    print_r($_SESSION["previous"]);
    unset($_SESSION["previous"][$count-1]);
    unset($_SESSION["previous"][$count-2]);
    print_r($_SESSION["previous"]);
}

?>