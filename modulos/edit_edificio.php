<?php  


require_once '../clases/edificios.php';

$nombre = $_POST['nombre_edificio'];
$direccion = $_POST['dir_edificio'];
$f_rec = $_POST['fecha_rec'];
$estado = $_POST['estado'];


$id = $_POST['ID'];



$con = new edificios();
$con->editaredificio($id, $nombre, $direccion,$f_rec, $estado);


?>