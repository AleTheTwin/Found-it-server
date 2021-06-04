<section class="contenedor">
    <div class="contenedor">
        <form id="formulario-AddCAT" action="AdminSources/Procesos/delCatArt.php" method="post">
            <h1 class="titulo first">Eliminar tipo Articulo</h1>
            <h2 class="titulo first">Tipo de Articulo: <select class="titulo" name="old" id="Categoria"><?php recuperarCategorias()?></select></h2>
            <button class="btn addBtn"  id="add-Atributo" type="submit">Eliminar</button>
        </form>
    </div>
</section>
<?php
function recuperarCategorias(){
    $i=0;
        /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'alethetwin.online');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'Ionos-db-2021');
    define('DB_NAME', 'found-it');
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT Subcategoria from Categoria where Subcategoria!='';";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $categoria =$row['Subcategoria'];
                    echo "<option value='".$categoria."'>".$categoria."</option>";
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