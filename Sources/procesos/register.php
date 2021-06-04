<?php
require_once "db-conection.php";
session_start();
$email = $_GET['email'];
$nombre = $_GET['nombre'];
$usuario = $_GET['usuario'];
$passwordConfirm = $_GET['passwordConfirm'];
$password = $_GET['password'];

$sql = "SELECT * FROM usuario where email = '" . $email . "'";
if($result = $mysqli->query($sql)) {
    if($result->num_rows != 0) {
        echo "1"; //codigo para email registrado
    } else {
        $sql2 = "SELECT * FROM usuario where usuario = '" . $usuario . "'";
        
        if($result2 = $mysqli->query($sql2)) {
            if($result2->num_rows != 0) {
                echo "2"; //codigo para usuario registrado
            } else {
                //insercion en bd
                $sql3 = "INSERT INTO usuario (email, password, nombre, usuario) VALUES (?, ?, ? ,?)";
                if($stmt = $mysqli->prepare($sql3)) {
                    $stmt->bind_param("ssss", $param_email, $param_password, $param_nombre, $param_usuario);
                    $param_email = $email;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);
                    $param_nombre = $nombre;
                    $param_usuario = $usuario;

                    if($stmt->execute()) {
                        $_SESSION["email"] = $email;
                        $_SESSION["nombre"] = $nombre;
                        $_SESSION["usuario"] = $usuario;
                        echo "3"; // Código para registro exitoso
                    } else {
                        echo "4"; //Código para error de DB
                    }
                } else {
                    echo "4"; //Código para error de DB
                }
            }
        }  else {
            echo "4"; //Código para error de DB
        } 
    } 
}
?>