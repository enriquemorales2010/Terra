<?php  


require '../clases/estadistica.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$proyecto = $_POST['proyecto'];
$fecha = $_POST['fecha'];
$perdidos = $_POST['perdidos'];
$arrastrados = $_POST['arrastrados'];
$accidentados = $_POST['accidentados'];
$profesionales = $_POST['profesionales'];




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

/*
echo "Verifcar<br>";
echo "".$proyecto."<br>";
echo "".$month."<br>";
echo "".$years."<br>";
echo "".$fecha."<br>";
echo "".$perdidos."<br>";
echo "".$arrastrados."<br>";
echo "".$accidentados."<br>";
echo "".$profesionales."<br><br><br>";
*/





//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new estadisticas();
$con->registrarestadistica($proyecto,$month, $years, $fecha, $perdidos,$arrastrados, $accidentados, $profesionales);

//}

?>