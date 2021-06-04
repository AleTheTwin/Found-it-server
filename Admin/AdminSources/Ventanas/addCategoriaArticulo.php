<section class="contenedor">
    <div class="contenedor">
        <form id="formulario-ACATG" action="AdminSources/Procesos/addnewCatArt.php">
            <input type='text'style='display:none;' name="nombre" value="nombre">
            <input type='text'style='display:none;' name="Modelo" value="modelo">
            <input type='text'style='display:none;' name="Modalf" value="modeloAlfanumerico">
            <input type='text'style='display:none;' name="price" value="precio">
            <input type='text'style='display:none;' name="res" value="reseña">
            <input type='text'style='display:none;' name="des" value="descripcion">
            <h1 class="titulo first"> Agregando nueva categoria</h1>
            <p class="consideraciones">Por defecto todo articulo cuenta con: un modelo, modeloalfanumerico, nombre, reseña y descripcion.</p>
            <h2 class="titulo first">Nombre: <input class="titulo" type="text" name="tabla" id=""></h2>
            <h2 class="titulo first">Categoria: <select class="titulo" name="metaCategoria" id="metaCategoria"><?php recuperarCategorias()?></select></h2>
            <!--Tabla de atributos-->
            <h2 class="titulo first">Atributos</h2>
            <div class="contenido-tablas">
                <table class="tabla" >
                    <tbody id="atributos-tabla">
                        <tr>
                            <td>Atributo</td>
                            <td>Tipo de atributo</td>
                        </tr>
                        <tr>
                            <td >Modelo:</td>
                            <td>Texto</td>
                        </tr>
                        <tr>
                            <td >Modelo Alfanumerico:</td>
                            <td>Texto</td>
                        </tr>
                        <tr>
                            <td >Precio:</td>
                            <td>Texto</td>
                        </tr>
                        <tr>
                            <td >Reseña</td>
                            <td>Parrafo</td>
                        </tr>
                        <tr>
                            <td >Descripcion</td>
                            <td>Parrafo</td>
                        </tr>
                        </tbody>
                        <td><input class="atributo-name" type="text" placeholder="Nombre" id="newatributo"></td><td>Texto</td>
                </table>
            </div>
        </form>
        <button class="add-Atributo"  id="add-Atributo" onclick="agregarAtributo()">+</button>
    </div>
    <button class="btn addBtn"  id="add-Atributo" onclick="sendNCAForm()">Agregar nueva categoria</button>
</section>
<script>
//fila.innerHTML='<td><input type="text" name="nombre" placeholder="Nombre"></td><td>Varchar(<input type="number" name="caracteres" placeholder="100" min="10" max="256">)</td>';
</script>
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
    $sql="SELECT Categoria from Categoria where Subcategoria='';";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $categoria =$row['Categoria'];
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