<?php
session_start();
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
    $table=$_GET["catg"];
    $nombre="";
    $mod="";
    $modeloalfanumerico=$_GET["model"];
    $marca="";
    $des="";
    $r="";
    $NCampos=0;
    $Campos[]=array();
    regresarCampos($table);
    $imagen=$modeloalfanumerico.".png";
    $i=0;
    $valores=array();
    regresarvalores($table,$modeloalfanumerico);
    $comentario;
    

$busqueda=$_GET["catg"];
$model=array();
$name=array();
$cat=array();
$resultados=0;
consultaCategoria($busqueda);
?>
<?php

function cargarComentarios(){
	$modeloalfanumerico=$_GET["model"];


	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$sql = "SELECT * from comentarios where alfanumerico='" . $modeloalfanumerico . "'";
    if($result = $mysqli->query($sql)) {
        if($result->num_rows > 0) {
            while($row = $result->fetch_array()) {
                echo '
                    <div class="coment">
                    	'. get_image($row['usuario']) .'
                        	<div class="contenido-texto-card">
                            	<h4 style="cursor: pointer;" onclick="loadPerfilVentas(' . "'" . $row['usuario'] . "')" . '">'.$row['usuario'] .'</h4>
                            	<p>'.$row['comentario'].'
                            	</p>
                       		</div>
                	</div>                               
                ';    
                $comentario=$row['id'];
            }
        }
    } else {
        echo "Error";
    }
}
function get_image($usuario) {
    $filename = "/Found-it/profile/img/" . $usuario . ".png";
    if(file_exists("/Found-it/profile/" . $filename)) {
        return '<img src="' . $filename.'"alt="">';
    } else {
        return '<img src="/Found-it/profile/img/default.png" alt="">';
    }
    
}
function regresarRelacionados($search){
    consultaCategoria($search);
    imprimirResultados();
    /*
                <div class="imagen-port">
                    <img src="../Sources/vacio.png" alt="">
                    <div class="hover-galeria">
                        <img src="/Found-it/Articulos/sources/Target.png" alt="">
                        <p>Ver...</p>
                    </div>
                </div>
    */
}
function imprimirResultados(){
    if($GLOBALS["resultados"]==0){
      echo '<div class="imagen-port">
                <img src="../Sources/vacio.png" alt="">
                    <div class="hover-galeria">
                    <img src="/Found-it/Articulos/sources/Target.png" alt="">
                    <a href="#">Sin resultados</a>
                </div>
            </div>';
    }else{
        $i=0;
        $ruta="";
        
        foreach ($GLOBALS["model"] as &$valor) {
            if($i==4){
                break;
            }else{
                if($GLOBALS["modeloalfanumerico"]==$GLOBALS["model"][$i]){}else{
                    $filename='../Articulos/Imagenes/'.$GLOBALS['cat'][$i].'/'.$valor.'/'.$valor.'.png';
                    if(file_exists($filename)) {
                    } else {
                        $filename="../Sources/vacio.png";
                    }
                    echo '<div class="imagen-port">
                    <img src="'.$filename.'" alt="'.$valor.' No se encontro foto" style="height=100%; width=100%;">
                            <a href="../Articulos/Articulo.php?catg='.$GLOBALS["cat"][$i].'&model='.$GLOBALS["model"][$i].'" >
                                <div class="hover-galeria">
                                    <img src="/Found-it/Articulos/sources/Target.png" alt="No se encontro foto'.$valor.'.png">
                                    
                                    <p>'.$valor.'</p>
                                    <p>'.$GLOBALS["name"][$i].'</p>
                                    <p>'.$GLOBALS["cat"][$i].'</p>
                                </div>
                            </a>
                        </div>';
                }
                
            }
            $i++;
        }
        unset($valor);
    }
}
function consultaCategoria($search){
    $i=0;
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql="SELECT DISTINCT Articulo.nombre, Articulo.categoria, Articulo.modeloAlfanumerico
        FROM Articulo
        INNER JOIN (SELECT modeloAlfanumerico
        FROM Etiqueta
        WHERE etiqueta = '".$search."')as consulta
        ON Articulo.modeloAlfanumerico=consulta.modeloAlfanumerico;";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                
                while($row = $result->fetch_array()){
                    $GLOBALS["model"][$i]=$row['modeloAlfanumerico'];
                    $GLOBALS["name"][$i]=$row['nombre'];
                    $GLOBALS["cat"][$i]=$row['categoria'];
                    $i++;
                }
                $GLOBALS["resultados"]=$i;
            $result->free();
            }else{
                
            }
        } else{
            
        }
       
    } 
$stmt->close();
$mysqli->close();
}
function regresarProcesador($valor){
    
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "select * from Procesador where modeloAlfanumerico='".$valor."'";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                
                while($row = $result->fetch_array()){
                    $GLOBALS["nombre"]=$row['nombre'];
                    $GLOBALS["mod"]=$row['modelo'];
                    $GLOBALS["linea"]=$row['linea'];
                    $GLOBALS["nucleos"]=$row['nucleos'];
                    $GLOBALS["hilos"]=$row['hilos'];
                    $GLOBALS["marca"]=$row['marca'];
                    $GLOBALS["socket"]=$row['zocalo'];
                    $GLOBALS["gen"]=$row['generacion'];
                    $GLOBALS["fre"]=$row['frecuencia'];
                    $GLOBALS["precio"]=$row['precio'];
                    $GLOBALS["arq"]=$row['arquitectura'];
                    $GLOBALS["cache"]=$row['memoriaCache'];
                    $GLOBALS["tipom"]=$row['tipoMemoria'];
                    $GLOBALS["maxm"]=$row['maximoMemoria'];
                    $GLOBALS["c"]=$row['consumo'];
                    $GLOBALS["des"]=$row['descripcion'];
                    $GLOBALS["r"]=$row['reseña'];
                }
            $result->free();
            }else{
                
            }
        } else{
            
        }
       
    } 
$stmt->close();
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
function regresarvalores($table,$modeloalfanumerico){
    $i=0;
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "select * from ".$table." where modeloAlfanumerico='".$modeloalfanumerico."'";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_array()){
                    
                    $j=0;
                    foreach ($GLOBALS["Campos"] as &$valor) {
                        $GLOBALS["valores"][$j]=$row[$GLOBALS["Campos"][$j]];
                        if($GLOBALS["Campos"][$j]=="descripcion" || $GLOBALS["Campos"][$j]=="reseña"|| $GLOBALS["Campos"][$j]=="nombre"|| $GLOBALS["Campos"][$j]=="modelo"|| $GLOBALS["Campos"][$j]=="marca"){
                            if($GLOBALS["Campos"][$j]=="descripcion"){
                                $GLOBALS["des"]=$GLOBALS["valores"][$j];
                            }elseif($GLOBALS["Campos"][$j]=="reseña"){
                                $GLOBALS["r"]=$GLOBALS["valores"][$j];
                            }elseif($GLOBALS["Campos"][$j]=="nombre"){
                                $GLOBALS["nombre"]=$GLOBALS["valores"][$j];
                            }elseif($GLOBALS["Campos"][$j]=="modelo"){
                                $GLOBALS["mod"]=$GLOBALS["valores"][$j];
                            }elseif($GLOBALS["Campos"][$j]=="marca"){
                                $GLOBALS["marca"]=$GLOBALS["valores"][$j];
                            }
                        }
                        $j++;
                    }
                    unset($valor);
                    $i++;
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
    $tablas=$GLOBALS["NCampos"]-5;
    $tablas=$tablas/2;
    $mayuscula="";
    $i=0;
    $j=0;
    echo '<div class="contenido-tabla"><table class="tabla">';  
    while($j<$tablas){
        if($GLOBALS["Campos"][$i]=="descripcion" || $GLOBALS["Campos"][$i]=="reseña"|| $GLOBALS["Campos"][$i]=="nombre"|| $GLOBALS["Campos"][$i]=="modelo"|| $GLOBALS["Campos"][$i]=="marca"){
            
        $i++;
        }else{
            $mayuscula=$GLOBALS["Campos"][$i];
            $mayuscula[0]=strtoupper ( $mayuscula[0]);
            echo "<tr><td>".$mayuscula.":</td><td>". $GLOBALS["valores"][$i]."</td></tr>"; 
            $i++;$j++; 
        }     
        
    }
    echo '</table></div>';
    $j=0;
    $i--;
    echo '<div class="contenido-tabla"><table class="tabla">';  
    while($j<$tablas){
        if($GLOBALS["Campos"][$i]=="descripcion" || $GLOBALS["Campos"][$i]=="reseña"|| $GLOBALS["Campos"][$i]=="nombre"|| $GLOBALS["Campos"][$i]=="modelo"|| $GLOBALS["Campos"][$i]=="marca"){
            
        $i++;
        }else{
            $mayuscula=$GLOBALS["Campos"][$i];
            $mayuscula[0]=strtoupper ( $mayuscula[0]);
            echo "<tr><td>".$mayuscula.":</td><td>". $GLOBALS["valores"][$i]."</td></tr>"; 
            $i++;$j++; 
        }     
        
    }
    echo '</table></div>';
    
    
}
?>