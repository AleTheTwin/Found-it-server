<?php 

	define('DB_SERVER', 'alethetwin.online');
	define('DB_USERNAME', 'admin');
	define('DB_PASSWORD', 'Ionos-db-2021');
	define('DB_NAME', 'found-it');

	$articulo=$_POST['articulo'];
	$usuario=$_POST['usuario'];
	$precio=$_POST['precio'];
	$estado=$_POST['estado'];

	agregarVendedor($articulo,$usuario,$precio,$estado);

	function agregarVendedor($modalf,$usuario,$precio,$estado){
    if($usuario!="admin@admin.com"){
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql = "INSERT INTO ventas (modeloAlfanumerico, nombre, precio, estado) VALUES ('".$modalf."','".$usuario."','".$precio."','".$estado."')";
        if($stmt = $mysqli->prepare($sql)){
                if($stmt->execute()){
                    echo "Agregado con exito <a href='/Found-it/'> Regresar<a>";
                    exit();
                } else{
                    echo "Something went wrong. Please try again later. 21 <a href='/Found-it/'> Regresar<a>";
                }
                $stmt->close();
            }else{
                echo "Something went wrong. Please try again later. prepare31 <a href='/Found-it/'> Regresar<a>";
            }
        $mysqli->close();
    }
}
?>