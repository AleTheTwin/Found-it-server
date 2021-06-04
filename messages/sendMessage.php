<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
$remitente = $_GET['remitente'];
$conversacion=$_GET['conversacion'];
$mensaje = $_GET['mensaje'];
$hora = $_GET['hora'];

$sql = "INSERT INTO mensaje (remitente, id_conversacion, hora, mensaje) VALUES (?, ?, ? ,?)";
if($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("siss", $param_remitente, $param_id_conversacion, $param_hora, $param_mensaje);
    $param_remitente = $remitente;
    $param_id_conversacion = $conversacion;
    $param_hora = $hora;
    $param_mensaje = $mensaje;

    if($stmt->execute()) {
        echo "enviado";
    } else {
        echo "4"; //Código para error de DB
    }
} else {
    echo "4"; //Código para error de DB
}
?>