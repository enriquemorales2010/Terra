<?php  


require_once '../clases/postventas.php';

$id = $_POST['seg'];
$descripcion = $_POST['desc'];

echo 1;


$con = new postventas();
$con->editarseguimiento($id, $descripcion);



?>