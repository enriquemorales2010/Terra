<?php  


require_once '../clases/estadistica.php';

$id = $_POST['id_estadistica'];
$fecha = $_POST['fecha'];
$proyecto = $_POST['proyecto'];
$proyectov = $_POST['proyectov'];
$perdidos = $_POST['perdidos'];
$arrastrados = $_POST['arrastrados'];
$accidentados = $_POST['accidentados'];
$profesionales = $_POST['profesionales'];
 
 if ($proyecto == 0 or $proyecto == NULL ) {
 	$proyecto = $proyectov;

 }elseif ($proyecto != 0) {
 	$proyecto = $proyecto ;
 }else{
 	$proyecto = "Paso Algo";
 }

if ($perdidos == NULL) {
	$perdidos = 0;
}else{
	$perdidos = $perdidos;
}

if ($arrastrados == NULL) {
	$arrastrados = 0;
}else{
	$arrastrados = $arrastrados;
}


if ($accidentados == NULL) {
	$accidentados = 0;
}else{
	$accidentados = $accidentados;
}

if ($profesionales == NULL) {
	$profesionales = 0;
}else{
	$profesionales = $profesionales;
}

$month = substr($fecha, 5);
$years = substr($fecha,0 ,-3);




/*echo "month ".$month."<br>";
echo "years ".$years."<br>";
echo "proyecto proyecto proyecto ".$proyecto."<br>";
echo "proyecto proyecto proyectcvvvv ".$proyectov."<br>";
echo "perdidos perdidos ".$perdidos."<br>";
echo "arrastrados arrastrados ".$arrastrados."<br>";
echo "accidentados accidentados ".$accidentados."<br>";
echo "profesionales profesionales ".$profesionales."<br>";*/





$con = new estadisticas();
$con->editarestadistica($id, $fecha, $month, $years, $proyecto, $perdidos, $arrastrados, $accidentados, $profesionales);


?>