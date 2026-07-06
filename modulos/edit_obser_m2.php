<?php  


require '../clases/obs_m2.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$id_rev = $_POST['id_rev'];
$id_proyecto = $_POST['id_proyecto'];
$fecha_revision = $_POST['fecha_revision'];
$cant_obs = $_POST['cant_obs'];
$obs_m2 = $_POST['obs_m2'];
$inspector = $_POST['inspector'];




/*
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

*/
/*echo "Verifcar<br>";
echo "id_rev : ".$id_rev."<br>";
echo "id_proyecto : ".$id_proyecto."<br>";
echo "fecha_revision : ".$fecha_revision."<br>";
echo "cant_obs : ".$cant_obs."<br>";
echo "obs_m2 : ".$obs_m2."<br>";
echo "inspector : ".$inspector."<br>";*/







//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new obs_pro();
$con->editarrevisionm2($id_rev, $id_proyecto, $fecha_revision, $cant_obs,$obs_m2, $inspector);

//}

?>