<?php
include 'funcionesArticulo.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found-it <?php echo $mod?></title>
    <?php include '../Navbar/NavHead.php'?>
    <link rel="stylesheet" href="CSS/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <?php 
        $imagen=("sources/".$marca.".png");
        if (file_exists($imagen)){
            echo'<style type="text/css">
            .backImage {
                background: linear-gradient(to right, #4286f4a8, #ffffff91),url(sources/'.$marca.'.png);
            }
            </style>';
        }else{
            echo'<style type="text/css">
            .backImage {
                background: linear-gradient(to left, #4286f46, #0d5dae);
            }
            </style>';
        }
        ?>
</head>
    <body>
    <?php include '../Navbar/Navbar.php'?>
        <header id="header" class="backImage">
            <section class="textos-header" >
                <h1><?php echo $_GET["catg"]?></h1>
                <h2><?php echo $marca?></h2>
            </section>
            <div class="wave" style="height: 150px; overflow: hidden;" >
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                <path d="M-18.62,32.06 C149.99,150.00 215.00,-104.11 510.15,119.89 L499.43,203.78 L0.00
                ,150.00 Z" style="stroke: none; fill: #000;">
            </path></svg>
            </div>
        </header>
        <main class= "contenido">
            <section class="imagen">
                <img src="<?php 
                $imagename="Imagenes/".$_GET["catg"]."/".$_GET["model"]."/".$_GET["model"].".png";
                if(file_exists($imagename)) {

                } else {
                    $imagename="../Sources/vacio.png";
                }
                echo $imagename;
                
                ?>" alt="No se encontro imagen" class="imagen-about" id="Imagen">
            </section>
            <section class="textos-header texto-nombre" id="nombres"><!--style="display:none"-->
                        <h1><?php echo $nombre?></h1>
                        <h2><?php echo $mod?></h2>
            </section>
        <section class="contenedor about" id="DesRes">
                <div class="contenedor-about">
                        <div class="contenido-textos">
                            <h3><span>D</span>escripcion</h3>
                            <p><?php echo $des;?></p>
                        </div>
                        <div class="contenido-textos">
                            <h3><span>R</span>eseña</h3>
                            <p><?php echo $r?></p>
                        </div>
                </div>
        </section>
            <!---->
        <section class="Caracteristicas">
            <div class="contenedor">
                <h2 class="titulo">Especificaciones</h2>
                <div class="contenido-tablas">
                <?php imprimirValores(); ?>
                </div>
            </div>
        </section>
        <section class="contenedor comentarios">
            <h2 class="titulo">Comentarios</h2>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <div class="cards-coment" id="cajonComentarios">
            	
            	   <?php 
            	   	   cargarComentarios(); 	
            	   ?>
                    
                </div>
            </div>    
            <div class="W-comment">
                    <CENTER>

                        <?php 
                        if(isset($_SESSION["email"])) {
                            $string = 'onclick="sendComentario(' . "'" . $_GET['model'] . "','" . $_SESSION['usuario'] . "'" . ')"';
                            echo '
                                <div>
                                <form action="" onsubmit="return false;" style="display: inherit;">
                                    <textarea class="add-Coment" id="coment" name="coment" placeholder="Escribe tu comentario" rows="3"></textarea>
                                    <button id="send"' .$string .' type="submit" ><i class="material-icons m;d-14">send</i></button>
                                </form>
                                </di>
                                ';
                                
                        
                        }
                    ?>
                    </CENTER>
                </div>
        </section>
        <section class="ventas contenedor">
            <h2 class="titulo">Vendiendo</h2>
            <?php 
            
                    if(isset($_SESSION["email"])) {
                        $st = 'onclick="loadNew(' . "'" . $_GET['model'] . "','" . $_SESSION['usuario'] . "'" . ')"';
                        echo '
                            <button id="agregar" '.$st.' type="submit"><i class="material-icons m;d-14">add</i></button>
                            ';
                            
                    
                    }
            ?>
            <div class="cards">
                <div class="card">
                    <img src="../Sources/vacio.png" alt="">
                    <div class="contenido-texto-card">
                    <h4>Usuario Vendiendo</h4>
                    <p>Breve descripcion acerca del producto en venta, su estado y el precio, ademas de la ubicacion.
                    </p>
                    <h5>Precio: $$$$</h5>
                    </div>
                </div>
                <div class="card">
                    <img src="../Sources/vacio.png" alt="">
                    <div class="contenido-texto-card">
                    <h4>Usuario Vendiendo</h4>
                    <p>Breve descripcion acerca del producto en venta, su estado y el precio, ademas de la ubicacion.
                    </p>
                    <h5>Precio: $$$$</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="portafolio">
            <div class="contenedor">
                <h2 class="titulo">Relacionados</h2>
                <div class="galeria-port">
                <?php regresarRelacionados($busqueda);?>
                </div>
            </div>
        </section>


        </main>
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
        <?php if(isset($_SESSION["email"])) {
        include "../messages/messages.php";
      }?>
    </body>
    <script src="sources/scrollbar.js"></script>
    <?php include '../Navbar/NavScript.php'?>
</html>