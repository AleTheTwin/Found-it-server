<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
<div class="msg-box">
      <div class="msg-header" onclick="closeMsgBox()">
        <p  class="msg-header-text">Mensajes</p>
      </div >
      <!--  -->
        <div id="msg-content" class="msg-content-close">
          <div class="msg-content2 invisible">
            <div style="overflow-y: scroll; max-height: 350px;">
            <?php
                $sql = "SELECT * from conversacion where remitente='" . $_SESSION['usuario'] . "' or destinatario = '" . $_SESSION['usuario'] . "'";
                if($result = $mysqli->query($sql)) {
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_array()) {
                      if($row['remitente'] == $_SESSION['usuario']) {
                        echo '
                        <div id="' . $row['id'] . '" onclick="openMessage(this, ' . "'" . $_SESSION['usuario'] . "'" . ')" class="msg-content container-fluid-msg">
                      ';
                        get_image2($row['destinatario']);
                      echo '
                          <a  class="msg-username" onclick="' . 'loadPerfilVentas('. "'" . $row['destinatario'] . "'" . ')">' . $row['destinatario'] .'</a>
                        </div>
                        ';
                      } else {
                        echo '
                        <div id="' . $row['id'] . '" onclick="openMessage(this, ' . "'" . $_SESSION['usuario'] . "'" . ')" class="msg-content container-fluid-msg">
                      ';
                        get_image2($row['remitente']);
                      echo '
                          <a  class="msg-username" onclick="' . 'loadPerfilVentas('. "'" . $row['remitente'] . "'" . ')">' . $row['remitente'] .'</a>
                        </div>
                        ';
                      }
                    }
                  } 
                }

              ?>
            </div>
            
          </div>

          <div id="mensajes" class="msg-content2 invisible">
            <div id="message-list" class="chatbox-conatiner">
            <!-- contenido -->
            </div>
          </div>
          <div id="botones-msg" class="chatbox-input container-fluid-msg invisible" style="position: absolute;bottom: 5px;left: 5%;">
        
        <button class="" onclick="closeMsg()">Volver</button>
        <form action="" onsubmit="return false;" style="display: inherit;">
          <input type="text" name="msg" id="msg" placeholder="Mensaje" autofocus>
          <div id="boton-send">

          </div>
        </form>
        
    </div>
          
          
      </div>
    </div>
  </div>

  <?php
function get_image2($usuario) {
  $filename = "/Found-it/profile/img/" . $usuario . ".png";
  if(file_exists($filename)) {
    echo '<img class="msg-prophile-photo" src="' . $filename . '">';
  } else {
    // echo '<img class="msg-prophile-photo" src="/Found-it/profile/img/default.png">';
    echo '<img class="msg-prophile-photo" src="' . $filename . '">';

  }
  
}

?>