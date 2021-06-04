<?php
define('DB_SERVER', 'alethetwin.online');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Ionos-db-2021');
define('DB_NAME', 'found-it');

$reportador = "";
$reportado = "";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  $reportador = $_GET['reportador'];
  $reportado = $_GET['reportado'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Found-it/Sources/CSS/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
   <title>Found-it</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php include '../Navbar/NavHead.php'?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../Articulos/CSS/estilos.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
    <body>
    <?php  include '../Navbar/Navbar.php'?>
    <main class="main contenido" >
    <form action="" onsubmit="return false;">
      <h2 class="titulo centrado">Reporte:</h2>
      <center>
        <h3>Asunto de tu reporte</h3>
        <input class="titulo" type="text" id="asunto" name="asunto" placeholder="Asunto" style="max-width: 50%;">
        <h3>Describe el problema</h3>

        <?php 
          $string = 'onclick="sendReporte(' . "'" . $reportador . "','" . $reportado . "'" . ')"';
        ?>
        <textarea class="titulo" id="descripcion" name="descripcion" placeholder="Descripción" rows="3" style="min-width: 1000px;"></textarea>
        <button type="submit" <?php echo $string; ?> class="btn">Enviar</button>
      </center>
    </form>
    </main>
      
    <?php if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }?>
    </body>
    <?php include '../Navbar/NavScript.php'?>
    <script src="../Sources/JS/Procesos.js"></script>
</html>