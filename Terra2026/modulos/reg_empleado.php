<?php  

require_once '../clases/empleado.php';


$rut = $_POST['rut'];
$nombre = $_POST['nombre_emp'];
$apellido = $_POST['apellido_emp'];
$fecha = $_POST['fechaNac_emp']; 
$direccion = $_POST['dir_emp'];
$cargo = $_POST['cargo_emp'];
$estado = 1;

function calcularEdad($fecha) {
	    list($Y,$m,$d) = explode("/",$fecha);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

$edad = calcularEdad($fecha);

switch ($cargo) {
	case '0':
		$cargo = "Ej1";
		break;

	case '1':
		$cargo = "Ej2";
		break;
	
	case '2':
		$cargo= "Ej3";
		break;

	case '3':
		$cargo = "Ej4";
		break;

	case '4':
		$cargo = "Ej5";
		break;

	case '5':
		$cargo = "Ej6";
		break;

	default:
		echo "Algo ha pasado";
		break;
}

$rut;

$con = new empleado();
$con->registrarempleado($rut, $nombre, $apellido, $fecha, $edad, $direccion,$cargo, $estado);





?>