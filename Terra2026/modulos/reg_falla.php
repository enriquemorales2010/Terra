<?php  


require '../clases/falla.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$etiqueta = $_POST['nombre_falla'];
$clase = $_POST['cla_fal'];
$tipo = $_POST['tipo_fal'];






//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new fallas();
$con->registrarfalla($etiqueta, $clase, $tipo);

//}

?>