<?php 
    define('DB_SERVER', 'alethetwin.online');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'Ionos-db-2021');
    define('DB_NAME', 'found-it');
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 
	$usuario = $_GET['usuario'];
	// $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$sql = "DELETE FROM usuario WHERE usuario ='" . $usuario."'";
    if($result = $mysqli->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
?>