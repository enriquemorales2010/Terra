<?php  


require '../clases/usuarios.php';

$rut = $_POST['rut_usuario'];
$nombre = $_POST['nombre_usuario'];
$apellido = $_POST['apellido_usuario'];
$direccion = $_POST['dir_usuario'];
$correo = $_POST['email_usuario'];
$pass = $_POST['pass_usuario'];
$estado = $_POST['estado'];
$perfil_opc = $_POST['perfil_usuario'];
//$perfil_opc;

echo "<br>Antes de Swicht<br>";
echo "<br>Nombre: ".$nombre." <br>";
echo "<br>Apellido: ".$apellido." <br>";
echo "<br>Direccion: ".$direccion." <br>";
echo "<br>Correo: ".$correo." <br>";
echo "<br>Clave: ".$pass." <br>";
echo "<br>Estado: ".$Estado." <br>";
echo "<br>Perfil: ".$perfil." <br>";



//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new Usuarios();
$con->editarUsuarios($rut, $nombre, $apellido, $direccion, $correo, $pass, $estado, $perfil_opc);

//}


?>