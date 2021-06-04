<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);    
$sql = "insert into Categoria values ('".$_POST["catg"]."','')";
    if ($mysqli->query($sql) === TRUE) {
        echo "Agregado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    } else {
        echo "Hubo algun error <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    }
$mysqli->close();
?>