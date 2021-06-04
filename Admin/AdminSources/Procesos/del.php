<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');

$arreglo = array();
$tabla=$_GET["tabla"];
$model=$_GET["model"];
$consulta="delete from ".$tabla." where modeloAlfanumerico='".$model."'";
eliminarArticulo($model,$consulta,$tabla);
    function eliminarArticulo($articulo,$values,$tabla){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);    
        $sql = $values;
        if ($mysqli->query($sql) === TRUE) {
            echo "El articulo ".$articulo." ha sido eliminado "."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
            //$ruta="../Imagenes/Procesadores/".$articulo.".png";
            $ruta=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$articulo."/";
            if (file_exists($ruta)) {
                rmDir_rf($ruta);
                
            }
            
        } else {
            echo "Hubo un error al eliminar ".$articulo.": " . $mysqli->error."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $mysqli->close();
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
?>
