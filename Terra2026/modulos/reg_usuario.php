<?php  


require '../clases/usuarios.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$rut = $_POST['rut_usuario'];
$nombre = $_POST['nombre_usuario'];
$apellido = $_POST['apellido_usuario'];
$direccion = $_POST['dir_usuario'];
$correo = $_POST['email_usuario'];
$pass = $_POST['pass_usuario'];
$estado = 1;
$perfil_opc = $_POST['perfil_usuario'];
//$perfil = $_POST['perfil_usuarios'];




//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new Usuarios();
$con->registrarUsuario($rut, $nombre, $apellido, $direccion, $correo, $pass, $estado, $perfil_opc);

//}

?>