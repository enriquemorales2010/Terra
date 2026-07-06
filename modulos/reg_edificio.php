<?php  





require '../clases/edificios.php';



/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/



$nombre = $_POST['nombre_edificio'];

$direccion = $_POST['dir_edificio'];

$f_rec = $_POST['fecha_rec'];

$estado = 1;

if ($f_rec == 0 || $f_rec == "" ) {
	$f_rec = NULL;

}else{
	$f_rec = $f_rec;
}












//if(empty($_POST['user']) && empty($_POST['pass'])) {



	//echo "Error! No puedes dejar campos vacios";



//}else {



$con = new edificios();

$con->registraredificio($nombre, $direccion, $f_rec, $estado);



//}



?>