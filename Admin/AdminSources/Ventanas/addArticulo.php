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
    $table=$_GET["catg"];
        $NCampos=0;
        $Campos[]=array();
        regresarCampos($table);
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
            <form style="margin-top: 80px;" action="../Procesos/add.php" method="post" enctype="multipart/form-data">
                <input type='text' name="tabla" value='<?php echo $table?>'style='display:none;'>
                <h2 class="titulo centrado">Agregando <?php echo $table?></h2>
                    <section class="centrado">
                        <div class="contenido-textos">
                            <input class="titulo" type="text" name="nombre" placeholder="Nombre">
                            <input class="titulo" type="text" name="modeloAlfanumerico" placeholder="Modelo Alfanumerico">
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
                            <textarea name="descripcion" rows="20" cols="30"></textarea>
                        </div>
                        <div class="contenido-textos">
                            <h3><span>R</span>eseña</h3>
                            <textarea name="reseña" rows="20" cols="30"></textarea>
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
                    <button type="submit" class="btn">Agregar</button>
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

function imprimirValores(){
    if($GLOBALS["table"]=="Procesador"){
        echo '<div class="contenido-tabla">
        <table class="tabla">
        <tr>
            <td>Modelo:</td>
            <td><input type="text" name="modelo" placeholder="Modelo"></td>
        </tr>
        <tr>
            <td>Linea:</td>
            <td><input type="text" name="linea" placeholder="Linea"></td>
        </tr>
        <tr>
            <td>Marca:</td>
            <td><select class="form-select" name="marca">
                <option selected>Marca...</option>
                <option value="AMD">AMD</option>
                <option value="Intel">Intel</option>
            </select></td>
        </tr>
        <tr>
            <td>Socket:</td>
            <td><input type="text" name="socket" placeholder="Socket"></td>
        </tr>
        <tr>
            <td>Generacion:</td>
            <td><input type="text" name="generacion" placeholder="Generacion"></td>
        </tr>
        <tr>
            <td>Frecuencia:</td>
            <td><input type="number" step="0.01" name="frecuencia" placeholder="Frecuencia"></td>
        </tr>
        <tr>
            <td>Arquitectura:</td>
            <td><input type="text" name="arquitectura" placeholder="Arquitectura"></td>
        </tr>
        </table>
    </div>
    <div class="contenido-tabla">
        <table class="tabla">
        <tr>
            <td>Nucleos:</td>
            <td><input type="number" name="nucleos" placeholder="#Nucleos"></td>
        </tr>
        <tr>
            <td>Hilos:</td>
            <td><input type="number" name="hilos" placeholder="#Hilos"></td>
        </tr>
        <tr>
            <td>Tipo de memoria:</td>
            <td><select name="tipomemoria">
                <option selected>Tipo memoria</option>
                <option value="DDR1">DDR1</option>
                <option value="DDR2">DDR2</option>
                <option value="DDR3">DDR3</option>
                <option value="DDR4">DDR4</option>
            </select></td>
        </tr>
        <tr>
            <td>Memoria max:</td>
            <td><input type="number" name="maxmemoria" placeholder="Maximo memoria"></td>
        </tr>
        <tr>
            <td>Cache:</td>
            <td><input type="text" name="cache" placeholder="Cache"></td>
        </tr>
        <tr>
            <td>Consumo:</td>
            <td><input type="number" name="consumo" placeholder="Consumo"></td>
        </tr>
        <tr>
            <td>Precio de salida:</td>
            <td><input type="number" name="precio" placeholder="Precio"></td>
        </tr>
        </table>
    </div>';
    }else{
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
            if($mayuscula=="Marca" && $GLOBALS["table"]=='GPU'){
                echo '<td><select name="'.$GLOBALS["Campos"][$i].'">
                    <option selected>'.$mayuscula.'</option>
                    <option value="RADEON">RADEON</option>
                    <option value="NVIDIA">NVIDIA</option>
                    <option value="INTEL">INTEL</option>
                </select>'; 
            }else{
                echo "<td>".'<input type="text" name="'.$GLOBALS["Campos"][$i].'" placeholder="'.$mayuscula.'">'."</td></tr>"; 
            }
            
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
}


?>