<?php  

require_once '../clases/solicitudes.php';

$ID = $_POST['ID_solicitud'];
$estado = $_POST['estado_solicitud'];

$con = new Solicitudes();
$con->editarSolicitud($ID, $estado);

?>