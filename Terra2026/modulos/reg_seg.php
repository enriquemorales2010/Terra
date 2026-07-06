<?php  

require_once '../clases/postventas.php';


$fecha = $_POST['fecha'];
$descripcion = $_POST['desc_seg'];
$caso = $_POST['caso'];



$con = new postventas();
$con->agregarseg($fecha, $descripcion, $caso);





?>