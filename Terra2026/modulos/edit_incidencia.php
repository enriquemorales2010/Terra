<?php  

require '../clases/incidencias.php';

$ID = $_POST['ID_incidencia'];
$estado = $_POST['estado_incidencia'];
$matricula = $_POST['matricula'];

$con = new Incidencias();
$con->editarIncidencia($ID, $estado, $matricula);

?>