<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 $usuario = $_GET['usuario'];
 $reportado=$_GET['reportado'];
 $asunto =$_GET['asunto'];
 $descripcion = $_GET['descripcion'];

$sql = "INSERT INTO reportes (usuario, reportado, asunto, descripcion) VALUES (?, ?, ?, ?)";
if($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ssss", $param_usuario, $param_reportado, $param_asunto, $param_descripcion);
    $param_usuario = $usuario;
    $param_reportado = $reportado;
    $param_asunto = $asunto;
    $param_descripcion = $descripcion;

    if($stmt->execute()) {
        echo "enviado";
    } else {
        echo "4"; //Código para error de DB
    }
} else {
    echo "4"; //Código para error de DB
}
?>