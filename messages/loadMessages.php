
<?php
$return = "";
$return .= '';
?>
<?php 
    session_start();
    $last_msg = "";
    if(isset($_SESSION["last-msg"])) {
        $last_msg = $_SESSION["last-msg"];
    }
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
    $remitente = $_GET["remitente"];
    $conversacion = $_GET["conversacion"];
    $refill = $_GET["refill"];
    $_SESSION["conversacion"] = $conversacion;
    $sql = "SELECT * from mensaje where id_conversacion='" . $conversacion . "'";
    if($result = $mysqli->query($sql)) {
        if($result->num_rows > 0) {
            $num_rows = $result->num_rows;
            $i=1;
            $id="";
            while($row = $result->fetch_array()) {
                if($i == $num_rows) {
                    $_SESSION["last-msg"] = $row["id"];
                    $id="bottom";
                }
                if($row['remitente'] == $remitente) {
                    $return .= '
                    <div  id="' . $id . '" class="chatbox darker">
                        ' . get_image($row["remitente"]) .'
                        <p>' . $row["mensaje"] . '</p>
                        <span class="time-left">' . $row["hora"] . '</span>
                    </div>                                
                    ';
                } else {
                    $return .= '
                    <div id="' . $id . '" class="chatbox">
                        ' . get_image_left($row["remitente"]) .'
                        <p>' . $row["mensaje"] . '</p>
                        <span class="time-right">' . $row["hora"] . '</span>
                    </div>
                    ';
                }
                
                $i++;
                
            }
        }
    } else {
        
    }
    if(isset($_SESSION["last-msg"])) {
        if($last_msg != $_SESSION["last-msg"] || $refill == "true") {
            echo $return;
        } else {
            echo "1";
        }
    } else {
        echo $return;
    }

    function get_image($usuario) {
        $filename = "/Found-it/profile/img/" . $usuario . ".png";
        if(1==1) {
            return '<img alt="Avatar" onclick="' . 'loadPerfilVentas('. "'" . $usuario . "'" . ')" class="right" style="width:100%;" src="' . $filename . '">';
        } else {
            return '<img alt="Avatar" onclick="' . 'loadPerfilVentas('. "'" . $usuario . "'" . ')" class="right" style="width:100%;" src="/Found-it/profile/img/default.png">';
        }
        
    }

    function get_image_left($usuario) {
        $filename = "/Found-it/profile/img/" . $usuario . ".png";
        if(1==1) {
            return '<img alt="Avatar" onclick="' . 'loadPerfilVentas('. "'" . $usuario . "'" . ')" style="width:100%;" src="' . $filename . '">';
        } else {
            return '<img alt="Avatar" onclick="' . 'loadPerfilVentas('. "'" . $usuario . "'" . ')" style="width:100%;" src="/Found-it/profile/img/default.png">';
        }
    }
    
    
?>
    