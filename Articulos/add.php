<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
try{
    $articulo=$_GET["articulo"];
    $usuario = $_GET['usuario'];
        
        /*$NCampos=0;
        $Campos[]=array();
        regresarCampos($table);
        $i=0;
        $valores=array();*/
}catch(Exception $e){
    
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Found-it/Sources/CSS/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
   <title>Found-it</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
  </head>
<body style="background: #8e9eab;
    background: -webkit-linear-gradient(to top, #8598d4, #ffffff);
    background: linear-gradient(to top, #b0c0f3, #ffffff);">
    <form action="ventas.php" method="post" enctype="multipart/form-data">
    <input type='text' name="articulo" value='<?php echo $articulo?>'style='display:none;'>
    <input type='text' name="usuario" value='<?php echo $usuario?>'style='display:none;'>
    <h2 class="titulo centrado">Agregando articulo</h2>
        <section class="centrado">
            <div class="contenido-textos">

                <input class="titulo" type="text" name="precio" placeholder="Precio">                
                <select class="titulo" name="estado">
                    <option>Nuevo</option>
                    <option>Usado</option>
                    <option>Descompuesto</option>
                </select>
                
            </div>
        </section>
        <section class="centrado">
            <button type="submit" class="btn">Agregar</button>
        </section>
    </form>
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
</body>
<script src="/Found-it/js/main.js"></script>
   
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