<?php
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url, PHP_URL_QUERY);
//$component parameter is PHP_URL_QUERY
parse_str($components, $results);
//print_r($results);

$arreglo = array();
$tabla='';
$values="";
$i=0;
$metaCategoria="";
foreach ($results as $atributo => $valor){
    if('tabla'!=$atributo and 'metaCategoria'!=$atributo){
        $arreglo[$i]=$valor;
        $i++;
    }else{
        if($atributo=='tabla'){
            $tabla=$valor;
        }else{
            $metaCategoria=$valor;
        }
    }
    
};
//print_r($arreglo);
$tamanio = count($arreglo);
$i=0;
$subCategoria ="insert into Categoria values('Componentes de PC','".$tabla."')";
$values="create table ".$tabla." ("; 
$etiquetas=" insert into Etiqueta values(NEW.modeloAlfanumerico,'".$tabla."','".$tabla."');";
while ($i<$tamanio){
    if($arreglo[$i]=='descripcion' || $arreglo[$i]=='reseña'){
        $values=$values." ".$arreglo[$i]." text";
    }else{
        $values=$values." ".$arreglo[$i]." varchar(100)";
        $etiquetas=$etiquetas." insert into Etiqueta values(NEW.modeloAlfanumerico,'".$tabla."',NEW.".$arreglo[$i].");";
    }
    $i++;
    if($i<$tamanio){
        $values=$values.", ";
    }else{
        $values=$values.", primary key(modeloAlfanumerico));";
    }
}
$triggerdelete="";
$triggerdelete="
CREATE TRIGGER borrar".$tabla."
before delete ON ".$tabla."
FOR EACH ROW
BEGIN
  delete from Articulo where modeloAlfanumerico=OLD.modeloAlfanumerico and categoria='".$tabla."';
  delete from Etiqueta where modeloAlfanumerico=OLD.modeloAlfanumerico;
END;
";
//echo "<h1>".$tabla."</h1>";
//echo "<h2>".$values."</h2>";
//echo "<h3>".$triggerdelete."</h3>";
$triggeraddArt="
CREATE TRIGGER agregarArticulo".$tabla."
AFTER INSERT ON ".$tabla."
FOR EACH ROW
BEGIN
  insert into Articulo values(NEW.modeloAlfanumerico,NEW.nombre,'".$tabla."');
END;";
//echo "<h3>".$triggeraddArt."</h3>";
$triggeraddEtiqueta="
CREATE TRIGGER agregarEtiqueta".$tabla."
AFTER INSERT ON ".$tabla."
FOR EACH ROW
BEGIN
  ".$etiquetas."
END;";
$triggerupdateEtiqueta="
CREATE TRIGGER UpdateArt".$tabla."
before update ON ".$tabla."
FOR EACH ROW
BEGIN
  update Etiqueta set modeloAlfanumerico=new.modeloAlfanumerico where modeloAlfanumerico=OLD.modeloAlfanumerico;
  update Articulo set modeloAlfanumerico=new.modeloAlfanumerico, nombre=new.nombre where modeloAlfanumerico=OLD.modeloAlfanumerico;
END";
agregartabla($values,$triggeraddEtiqueta,$triggeraddArt,$triggerdelete,$tabla,$metaCategoria,$triggerupdateEtiqueta);
//echo "<p>".$triggeraddEtiqueta."</p>";

    function agregartabla($values,$triggeraddEtiqueta,$triggeraddAr,$triggerdelete,$tabla,$metaCategoria,$triggerupdateEtiqueta){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);    
        $sql = $values;
        if ($mysqli->query($sql) === TRUE) {
            echo "la tabla ".$tabla." ha sido creado";
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        } else {
            echo "Hubo un error al crear la tabla ".$tabla.": " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql = $triggeraddEtiqueta;
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Hubo un error al crear el trigger ".$tabla.": " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql = $triggeraddAr;
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Hubo un error al crear el trigger ".$tabla.": " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql = $triggerdelete;
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Hubo un error al crear el trigger ".$tabla.": " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql = "insert into Categoria values ('".$metaCategoria."','".$tabla."')";
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Hubo un error al insertar ".$tabla." en Categoria: " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $sql=$triggerupdateEtiqueta;
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Hubo un error al insertar ".$tabla." en Categoria: " . $mysqli->error;
            echo "<a href='/Found-it/Admin/admin.php'> Regresar a admin<a>";
        }
        $mysqli->close();
    }
?>
