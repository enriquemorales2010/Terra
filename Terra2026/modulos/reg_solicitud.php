<?php  

require_once '../clases/solicitudes.php';

$ID = $_POST['id_incidencia'];
$prioridad = $_POST['prioridad'];
$asunto = $_POST['asunto'];
$caracteristica = $_POST['caracteristicas'];
$estado = 000002;

$con = new Solicitudes();
$con->registrarSolicitud($ID, $prioridad, $asunto, $caracteristica, $estado);

?>