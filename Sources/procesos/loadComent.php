<?php
$return = "";
$return .= '';
?>
<?php 
    session_start();
    $last_cmt = "";
    if(isset($_SESSION["last-cmt"])) {
        $last_cmt = $_SESSION["last-cmt"];
    }
    require_once "db-conection.php";
    $articulo = $_GET["articulo"];
    $refill = $_GET["refill"];
    //$_SESSION["conversacion"] = $conversacion;

    $sql = "SELECT * from comentarios where alfanumerico='" . $articulo . "'";
    if($result = $mysqli->query($sql)) {
        if($result->num_rows > 0) {
            $num_rows = $result->num_rows;
            $i=1;
            while($row = $result->fetch_array()) {
                if($i == $num_rows) {
                    $_SESSION["last-cmt"] = $row["id"];
                }
                    $return .= '
                    <div class="coment">
                    	'. get_image($row['usuario']) .' 
                        	<div class="contenido-texto-card">
                            	<h4>'.$row['usuario'] .'</h4>
                            	<p>'.$row['comentario'].'
                            	</p>
                       		</div>
                	</div>                               
                    ';
                
                $i++;
                
            }
        }
    } else {
        
    }
    // $return .= '</div>';
    if(isset($_SESSION["last-cmt"])) {
        if($last_cmt != $_SESSION["last-cmt"] || $refill == "true") {
            echo $return;
        } else {
            echo "1";
        }
    } else {
        echo $return;
    }

    function get_image($usuario) {
        $filename = "/Found-it/profile/img/" . $usuario . ".png";
        if(file_exists("../" . $filename)) {
            return '<img src="' . $filename .  '" alt="">';
        } else {
            return '<img src="/Found-it/profile/img/default.png" alt="">';
        }
        
    }
?>