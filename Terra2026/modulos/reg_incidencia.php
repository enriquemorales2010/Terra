<?php  


session_start();

require_once '../clases/incidencias.php';

$tipo = $_POST['tipo_mantenimiento'];
$descripcion = $_POST['desc_incidencia'];
$matricula = $_POST['matricula'];
$ID_usuario = $_SESSION['cedula'];
$status_incidencia = 000002;

$con = new Incidencias();
$con->registrarIncidencia($tipo, $descripcion, $matricula, $ID_usuario, $status_incidencia);



?>