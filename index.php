<?php
session_start();
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
?>
<!DOCTYPE html >
<html lang="es"style="Background: #ffffff;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    <?php include 'Navbar/NavHead.php'?>
    <link rel="stylesheet" href="Articulos/CSS/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
</head>
    <body >
    <?php include 'Navbar/Navbar.php';
        
    ?>
    <section class="Seccion-Contenido" style="margin-top:80px; text-align:center; font-size: 56px;">
        <h1 style="color:#797979;">Bienvenido a Found-it</h1>
        <img src="Sources/welcome.png" alt="">
        <p style="color:#797979;font-size: 36px;">¡Donde lo encuentras todo!</p>
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
        include "messages/messages.php";
      }
    include 'Navbar/NavScript.php';
    
    
    ?>
    
</html>
