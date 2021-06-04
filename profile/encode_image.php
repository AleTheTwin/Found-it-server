<?php  
    session_start();
    define('DB_SERVER', 'found-it-db.cft2hvdqqkde.us-east-1.rds.amazonawscom');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'root1234');
    define('DB_NAME', 'found-it-db');
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
        // obtener parámetros del get 
    define('UPLOAD_DIR', 'img/');  
    $actual_name = $_POST['actual_name'];
    $nombre = $_POST['name'];
    $usuario = $_POST['user'];
    $actual_username = $_POST['username'];
    $actual_email = $_POST['actual_email'];
    $email = $_POST['email'];
    $nueva_imagen = $_POST['image'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

        //Actualizar foto de perfil
    $nueva_imagen = str_replace('data:image/png;base64,', '', $nueva_imagen);  
    $nueva_imagen = str_replace(' ', '+', $nueva_imagen);  
    $data = base64_decode($nueva_imagen);  
    $file = UPLOAD_DIR . $usuario . '.png';  
    $success = file_put_contents($file, $data);  
    print $success ? $file : 'Unable to save the file.';

    $data = file_get_contents($file);
    $encoded_file = UPLOAD_DIR . $usuario;
    $data = base64_encode($data);
    file_put_contents($encoded_file, $data);
    // unlink($file);

        //Actualizar datos

    if($password == "") {
        $sql = "UPDATE usuario SET email = ?, nombre = ?, usuario = ? WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ssss", $param_email, $param_nombre, $param_usuario, $param_actual_email);
            $param_email = $email;
            $param_nombre = $nombre;
            $param_usuario = $usuario;
            $param_actual_email = $actual_email;

            if($stmt->execute()) {
                $_SESSION["email"] = $email;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["usuario"] = $usuario;
                echo "1"; // Código para registro exitoso
            } else {
                // echo "4"; //Código para error de DB
                echo $mysqli->error;
            }
        } else {
            echo "4"; //Código para error de DB
        }
    } else {
        $sql = "UPDATE usuario SET email = ?, nombre = ?, usuario = ?, password = ? WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $param_email, $param_nombre, $param_usuario, $param_password, $param_actual_email);
            $param_email = $email;
            $param_nombre = $nombre;
            $param_usuario = $usuario;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_actual_email = $actual_email;

            if($stmt->execute()) {
                $_SESSION["email"] = $email;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["usuario"] = $usuario;
                echo "1"; // Código para registro exitoso
            } else {
                // echo "4"; //Código para error de DB
                echo $mysqli->error;
            }
        } else {
            echo "4"; //Código para error de DB
        }
    }
    
    



        //Redirigir al inicio
    header("location: ../");
?>  