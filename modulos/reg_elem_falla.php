<?php  


require '../clases/falla.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$etiqueta = $_POST['nombre_elem_falla'];







//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new fallas();
$con->registrartipofalla($etiqueta);

//}

?>