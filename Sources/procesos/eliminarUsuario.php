<?php 
	$usuario = $_GET['usuario'];
	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$sql = "DELETE FROM usuario WHERE nombre ='" . $usuario."'";
    if($result = $mysqli->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
?>