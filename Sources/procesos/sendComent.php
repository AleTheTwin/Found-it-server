<?php
require_once "db-conection.php";
 $articulo = $_GET['articulo'];
 $usuario=$_GET['usuario'];
 $comentario = $_GET['comentario'];

$sql = "INSERT INTO comentarios (alfanumerico, usuario, comentario) VALUES (?, ?, ?)";
if($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("sss", $param_articulo, $param_usuario, $param_comentario);
    $param_articulo = $articulo;
    $param_usuario = $usuario;
    $param_comentario = $comentario;

    if($stmt->execute()) {
        echo "enviado";
    } else {
        echo "4"; //Código para error de DB
    }
} else {
    echo "4"; //Código para error de DB
}
?>

