<?php  


require '../clases/vehiculos.php';

$matricula = $_POST['matricula'];
$serial_carroc = $_POST['srial_carroc'];
$serial_motor = $_POST['srial_motor'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$anno = $_POST['anno'];
$color = $_POST['color'];
$num_puertas = $_POST['num_puertas'];
$annos_servicio = $_POST['annos_servc'];
$tipo_motor = $_POST['tipo_motor'];
$tipo_comb = $_POST['tipo_comb'];
$tanque_gas = $_POST['tanque_gas'];
$ejes = $_POST['ejes'];
$peso = $_POST['peso'];
$num_cilindros = $_POST['num_cdros'];
$activo = 3;
$transp_asig = $_POST['transp_asig'];
$combustible_opc;

switch ($tipo_comb) {
	case '1':
		$combustible_opc = "Gasolina";
		break;

	case '2':
		$combustible_opc = "Diesel";
	break;
	
	default:
		echo "Algo ha pasado.";
		break;
}

$con = new Vehiculos();
$con->registrarVehiculo($matricula, $serial_carroc, $serial_motor, $marca, $modelo, $anno, $color, $num_puertas, $annos_servicio, $tipo_motor, $combustible_opc, $tanque_gas, $ejes, $peso, $num_cilindros, $activo, $transp_asig);

?>