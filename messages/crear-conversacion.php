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
$destinatario = $_GET['destinatario'];
$tienenConversacion = false;

$sql = "SELECT * FROM conversacion where remitente = '" . $remitente . "'" ;
if($result = $mysqli->query($sql)) {
    if($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        while($row = $result->fetch_array()) {
            // print_r($row);
            if($row['destinatario'] == $destinatario) {
                $tienenConversacion = true;
                break;
            } 
        }
    } else {

    }
} else {
    echo "-1";
}

$sql = "SELECT * FROM conversacion where remitente = '" . $destinatario . "'" ;
if($result = $mysqli->query($sql)) {
    if($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        while($row = $result->fetch_array()) {
            // print_r($row);
            if($row['destinatario'] == $remitente) {
                $tienenConversacion = true;
                break;
            } 
        }
    } else {
        
    }

} else {
    echo "-1";
}

if(!$tienenConversacion) {
    $sql3 = "INSERT INTO conversacion (remitente, destinatario) VALUES (?, ?)";
    if($stmt = $mysqli->prepare($sql3)) {
        $stmt->bind_param("ss", $param_remitente, $param_destinatario);
        $param_remitente = $remitente;
        $param_destinatario = $destinatario;

        if($stmt->execute()) {
            echo "1"; // Código para registro exitoso
        } else {
            echo "-1"; //Código para error de DB
        }
    } else {
        echo "-1"; //Código para error de DB
    }
}

$sql = "SELECT * FROM conversacion where remitente = '" . $remitente . "'" ;
if($result = $mysqli->query($sql)) {
    if($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        while($row = $result->fetch_array()) {
            // print_r($row);
            if($row['destinatario'] == $destinatario) {
                echo $row["id"];
                break;
            } 
        }
    } else {

    }
} else {
    echo "-1";
}

$sql = "SELECT * FROM conversacion where remitente = '" . $destinatario . "'" ;
if($result = $mysqli->query($sql)) {
    if($result->num_rows > 0) {
        $num_rows = $result->num_rows;
        while($row = $result->fetch_array()) {
            // print_r($row);
            if($row['destinatario'] == $remitente) {
                echo $row["id"];
                break;
            } 
        }
    } else {
        
    }

} else {
    echo "-1";
}

?>