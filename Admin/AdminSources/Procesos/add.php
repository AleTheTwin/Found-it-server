<?php
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
$tabla=$_POST['tabla'];
if($tabla=="Procesador"){
    $nombre=$_POST['nombre'];
    $mod=$_POST['modelo'];
    $modalf=$_POST['modeloAlfanumerico'];
    $linea=$_POST['linea'];
    $nucleos=$_POST['nucleos'];
    $hilos=$_POST['hilos'];
    $marca=$_POST['marca'];
    $socket=$_POST['socket'];
    $gen=$_POST['generacion'];
    $fre=$_POST['frecuencia'];
    $precio=$_POST['precio'];
    $arq=$_POST['arquitectura'];
    $cache=$_POST['cache'];
    $tipom=$_POST['tipomemoria'];
    $maxm=$_POST['maxmemoria'];
    $c=$_POST['consumo'];
    $des=$_POST['descripcion'];
    $r=$_POST['reseña'];

    agregarProcesador($tabla,$mod,$modalf,$nombre,$nucleos,$hilos,$des,$r,$precio,$gen,$socket,$fre,$marca,$linea,$tipom,$maxm,$cache,$c,$arq);
}else{
    $modalf=$_POST['modeloAlfanumerico'];
    $NCampos=0;
    $Campos[]=array();
    regresarCampos($tabla);
    $imagen=$modalf.".png";
    $i=0;
    $valores=array();
    agregar($tabla,$modalf);
}
function agregarProcesador($tabla,$mod,$modalf,$nombre,$nucleos,$hilos,$des,$r,$precio,$gen,$socket,$fre,$marca,$linea,$tipom,$maxm,$cache,$c,$arq){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO Procesador (modelo,modeloAlfanumerico,nombre,nucleos,hilos,descripcion,reseña,precio,generacion,zocalo,frecuencia,marca,linea,tipoMemoria,maximoMemoria,memoriaCache,consumo,arquitectura) VALUES ('".$mod."','".$modalf."','".$nombre."','".$nucleos."','".$hilos."','".$des."','".$r."','".$precio."','".$gen."','".$socket."','".$fre."','".$marca."','".$linea."','".$tipom."','".$maxm."','".$cache."','".$c."','".$arq."')";
    
    if($stmt = $mysqli->prepare($sql)){
            if($stmt->execute()){
                // Recibir imagen
                $nombre_Imagen=$_FILES['imagen']['name'];
                $tipo_Imagen=$_FILES['imagen']['type'];
                $size_Imagen=$_FILES['imagen']['size'];
                //Ruta de la carpeta imagen
                $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$modalf;
                if (!file_exists($carpeta_destino)) {
                    mkdir($carpeta_destino, 0777, true);
                }
                echo "Agregado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
                move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.'/'.$nombre_Imagen);
                rename ($carpeta_destino.'/'.$nombre_Imagen , $carpeta_destino.'/'.$modalf.".png");
                //header("location: addProce.php");
                exit();
            }else{
                echo "No se pudo agregar a base de datos <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
            }
            $stmt->close();
        }else{
            echo "No se pudo establecer conexion a base de datos <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
    $mysqli->close();
}
function agregar($tabla,$modalf){
    $valoresI="";
    $contador=0;
    $tipos="";
    $numeroCampos=$GLOBALS["NCampos"];
    $valores="";
    foreach ($GLOBALS["Campos"] as &$valor) {
        $valoresI=$valoresI.$valor;
        $valores=$valores."'".$_POST[$valor]."'";
        $contador++;
        if($numeroCampos==$contador){

        }else{
            $valoresI=$valoresI.","; 
            $valores=$valores.","; 
        }
    }
    unset($valor);

    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "INSERT INTO ".$tabla." (".$valoresI.") VALUES (".$valores.")";
    if($stmt = $mysqli->prepare($sql)){
            if($stmt->execute()){
                // Recibir imagen
                $nombre_Imagen=$_FILES['imagen']['name'];
                $tipo_Imagen=$_FILES['imagen']['type'];
                $size_Imagen=$_FILES['imagen']['size'];
                //Ruta de la carpeta imagen
                $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Found-it/Articulos/Imagenes/'.$tabla.'/'.$modalf;
                if (!file_exists($carpeta_destino)) {
                    mkdir($carpeta_destino, 0777, true);
                }
                echo "Agregado con exito <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
                move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.'/'.$nombre_Imagen);
                rename ($carpeta_destino.'/'.$nombre_Imagen , $carpeta_destino.'/'.$modalf.".png");
                //header("location: addProce.php");
                exit();
            }else{
                echo "No se pudo agregar a base de datos <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
            }
            $stmt->close();
        }else{
            echo "No se pudo establecer conexion a base de datos <a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
    $mysqli->close();
}
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
