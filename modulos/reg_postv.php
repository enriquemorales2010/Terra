<?php  
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}


require '../clases/postventas.php';


$nombre = $_POST['nom_rec'];
$arriendo = $_POST['contrato'];
$dpto = $_POST['num_dep'];
$fechair = $_POST['fechar'];
$descripcion = $_POST['desc_caso'];
$edificio = $_POST['id_ed'];
$email = $_POST['correo'];
$telefono = $_POST['tel_rec'];
$celular = $_POST['cel_rec'];
$usuario = $_POST['rut_usu'];
$estado = 0;
$conformidad = 0;



$con = new postventas();
$con->registrarPostventa($nombre, $arriendo, $dpto, $fechair, $descripcion, $email, $telefono, $celular,$conformidad ,$estado, $usuario, $edificio);
 

?>