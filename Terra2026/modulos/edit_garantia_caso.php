<?php  


require_once '../clases/postventas.php';

$id = $_POST['caso_garantia'];
$decision= $_POST['estado'];
$descripcion = $_POST['descripcion'];
$costoi = $_POST['costo'];
$costoo = $_POST['costoo'];



echo "ANTES DE  IF<br>";
echo "Costo en Input : $costoi <br>";
echo "Costo Oculto: $costoo <br><br";

if ($costoi == $costoo) {

	$costod = $costoo;
}else{
	$costod = $costoi;
}
	
if ($decision == 0) {
	$costod = 0;
}


echo "Despues DE  IF<br>";
echo "Costo en Input : $costoi <br>";
echo "Costo Oculto: $costoo <br>";
echo "Costo Definito: $costod <br>";


echo"Todo Antes de Pasar <br><br>";

echo "Id: $id <br>";
echo "Decisiojn de Gar: $decision <br>";
echo "Descripcion: $descripcion <br>";
echo "Costo Definito: $costod <br>";


$con = new postventas();
$con->editargarantia($id,$decision,$descripcion,$costod);


?>