<?php
require_once "db-conection.php";
$metodo = $_GET["metodo"];
if($metodo=="guardar") {
    $reseñador = $_GET['reseñador'];
    $reseñado = $_GET['reseñado'];
    $reseña = $_GET['reseña'];
    $rate = $_GET['rate'];
    $sql = "INSERT INTO reseña (reseñador, reseña, reseñado, rate) VALUES (?, ?, ?, ?)";
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssss", $param_reseñador, $param_reseña, $param_reseñado, $param_rate);
        $param_reseñador = $reseñador;
        $param_reseña = $reseña;
        $param_reseñado = $reseñado;
        $param_rate = $rate;

        if($stmt->execute()) {
            echo "1"; 
        } else {
            echo "4"; 
        }
    } else {
        echo "4"; 
    }
} else if($metodo=="cargar"){
    $reseñado = $_GET['reseñado'];
    $sql = "SELECT * FROM reseña where reseñado = '" . $reseñado . "'";
    if($result = $mysqli->query($sql)) {
        if($result->num_rows == 0) {
            echo "No se encontraron reseñas"; 
        } else {
            while($row = $result->fetch_array()) {
                echo '
                <div class="cards-coment">
                    <div class="coment" style="margin:5px;">
                        <img src="img/' . $row['reseñador'] . '.png" alt="">
                        <div class="contenido-texto-card">
                            <h4>' . $row['reseñador'] . '</h4>
                            <h5>';
                                for($i = 0; $i<$row['rate']; $i++) {
                                    echo '<i class="material-icons md-15 icon">star</i>';
                                }
                                for($i = $row['rate']; $i<5; $i++) {
                                    echo '<i class="material-icons md-15 icon">star_border</i>';
                                }
                            echo '
                                </h5>
                            <p>' . $row['reseña'] . '</p>
                        </div>
                    </div>
                </div>';
            }
            
        } 
    }
}






?>