<?php 


require '../clases/transportistas.php';

$cedula = $_POST['ci_transp'];
$nombre = $_POST['nombre_transp'];
$apellido = $_POST['apellido_transp'];
$fecha_nac = $_POST['fechaNac_transp'];
$direccion = $_POST['dir_transp'];
$email = $_POST['email_transp'];
$estado = $_POST['estado'];
$licencia = $_POST['lic_transp'];
$licencia_opc;
$telf_hab =$_POST['tel_transp'];
$telf_cel =$_POST['cel_transp'];
$venc_licencia = $_POST['venc_licencia'];

switch ($licencia) {
	case 3:
		$licencia_opc = "3°";
		break;

	case 4:
		$licencia_opc = "4°";
		break;

	case 5:
		$licencia_opc = "5°";
		break;

	default:
		echo " Algo ha pasado";
		break;
	}
//var_dump($fecha_nac);
function calcularEdad($fecha_nac) {
	    list($Y,$m,$d) = explode("/",$fecha_nac);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

$edad = calcularEdad($fecha_nac);
//var_dump($edad);

$con = new Transportistas();
$con->editarTransportista($cedula, $nombre, $apellido, $fecha_nac, $edad, $direccion, $email, $estado, $licencia_opc, $telf_hab, $telf_cel, $venc_licencia);

echo "Transportista registrado correctamente";


 ?>