<?php 
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
?>
<section class="contenedor">
    <div class="contenedor">
        <form id="formulario-AddCAT" action="AdminSources/Procesos/updCat.php" method="post">
            <h1 class="titulo first">Modificando categoria</h1>
            <h2 class="titulo first">Categoria: <select class="titulo" name="old" id="Categoria"><?php recuperarCategorias()?></select></h2>
            <h2 class="titulo first">Nuevo Nombre: <input class="titulo" type="text" name="new" id=""></h2>
            <button class="btn addBtn"  id="add-Atributo" type="submit">Modificar categoria</button>
        </form>
    </div>
</section>
<?php
function recuperarCategorias(){
    $i=0;
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
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