
<?php
session_start();
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
//prueba();    

if($_SESSION["tipo"]!=1){
    echo '
    <script>
        url = "../index.php";
        location.href =url;    
    </script>
    ';
}
?>
<!DOCTYPE html >
<html lang="es"style="Background: #ffffff;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    <?php include '../Navbar/NavHead.php'?>
    <link rel="stylesheet" href="/Found-it/Sources/CSS/estilos.css">
    <link rel="stylesheet" href="../Articulos/CSS/estilos.css">
    <link rel="stylesheet" href="AdminSources/CSS/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
</head>
    <body >
    <?php include '../Navbar/Navbar.php';
    
    ?>
    
        <section id="contenido">
        <div class="menuAdmin" style="min-height: 1000px;">
            <ul class="accionAdmin">
                <li><a onclick="load('../reportes/listado-reportes.php')">Reportes</a></li>
                <li><a onclick="load('AdminSources/Ventanas/addCategoria.php')">Agregar Categoria</a></li>
                <li><a onclick="load('AdminSources/Ventanas/updateCat.php')">Modificar Categoria</a></li>
                <li><a onclick="load('AdminSources/Ventanas/deleteCategoria.php')">Eliminar Categoria</a></li>
                <li><a onclick="load('AdminSources/Ventanas/addCategoriaArticulo.php')">Agregar tipo de Articulo </a></li>
                <li><a onclick="load('AdminSources/Ventanas/delCategoriaArticulo.php')">Eliminar tipo de Articulo</a></li>
                <li><a onclick="load('AdminSources/Ventanas/selectArtnew.php')">Agregar Articulo</a></li>
                <li><a onclick="load('AdminSources/Ventanas/update.php')">Modificar Articulo</a></li>
            </ul>
        </div>
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
        <script src="/Found-it/Sources/JS/main.js"></script>
    </body>
    <?php 
    if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }
    include '../Navbar/NavScript.php';
    
    
    ?>
    
</html>
<?php
function prueba(){
    
    try {
        if(false === new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME)){
            echo '
            <script>
                url = "/Found-it/Alerta/Alerta.php";
                location.href =url;    
            </script>
            ';
        }else{
        }
     } catch (mysqli_sql_exception $e) {
        echo '
        <script>
            url = "/Found-it/Alerta/Alerta.php";
            location.href =url;    
        </script>
        ';
     }
}
?>