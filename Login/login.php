<?php
session_start();
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');
if(isset($_SESSION["email"])) {
    echo '
  <script>
  location.reload();
      url = "../index.php";
      location.href =url;    
  </script>
  ';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    <?php include '../Navbar/NavHead.php'?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
    <body>
    <?php include '../Navbar/Navbar.php'?>
    
        <div class="contenedorAle">
            <br>
            <h1>Inicia sesión</h1>
            <div class="alerta centrar visually-hidden" id="alerta"></div>
            <div class="centrar">
                <form action="login.php" method="post" onsubmit="return false;">
                    <label for="emailInput" class="form-label visually-hidden"  >Email address</label>
                    <input type="email" class="entrada" id="emailInput" name="email" value="" placeholder="Email">
                    <label for="passwordInput" class="form-label visually-hidden" >Contraseña</label>
                    <input type="password" class="entrada" id="passwordInput" name="password" placeholder="Contraseña">
                    <br>
                    <button class="boton-form" type="submit" onclick="login()">Iniciar Sesión</button>
                </form>
                <br>
                <p>¿Aún no tienes una cuenta?<br><a class="link" href="registro.php">Regístrate</a></p>
            </div>
            <br>
        </div>
    </body>
    <?php include '../Navbar/NavScript.php'?>
    <script src="../Sources/JS/Procesos.js"></script>
</html>