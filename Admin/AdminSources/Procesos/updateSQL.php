<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
$tabla=$_POST['tabla'];
$NCampos=0;
$Campos[]=array();
regresarCampos($tabla);
$i=0;
$select[]=array();
while($i<$NCampos){
    $select[$i]=$_POST[$Campos[$i]];
    $i++;
}
$update="update ".$tabla." set ";
$set="";
$i=0;
$where="where modeloAlfanumerico='".$_POST['oldkey']."'";
while($i<$NCampos-1){
    $set.=$Campos[$i]."='".$select[$i]."' ,";
    $i++;
}
$set.=$Campos[$i]."='".$select[$i]."' ";
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 
$sql = $update.$set.$where;
    if ($mysqli->query($sql) === TRUE) {
        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$_POST['oldkey'].'/';
        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }
        $nombre_Imagen=$_FILES['imagen']['name'];
        if (file_exists($carpeta_destino.$_POST['oldkey'].".png")) {
            rename ($carpeta_destino.$_POST['oldkey'].".png" , $carpeta_destino.$_POST['modeloAlfanumerico'].".png");
        }else{
            if(!$nombre_Imagen==""){
            move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_Imagen);
            rename ($carpeta_destino.$nombre_Imagen , $carpeta_destino.$_POST['modeloAlfanumerico'].".png");
            }
        }
        
        // Recibir imagen
        $nombre_Imagen=$_FILES['imagen']['name'];
        if(!$nombre_Imagen==""){
        //Ruta de la carpeta imagen
        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_Imagen);
        try{
        if(file_exists($carpeta_destino.$nombre_Imagen)){
            rename ($carpeta_destino.$nombre_Imagen , $carpeta_destino.$_POST['modeloAlfanumerico'].".png");
        }
        }catch(Exception $e){}
        //header("location: addProce.php");
        }
        try{
            
            rename($_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$_POST['oldkey'],$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$_POST['modeloAlfanumerico']);
        }catch(Exception $e){}
        echo "Actualizado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    } else {
        echo "No se pudo establecer conexion a base de datos <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
    }
$mysqli->close();

function regresarCampos($valor){
    $i=0;
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "SHOW COLUMNS FROM ".$valor."";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_array()){
                    $GLOBALS["Campos"][$i]=$row['Field'];
                   // echo $GLOBALS["Campos"][$i]."-";
                    $i++;
                }
                $GLOBALS["NCampos"]=$i;
            $result->free();
            }else{
                
            }
        } else{
            
        }
        $stmt->close();
    } 

$mysqli->close();
}
?>