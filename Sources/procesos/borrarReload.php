<?php
session_start();
if(isset($_SESSION["onReload"])) {
    $_SESSION["onReload"] = "";
}
?>