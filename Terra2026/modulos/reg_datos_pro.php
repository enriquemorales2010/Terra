<?php  


require '../clases/obs_m2.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$proyecto = $_POST['id_ed'];
$piso = $_POST['piso'];
$num_dep = $_POST['num_dep'];
$cant_mtrs = $_POST['cant_mtrs'];
$tipo_depto = $_POST['tipo_depto'];




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


echo "Verifcar<br>";
echo "proyecto ".$proyecto."<br>";
echo "piso ".$piso."<br>";
echo "num_dep ".$num_dep."<br>";
echo "cant_mtrs ".$cant_mtrs."<br>";
echo "tipo_depto ".$tipo_depto."<br>";*/







//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new obs_pro();
$con->registrardatosproyecto($proyecto, $piso, $num_dep, $cant_mtrs, $tipo_depto);

//}

?>