<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
?>
<section class="contenedor">
    <div class="contenedor">
            <h1 class="titulo first"> Update articulo</h1>
             <h2 class="titulo first">Categoria: <select class="titulo" name="catg" id="catg"><?php recuperarCategorias()?></select></h2>
            <button class="btn addBtn"  id="add-Atributo" type="submit" onclick="loadUptArticulo('catg','catg')">Actualizar</button>
    </div>
</section>
<?php
function recuperarCategorias(){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT Categoria from Categoria where Subcategoria=''";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $categoria =$row['Categoria'];
                    echo "<option class='categoria-option' value='".$categoria."'>".$categoria."</option>";
                    recuperarSubCategorias($categoria);
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
function recuperarSubCategorias($categoria){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT Subcategoria from Categoria where Categoria='".$categoria."';";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $Subcategoria =$row['Subcategoria'];
                    if($Subcategoria!=''){
                        //echo "<option class='subcategoria-option' value='".$Subcategoria."'>".$Subcategoria."</option>";
                        recuperarArticulos($Subcategoria);
                    }
                    
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
function recuperarArticulos($categoria){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT nombre,modeloAlfanumerico from Articulo where categoria='".$categoria."';";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $modelA =$row['modeloAlfanumerico'];
                    $nombre =$row['nombre'];
                        echo "<option class='articulo-option' value='".$categoria."/".$modelA."'>".$categoria." Nombre:".$nombre." Mod: ".$modelA."</option>";
                    
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
?>