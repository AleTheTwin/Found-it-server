<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 
$o=$_POST["old"];  
$carpeta=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$o.'/';
$sql = "delete from ".$o;
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Hubo un error al: ".$mysqli->error." SQL: ".$sql."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    }
$sql = "drop table ".$o;
    if ($mysqli->query($sql) === TRUE) {
        if(file_exists($carpeta)){
            rmDir_rf($carpeta);
        }
        echo "Eliminado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    } else {
        echo "Hubo un error al: ".$mysqli->error." SQL: ".$sql."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
}
$sql = "delete from Categoria where Subcategoria='".$o."'";
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Hubo un error al: ".$mysqli->error." SQL: ".$sql."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
}

function rmDir_rf($carpeta){
    foreach(glob($carpeta . "/*") as $archivos_carpeta){             
      if (is_dir($archivos_carpeta)){
        rmDir_rf($archivos_carpeta);
      } else {
      unlink($archivos_carpeta);
      }
    }
    rmdir($carpeta);
   }
$mysqli->close();
?>
