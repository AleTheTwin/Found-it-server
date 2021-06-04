<?php 
$usuario = "";
// require_once "../db-conection.php";
session_start();
define('DB_SERVER', 'alethetwin.online');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'Ionos-db-2021');
    define('DB_NAME', 'found-it');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuario = $_GET['usuario'];
    // $usuario = "AleTheTwin";
}
function cargarRating($usuario) {
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql = "SELECT * FROM reseña where reseñado = '" . $usuario . "'";
    $sumaRating = 0;
    $numeroRates = 0;
    if($result = $mysqli->query($sql)) {
        if($result->num_rows == 0) {
            echo "Rating no dispobinle"; 
        } else {
            while($row = $result->fetch_array()) {
                $sumaRating += $row['rate'];
                $numeroRates++;
            }
            $rating = round($sumaRating / $numeroRates);
            for($i = 0; $i<$rating; $i++) {
                echo '<i class="material-icons md-15 icon">star</i>';
            }
            for($i=$rating; $i<5; $i++) {
                echo '<i class="material-icons md-15 icon">star_border</i>';
            }
        } 
    }
}

?>
<!---->
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
    <?php  include '../Navbar/Navbar.php'?>
    <main class="main contenido" >
        <div  style="display: grid;justify-content:center; text-align: center;">
        <h2 class="titulo">Perfil de ventas</h2>
        <div id="profile-image">
            <?php
            if(!file_exists("img/" . $usuario . ".png")) {
                $file = "default";
            } else {
                $file = $usuario;
            }
            ?>
            <img id="image" width="100px" src="img/<?php echo $file; ?>.png" alt="">
        </div>
        <div id="rate">
            <?php cargarRating($usuario); ?>
        </div>
        <div class="nombre-usuario"><i class="material-icons md-24 icon">alternate_email</i><?php echo $usuario; ?></div>
        <div>
            <?php 
            if(isset($_SESSION["email"])) {
                $enviarMensaje = ' <a class="enviar" onclick="enviarMensaje(' . "'" . $_SESSION["usuario"] . "','" . $usuario . "'" .')">Enviar mensaje</a>';
                $reportar = ' <a class="report" onclick="report(' . "'" . $_SESSION["usuario"] . "','" . $usuario . "'" . ')">Reportar</a>';
                echo $enviarMensaje . $reportar;
            }    
            ?>
        </div>
    <section id="seccion">
            <div >
                <h3>Vendiendo</h3>
                <div class="contenedor-overflow">
                    <div class="galeria-port casa" style="max-width: 600px;">
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="JEJE no encontrado">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>
                        <div class="imagen-port" style="width: 100%;max-width: 250px;">
                            <img src="../Sources/vacio.png" alt="">
                            <a>
                                <div class="hover-galeria">
                                    <img src="../Articulos/sources/Target.png">
                                    
                                    <p>alksdfk</p>
                                    <p>asdf</p>
                                    <p>asfdasdfasfd</p>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
            <div style="min-width: 600px">
                <h3>Reseñas</h3>
                <div style="overflow: auto;" class="contenedor comentarios contenedor-overflow">
                    <div id="listado">

                    </div>
                    
                    
                </div>
                <?php
                    if(isset($_SESSION["email"])) {
                        echo '
                        <div class="cards-coment">
                            <div class="coment" style="margin:5px;">
                                <img src="img/' . $_SESSION["usuario"] . '.png" alt="">
                                <div class="contenido-texto-card">
                                    <h4>' . $_SESSION["usuario"] . '</h4>
                                    <h5>
                                        <i id="1" onclick="rate(this.id)" class="material-icons md-15 icon star">star_border</i>
                                        <i id="2" onclick="rate(this.id)" class="material-icons md-15 icon star">star_border</i>
                                        <i id="3" onclick="rate(this.id)" class="material-icons md-15 icon star">star_border</i>
                                        <i id="4" onclick="rate(this.id)" class="material-icons md-15 icon star">star_border</i>
                                        <i id="5" onclick="rate(this.id)" class="material-icons md-15 icon star">star_border</i>
                                    </h5>
                                    <textarea id="reseña" placeholder="Escribe tu reseña" rows="3"></textarea>
                                </div>
                                <a id="send-reseña" onclick="enviarReseña(' . "'" . $_SESSION["usuario"] . "', '" . $usuario . "'" . ')"><i class="material-icons m;d-14">send</i></a>
                            </div>
                        </div>
                        ';
                    }
                    ?>
            </div>
        </section>
    </div>
    </main>
    
    <?php if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }?>
    </body>
    <?php include '../Navbar/NavScript.php'?>
    <script src="../Sources/JS/Procesos.js"></script>
    <script src="js/img.js"></script>
    <script>cargarReseñas('<?php echo $usuario?>');</script>
</html>