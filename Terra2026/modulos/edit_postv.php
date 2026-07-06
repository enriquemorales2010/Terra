<?php  


require '../clases/postventas.php';

$num_caso = $_POST['num_caso'];
$nombre = $_POST['reclamador'];
$contrato = $_POST['contrato'];
$dpto = $_POST['dpto'];
$descripcion = $_POST['descripcion'];
$correo = $_POST['email'];
$telef = $_POST['fono'];
$cel = $_POST['celular'];
$edifs = $_POST['edificio'];
$edifv = $_POST['ident_ed'];


/*edifs = Edificio valor Select
  edifv = Edificio en input hidden	
*/


	if ($edifs == 0) {
	    $real = $edifv;
		  }
     elseif ($edifs > 0){
     	$real = $edifs;
	} else{
		echo "ALGO PASO REVISAR";
	}




$con = new postventas();

$con->editarPostventa($num_caso, $nombre, $contrato, $dpto, $descripcion, $correo, $telef, $cel, $real);




?>