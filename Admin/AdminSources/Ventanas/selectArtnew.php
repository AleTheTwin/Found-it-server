<?php
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
?>
<section class="contenedor">
    <div class="contenedor">
            <h1 class="titulo first"> Agregando nuevo articulo</h1>
             <h2 class="titulo first">Categoria: <select class="titulo" name="catg" id="catg"><?php recuperarCategorias()?></select></h2>
            <button class="btn addBtn"  id="add-Atributo" type="submit" onclick="loadAddArticulo('catg','catg')">Agregar</button>
    </div>
</section>
<?php
function recuperarCategorias(){
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
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
        /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
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
                        echo "<option class='subcategoria-option' value='".$Subcategoria."'>".$Subcategoria."</option>";
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
?>