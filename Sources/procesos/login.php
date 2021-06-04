<?php
require_once "db-conection.php";
session_start();

$email = $_GET['email'];
$password = $_GET['password'];

$sql = "SELECT * FROM usuario where email = '" . $email . "'";
    if($result = $mysqli->query($sql)) {
    if($result->num_rows != 1) {
        echo "1"; //codigo para email registrado
    } else {
        $row = $result->fetch_array();
        if(!password_verify($password, $row["password"])) {
            echo "2"; //codigo para contraseña incorrecta
        } else {
        $_SESSION["email"] = $email;
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["tipo"] = $row["tipo"];
        echo "3"; //codigo para inicio de sesión correcto
        }
    }
}
?>