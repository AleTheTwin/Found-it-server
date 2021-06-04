<?php 
$usuario = "";
// require_once "../db-conection.php";
session_start();

?>
<div  style="display: grid;justify-content:center; text-align: center;">
    <h2 class="titulo">Listado de Reportes</h2>
    <section id="seccion">
        <div >
            <div >
                <div class="cards-coment" style="min-width: 500px" id="cajonComentarios">
                    
                    <?php
                    echo cargarReportes();
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
function cargarReportes() {
    $respuesta = "";
    $revisado = "";
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
    $sql = "SELECT id, asunto, usuario, reportado, revisado FROM reportes";
    if($result = $mysqli->query($sql)) {
        if($result->num_rows > 0) {
            while($row = $result->fetch_array()){
                if($row['revisado'] == "1") {
                    $revisado = "background-color: #606060";
                } else {
                    $revisado = "";
                }
                $respuesta .= '
                <div class="coment " style="margin-top: 10px;' . $revisado . '">
                    <div class="contenido-texto-card">
                        <h4 style="cursor: pointer;" onclick="loadReporte(' . "'" . $row['id'] . "')" . '">Reporte ' . $row['id'] . '</h4>
                        <p>De: <a onclick="loadPerfilVentas(' . "'" . $row['usuario'] . "')" . '">' . $row['usuario'] . '</a> -- Usuario reportado: <a onclick="loadPerfilVentas(' . "'" . $row['reportado'] . "')" . '">' . $row['reportado'] . '</a></p>
                        <p>Asunto: ' . $row['asunto'] . '</p>
                    </div>
                </div>
                ';
            }
            return $respuesta;
        } else {
            echo "No hay reportes";
        } 
    } else {
        return "4";
    }
}
?>
