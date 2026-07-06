<?php  


require_once '../clases/falla.php';

$id = $_POST['falla'];
$etiq = $_POST['etiqueta'];
$clases = $_POST['clase_falla'];
$tipos = $_POST['tipo_falla'];
$clasev = $_POST['clasev'];
$tipov = $_POST['tipov'];



echo "Etiqueta falla ".$etiq."<br>";
echo "Clase falla Select ".$clases."<br>";
echo "Tipo Falla Select ".$tipos."<br>";
echo "Clase Verificar ".$clasev."<br>";
echo "Tipo Verificar ".$tipov."<br>";



	if($clases == 0){
		$clasereal = $clasev;
	}elseif ($clases > 0){
		$clasereal = $clases;
	} else{
		$clasereal = "Algo Pasa Llamar a encargado";
	}


	if($tipos == 0){
		$tiporeal = $tipov;
	}elseif ($tipos > 0){
		$tiporeal = $tipos;
	} else{
		$tiporeal = "Algo Pasa Llamar a encargado";
	}

echo "$id";

echo "<br>Despues del If de Clase .<br>";

echo "Etiqueta falla ".$etiq."<br>";
echo "Clase falla Select ".$clases."<br>";
echo "Clase Verificar ".$clasev."<br>";
echo "Clase Real ".$clasereal."<br>";

echo "<br>Despues del If de Tipo .<br>";

echo "Etiqueta falla ".$etiq."<br>";
echo "Tipo falla Select ".$tipos."<br>";
echo "Tipo Verificar ".$tipov."<br>";
echo "Tipo Real ".$tiporeal."<br>";


$con = new fallas();
$con->editarfalla($id, $etiq, $clasereal, $tiporeal);


?>