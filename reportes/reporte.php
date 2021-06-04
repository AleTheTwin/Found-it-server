<?php 
$usuario = "";
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
session_start();
$id = $_GET["id"];
?>
<div  style="display: grid;justify-content:center; text-align: center;">
    <h2 class="titulo"> Reporte <?php echo $id;?></h2>
    <section id="seccion">
        <div >
            <div >
                <div class="cards-coment" style="min-width: 500px" id="cajonComentarios">
                    
                    <div class="coment " style="margin-top: 10px;' . $revisado . '">
                    <?php
                    $sql = "SELECT * FROM reportes WHERE id = '" . $id . "'";
                    if($result = $mysqli->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()){
                                echo '<div class="contenido-texto-card">
                                    <h4 >Reporte ' . $row['id'] . '</h4>
                                        <p>De: <a>' . $row['usuario'] . '</a> -- Usuario reportado: <a>' . $row['reportado'] . '</a></p>
                                    <p>Asunto: ' . $row['asunto'] . '</p>
                                    <br>
                                    <p>Descripción: ' . $row['descripcion'] . '
                                </div>';
                                echo '<div>';
                                echo '<div id="opcionesReporte">';
                                $enviarMensaje = ' <a class="enviar" onclick="enviarMensaje(' . "'" . $_SESSION["usuario"] . "','" . $row['reportado'] . "'" .')">Enviar mensaje</a>';
                                $reportar = ' <a class="report" id="eliminar" onclick="eliminarUsuario(' . "'" . $row['reportado'] . "'" . ')">Eliminar</a>';
                                echo $enviarMensaje . $reportar;
                                echo '</div>';
                            }
                        } else {
                            echo "No hay reportes";
                        } 
                    } else {
                        return "4";
                    }
                    $sql = "UPDATE reportes SET revisado = 1 WHERE id = ?";
                    if($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("s", $param_id);
                        $param_id = $id;

                        if($stmt->execute()) {

                        } else {
                            
                        }
                    } else {
                        
                    }
                    
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
