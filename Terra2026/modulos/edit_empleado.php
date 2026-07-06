<?php  


require '../clases/usuarios.php';

$rut = $_POST['rut_usuario'];
$nombre = $_POST['nombre_usuario'];
$apellido = $_POST['apellido_usuario'];
$direccion = $_POST['dir_usuario'];
$correo = $_POST['email_usuario'];
$pass = $_POST['pass_usuario'];
$estado = $_POST['estado'];
$perfil = $_POST['perfil_usuario'];
$perfil_opc;



switch ($perfil) {
	case 1:
		$perfil_opc = 000001;
		break;

	case 2:
		$perfil_opc = 000002;
		break;

	case 3:
		$perfil_opc = 000003;
		break;

	case 4:
		$perfil_opc = 000004;
		break;

	case 5:
		$perfil_opc = 000005;
		break;

	default:
		echo " Algo ha pasado";
		break;
	}

//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new Usuarios();
$con->editarUsuarios($rut, $nombre, $apellido, $direccion, $correo, $pass, $estado, $perfil_opc);

//}


?>