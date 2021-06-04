<?php
// $usuario = $_GET['usuario'];
$usuario = "AleTheTwin";
$imagen = "img/" . $usuario . ".png";
$data = file_get_contents($imagen);

$encoded_data = base64_encode($data);

$filename = "img/" . $usuario;
file_put_contents($filename, $data);

$encoded_data = file_get_contents($filename);
$image_decoded = base64_decode($encoded_data);

?>

<img src="<?php echo $image_decoded;?>">