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
        <h1>Regístrate</h1>
        <div id="alerta" class="alerta centrar viusally-hidden"></div>
            <div class="centrar">
            <form action="signup.php" method="post" onsubmit="return false;">
            <label for="nameInput" class="form-label visually-hidden" >Nombre completo</label>
            <input type="text" name="name" class="entrada" id="nameInput" value="" placeholder="Nombre completo">
            <label for="userInput" class="form-label visually-hidden" >Nombre de usuario</label>
            <input type="text" name="user" class="entrada" id="userInput" value="" placeholder="Nombre de usuario">
            <label for="emailInput" class="form-label visually-hidden" >Email address</label>
            <input type="email" name="email" class="entrada" id="emailInput" value="" placeholder="Email">
            <label for="passwordInput" class="form-label visually-hidden" >Contraseña</label>
            <input type="password" name="password" class="entrada" id="passwordInput"  placeholder="Contraseña">
            <label for="passwordConfirmInput" class="form-label visually-hidden" >Confirmar contraseña</label>
            <input type="password" name="passwordConfirm" class="entrada" id="passwordConfirmInput" placeholder="Confirmar contraseña">
            <br>
            <button class="boton-form" type="submit" onclick="register()">Registrarme</button>
            </form>
            <br>
            <p>¿Ya tienes una cuenta?<br><a class="link" href="login.php">Inicia sesión</a></p>
        </div>
        <br>
    </div>

    </body>
    <?php include '../Navbar/NavScript.php'?>
    <script src="../Sources/JS/Procesos.js"></script>
</html>