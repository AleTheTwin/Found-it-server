
            <div class="contenedor-Nav" id="Navbar">
            <nav>
                <div class="nav-titulo" >
                <!-- <img id="open" onclick="sidebar_open()" src="/web-domestika/src/Desplegar.png" alt=">"> -->
                
                <i id="open" onclick="sidebar_open()" class="material-icons md-36">double_arrow</i>
                <a id="titulo" href="/Found-it/">FOUND-IT</a>
                </div>
                <div class="nav-Botones">
                    <input type="text" placeholder="Buscar" id="search">
                    <button onclick="buscar2()">Buscar</button>
                    <?php validarLogin();?>
                </div></nav>
            </div>
            <section class="sidebar" id="sidebar">
                <div class="sidebar-content"><?php recuperarCategorias();?></div>
            </section>
    

<!--
                                      
-->

<?php

function recuperarCategorias(){
    
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli->connect_errno) {
        echo '
            <script>
                url = "/Found-it/Alerta/Alerta.php";
                location.href =url;    
                alert("Error");
            </script>
            ';
    }
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT Categoria from Categoria where Subcategoria=''";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $categoria =$row['Categoria'];
                    echo '<div class="sidebar-div"><h2>'.$categoria .'</h2><ul>';
                    recuperarSubCategorias($categoria);
                    echo '</ul></div>';
                }
            $result->free();
            }else{
                
            }
        } else{
            
        }
       
    } 
$stmt->close();
$mysqli->close();
}
function recuperarSubCategorias($categoria){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    $sql="SELECT Subcategoria from Categoria where Categoria='".$categoria."';";
    if($stmt = $mysqli->prepare($sql)){
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $Subcategoria =$row['Subcategoria'];
                    $onclick="buscar('".$Subcategoria."'); sidebar_close();";
                    echo '<li><a onclick="'.$onclick.'">'.$Subcategoria.'</a></li>'; 
                }
            $result->free();
            }else{
                
            }
        } else{
            
        }
       
    } 
$stmt->close();
$mysqli->close();
}
function validarLogin(){
    if(!isset($_SESSION["email"])) {
        echo '<button onclick="loadLogin()">Identifícate</button>';
      } else {
        echo '
        <button  class="usuario-button">' . $_SESSION["usuario"] .'<div class="usuario-drop">
        <ul>
            <li><a href="/Found-it/profile/edit-profile.php?usuario='.$_SESSION["usuario"].'")>Mi cuenta</a></li>';
        validarAdmin();
        echo '
            <li><a href="/Found-it/Sources/procesos/close-session.php">Cerrar Sesión</a></li>
        </ul>
        </div></button>
        ';
      }
}
function validarAdmin(){
    if(isset($_SESSION["email"])) {
        if($_SESSION["tipo"]==1){echo '<li><a href="/Found-it/Admin/admin.php">Administracion</a></li>';}
    }
}
?>



                      

