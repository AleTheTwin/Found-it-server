<?php
session_start();
define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'found-it-db');
if(!isset($_SESSION["email"])) {
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
    <link rel="stylesheet" href="css/profile.css" type="text/css">
    <link rel="stylesheet" href="../Articulos/CSS/estilos.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
    <body>
    <?php include '../Navbar/Navbar.php'?>
    <main class="main contenido" >
    <div class="container-flex" style="display: flex;">
            <form class="form-container"  action="encode_image.php" method="post" onsubmit="return sendProfile();">
                
                <h2 class="center ">Edita tu perfil</h2>
                <div class="form-section"  >
                    <div class="">
                        <label for="file">
                            <img id="image" src="<?php echo getImage($_SESSION["usuario"]);?>" width="100px" alt="">
                            <div class="update-image">Actualizar foto</div>
                        </label>
                        <input name="file" id="file" type="file" accept="image/png, image/jpeg" />
                    </div>
                </div>
                <div id="imagen-usuario">
                <div class="alerta centrar invisible" id="alerta"></div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                        <i class="material-icons md-24 icon">account_circle</i>
                    </div>
                    <div class="container-flex">
                        <input class="input-form invisible" type="text" name="actual_name" placeholder="Nombre" value="<?php echo $_SESSION["nombre"];?>" >
                        <input class="input-form" id="nombre" type="text" name="name" placeholder="Nombre" value="<?php echo $_SESSION["nombre"];?>" >
                        
                    </div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                        <i class="material-icons md-24 icon">alternate_email</i>
                    </div>
                    <div class="container-flex">
                        <input class="input-form invisible" type="text" name="username" placeholder="Nombre de usuario" value="<?php echo $_SESSION["usuario"];?>" >
                        <input class="input-form" id="usuario" type="text" name="user" placeholder="Nombre de usuario" value="<?php echo $_SESSION["usuario"];?>" >
                    </div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                        <i class="material-icons md-24">email</i>
                    </div>
                    <div class="container-flex">
                        <input class="input-form invisible" type="email" name="actual_email"  placeholder="Email" value="<?php echo $_SESSION["email"];?>" >
                        <input class="input-form" id="email" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION["email"];?>" >
                        <input class="input-form invisible" id="nueva_imagen" type="text" name="image" placeholder="Nombre" >

                    </div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                        <i class="material-icons md-24 icon">password</i>
                    </div>
                    <div class="container-flex">
                        <input class="input-form" id="password" type="password" name="password"  placeholder="Contraseña" value="" >                    
                    </div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                        <i class="material-icons md-24 icon">password</i>
                    </div>
                    <div class="container-flex">
                        <input class="input-form" id="passwordConfirm" type="password" name="passwordConfirm"  placeholder="Confirmar contraseña" value="" >                    
                    </div>
                </div>
                <div class="form-section"  >
                    <div class="container-flex">
                    <button class="form-button" onclick="saveImage()" type="submit" >¡Guardar cambios!</button>
                    </div>
                    
                </div>
            </form>
        </div>  
    </main>
    <?php if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }?>

    </body>
    <?php include '../Navbar/NavScript.php'?>
    <script src="../Sources/JS/Procesos.js"></script>
    <script src="js/img.js"></script>
</html>

    <?php


function getImage($usuario) {
    $filename = "img/" . $usuario . ".png";
    if(file_exists($filename)) {
        return $filename;
    } else {
        return 'img/default.png';
    }
}
?>