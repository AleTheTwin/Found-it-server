<?php 
session_start();
if(isset($_SESSION["conversacion"])) {
    $string = 'onclick="sendMsg(' . "'" . $_SESSION['usuario'] . "','" . $_SESSION["conversacion"] . "'" . ')"';
} else {
    $string = "";
}
?>
<button id="send" <?php echo $string?> type="submit" ><i class="material-icons md-14">send</i></button>