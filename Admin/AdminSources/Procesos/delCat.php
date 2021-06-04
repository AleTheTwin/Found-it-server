<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
deleteCategorias($_POST['metaCategoria']);
?>
<?php
function deleteCategorias($cat){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
        echo "Hubo un error en conexion <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    }
    $valor="'".$cat."'";
    $sql="SELECT Subcategoria from Categoria where Categoria=".$valor;
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $categoria =$row['Subcategoria'];
                    borrarSubCategorias($categoria);
                }
            $result->free();
            }else{
                
            }
        } else{
            
        }
       
    } 
$stmt->close();
$sql = "delete from Categoria where Categoria='".$cat."'";
    if ($mysqli->query($sql) === TRUE) {
    } else {
        echo "Hubo un error al borrar en Categoria: " . $mysqli->error;
    }
$mysqli->close();
}
function borrarSubCategorias($categoria){
    if($categoria!=''){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$categoria.'/';   
        $sql = "drop table ".$categoria;
        if ($mysqli->query($sql) === TRUE) {
            if(file_exists($carpeta)){
                rmDir_rf($carpeta);
            }
            echo "Eliminado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        } else {
            echo "Hubo un error al borrar tabla: " . $mysqli->error. "SQL: ".$sql."<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql = "delete from Articulo where categoria='".$categoria."'";
        if ($mysqli->query($sql) === TRUE) {
            echo "Eliminado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        } else {
            echo "Hubo un error al borrar en articulo: " . $mysqli->error;
        }
        $mysqli->close();
    }
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