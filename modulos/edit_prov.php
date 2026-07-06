<?php  


require '../clases/proveedores.php';

$ID = $_POST['ID'];
$rut = $_POST['rut'];
$nombre_proveedor = $_POST['nombre_prov'];
$direccion = $_POST['dir'];
$correo = $_POST['email'];
$telef_proveedor = $_POST['tel_prov'];
$cel_proveedor = $_POST['cel_prov'];



$con = new proveedores();

$con->editarProveedor($ID, $rut, $nombre_proveedor, $direccion, $correo, $telef_proveedor, $cel_proveedor);

echo "Proveedor de Servicios registrado correctamente.";


?>