<?php
session_start();
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');

if($_SESSION["tipo"]!=1){
    echo '
    <script>
        url = "../../../index.php";
        location.href =url;    
    </script>
    ';
}
try{
    $recuperado=$_GET["catg"];
    $k=0;
    $categoria="";
    $modelo="";
    $nombre="";
    $resena="";
    $descripcion="";
    while($recuperado[$k]!="/"){
        $categoria.=$recuperado[$k];
        $k++;
    }
    $k++;
    while($k<strlen($recuperado)){
        $modelo.=$recuperado[$k];
        $k++;
    }
    $table=$categoria;
        $NCampos=0;
        $Campos[]=array();
        $select[]=array();
    
        regresarCampos($table);
        obtenerValores();
        $i=0;
        $valores=array();
}catch(Exception $e){
    echo '
    <script>
        url = "../../admin.php";
        location.href =url;    
    </script>
    ';
}
?>

<!DOCTYPE html >
<html lang="es"style="Background: #ffffff;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    
    <link rel="stylesheet" href="/Found-it/Sources/CSS/estilos.css">
    <?php include '../../../Navbar/NavHead.php'?>
    <link rel="stylesheet" href="../../../Articulos/CSS/estilos.css">
    <link rel="stylesheet" href="AdminSources/CSS/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
</head>
    <body >
    <?php include '../../../Navbar/Navbar.php';?>
        <section style="margin-top: 80px;" id="contenido">
        <form style="margin-top: 80px;" action="../Procesos/updateSQL.php" method="post" enctype="multipart/form-data">
            <input type='text' name="tabla" value='<?php echo $table;?>'style='display:none;'>
            <input type='text' name="oldkey" value='<?php echo $modelo;?>'style='display:none;'>
            <h2 class="titulo centrado">Modificando <?php echo $table;?><a href="../Procesos/del.php?model=<?php echo $modelo;?>&tabla=<?php echo $table;?>"class="btn" style="    
            background: red;
            border-color: #ff0000;
            width: 100%;"
            >Eliminar</a></h2>
                <section class="centrado">
                    <div class="contenido-textos">
                        <input class="titulo" type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>">
                        <input class="titulo" type="text" name="modeloAlfanumerico" placeholder="Modelo Alfanumerico" value="<?php echo $modelo;?>">
                        <div >
                            <label >Imagen(.png):</label>
                            <input type="file" name="imagen" id="imagen" size="20" placeholder="imagen">
                            <div id="Message">
                            <span class="tag"></span>
                            </div>
                        </div>
                        
                    </div>
                </section>
                
                <section class="contenedor about">
                <div class="contenedor-about">
                    <div id="imagePreview">
                    
                    </div>
                    <div class="contenido-textos">
                        <h3><span>D</span>escripcion</h3>
                        <textarea name="descripcion" rows="20" cols="30"><?php echo $descripcion;?></textarea>
                    </div>
                    <div class="contenido-textos">
                        <h3><span>R</span>eseña</h3>
                        <textarea name="reseña" rows="20" cols="30"><?php echo $resena;?></textarea>
                    </div>
                </div>
                </section>
                <section class="Caracteristicas">
                    <div class="contenedor">
                        <h2 class="titulo">Especificaciones</h2>
                        <div class="contenido-tablas">
                            <?php imprimirValores()?>
                        </div>
                    </div>
                </section>
                <section class="centrado">
                <button type="submit" class="btn">Actualizar</button>
                </section>
            </form>
        </section>
        <footer>
            <div class="contenedor-footer">
                <div class="content-foo">
                    <h4>Phone</h4>
                    <p>111-111-1111</p>
                </div>
                <div class="content-foo">
                    <h4>Email</h4>
                    <p>example@ejem.com</p>
                </div>
                <div class="content-foo">
                    <h4>Location</h4>
                    <p>Direccion,calle,numero</p>
                </div>
            </div>
            <h2 class="titulo-final">&copy;Found-it</h2>
        </footer>
        <script src="/Found-it/Sources/JS/main.js"></script>
    </body>
    <?php 
    if(isset($_SESSION["email"])) {
        include "../../../messages/messages.php";
      }
    include '../../../Navbar/NavScript.php';
    
    
    ?>
    
</html>
<?php
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
function obtenerValores(){
    
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "select * from ".$GLOBALS["table"]." where modeloAlfanumerico='".$GLOBALS["modelo"]."'";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_array()){
                    while($i<$GLOBALS["NCampos"]){
                        $GLOBALS["select"][$i]=$row[$GLOBALS["Campos"][$i]];
                        if($GLOBALS["Campos"][$i]=="descripcion"){
                            $GLOBALS["descripcion"]=$GLOBALS["select"][$i];
                            //echo "1";
                        }
                        if($GLOBALS["Campos"][$i]=="reseña"){
                            $GLOBALS["resena"]=$GLOBALS["select"][$i];
                            //echo "2";
                        }
                        if($GLOBALS["Campos"][$i]=="nombre"){
                            $GLOBALS["nombre"]=$GLOBALS["select"][$i];
                            //echo "3";
                        }
                        $i++;
                    }
                }
            $result->free();
            }else{
                
            }
        } else{
            
        }
        $stmt->close();
    } 
    $mysqli->close();
}
function imprimirValores(){

    $tablas=$GLOBALS["NCampos"]-4;
    $segunda=$tablas+1;
    $segunda=$segunda/2;
    $mayuscula="";
    $i=0;
    $j=0;
    //echo $tablas;
    //echo $segunda;
    while($j<$tablas){
        if($j==0){
            echo '<div class="contenido-tabla"><table class="tabla">';  
        }
        if($GLOBALS["Campos"][$i]=="descripcion" || $GLOBALS["Campos"][$i]=="reseña"|| $GLOBALS["Campos"][$i]=="nombre"|| $GLOBALS["Campos"][$i]=="modeloAlfanumerico"){
        $i++;
        }else{
            $mayuscula=$GLOBALS["Campos"][$i];
            $mayuscula[0]=strtoupper ( $mayuscula[0]);
            echo "<tr><td>".$mayuscula.":</td>";
            echo "<td>".'<input type="text" name="'.$GLOBALS["Campos"][$i].'" placeholder="'.$mayuscula.'" value="'.$GLOBALS["select"][$i].'">'."</td></tr>";
            $i++;$j++; 
            if($j+.5==$segunda||$j==$segunda){
                echo '</table></div>';
                echo '<div class="contenido-tabla"><table class="tabla">';  
            }
        }     
        
    }
    echo '</table></div>';
    $j=0;
    
}


?>
