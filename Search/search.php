<?php
session_start();

$busqueda=$_GET["search"];
$model=array();
$name=array();
$cat=array();
$resultados=0;
consultaCategoria($busqueda);
?>
<!DOCTYPE html >
<html lang="es"style="Background: #ffffff;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    <?php include '../Navbar/NavHead.php'?>
    <link rel="stylesheet" href="../Articulos/CSS/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
</head>
    <body >
    <?php include '../Navbar/Navbar.php';
        
    ?>
    <section class="Seccion-Contenido">
        <section class="portafolio" style="min-height:800px;">
        <div class="contenedor">
            <h2 class="titulo">Resultados de: <?php echo $busqueda?></h2>
            <div class="galeria-port">
                <!---->
                <?php imprimirResultados();?>
                <!---->
            </div>
        </div>
        </section>
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
    </body>
    <?php 
    if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }
    include '../Navbar/NavScript.php';
    
    
    ?>
    
</html>
<?php
function consultaCategoria($search){
    $i=0;
    require_once "../Sources/procesos/db-conection.php";
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
function imprimirResultados(){
    if($GLOBALS["resultados"]==0){
      echo '<div class="imagen-port">
                <img src="../Sources/vacio.png" alt="Vacia">
                    <div class="hover-galeria">
                    <img src="/Found-it/Articulos/sources/Target.png" alt="">
                    <a href="#">Sin resultados</a>
                </div>
            </div>';
    }else{
        $i=0;
        $ruta="";
        
        foreach ($GLOBALS["model"] as &$valor) {
            $filename='../Articulos/Imagenes/'.$GLOBALS['cat'][$i].'/'.$valor.'/'.$valor.'.png';
                    if(file_exists($filename)) {
                    } else {
                        $filename="../Sources/vacio.png";
                    }
        echo '<div class="imagen-port">
                <img src='.$filename.' alt="'.$valor.' No se encontro foto" style="height=100%; width=100%;">
                <a href="../Articulos/Articulo.php?catg='.$GLOBALS["cat"][$i].'&model='.$GLOBALS["model"][$i].'" >
                    <div class="hover-galeria">
                        <img src="/Found-it/Articulos/sources/Target.png" alt="No se encontro foto'.$valor.'.png">
                        
                        <p>'.$valor.'</p>
                        <p>'.$GLOBALS["name"][$i].'</p>
                        <p>'.$GLOBALS["cat"][$i].'</p>
                    </div>
                </a>
            </div>';
            $i++;
        }
        unset($valor);
    }
}

?>
