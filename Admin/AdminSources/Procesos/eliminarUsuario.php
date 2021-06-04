<?php 
    define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'root1234');
    define('DB_NAME', 'found-it-db');
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