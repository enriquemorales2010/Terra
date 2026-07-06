<?php  



if (!isset($_POST)) {
	die("Error, no se permite el acceso directo");


}
require('../clases/sesiones.php');




$usuario = $_POST['usuario'];
$clave = $_POST['pass'];

$con = new Sesiones();
$con->login($usuario, $clave);





?>