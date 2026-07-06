<?php 

require_once('../clases/postventas.php'); 

$conformidad = $_POST['conformidad'];
$fechafinal = $_POST['fecha_fi'];
$caso = $_POST['caso'];
$estado = 1;

echo "Conformidad".$conformidad."<br>";
echo "fecha de finalizacion".$fechafinal."<br>";
echo "Num de Caso".$caso."<br>";
echo "Estado	".$estado."<br>";

$con = new postventas();
$con->finalizarcaso($conformidad, $fechafinal, $caso, $estado);


?>