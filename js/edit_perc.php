<?php  


require '../clases/enc_per.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/
$id_per = $_POST['id_per'];
$SelectorItem = $_POST['SelectorItem'];
$proyectov = $_POST['proyectov'];
$proyecto = $_POST['proyecto'];
$fecha_proyecto = $_POST['fecha_proyecto'];
$ditem1 = $_POST['ditem1'];
$item1 = $_POST['item1'];
$ditem2 = $_POST['ditem2'];
$item2 = $_POST['item2'];
$ditem3 = $_POST['ditem3'];
$item3 = $_POST['item3'];
$ditem4 = $_POST['ditem4'];
$item4 = $_POST['item4'];
$ditem5 = $_POST['ditem5'];
$item5 = $_POST['item5'];
$ditem6 = $_POST['ditem6'];
$item6 = $_POST['item6'];
$ditem7 = $_POST['ditem7'];
$item7 = $_POST['item7'];
$obs_adi = $_POST['obs_adi'];
$nom_enc = $_POST['nom_enc'];
$fecha_enc = $_POST['fecha_enc'];
$promedio = $_POST['promedio'];


if ($proyecto == NULL || $proyecto == "") {
	$proyecto = $proyectov;
}else{
	$proyecto = $proyecto;
}

if ($item1 == NULL || $item1 == "") {
	$item1 = 0;
}else{
	$item1 = $item1;
}


if ($item2 == NULL || $item2 == "") {
	$item2 = 0;
}else{
	$item2 = $item2;
}


if ($item3 == NULL || $item3 == "") {
	$item3 = 0;
}else{
	$item3 = $item3;
}



if ($item4 == NULL || $item4 == "") {
	$item4 = 0;
}else{
	$item4 = $item4;
}



if ($item5 == NULL || $item5 == "") {
	$item5 = 0;
}else{
	$item5 = $item5;
}


if ($item6 == NULL || $item6 == "") {
	$item6 = 0;
}else{
	$item6 = $item6;
}


if ($item7 == NULL || $item7 == "") {
	$item7 = 0;
}else{
	$item7 = $item7;
}


//$month = substr($fecha_proyecto, 5);
//$years = substr($fecha_proyecto,0 ,-3);


echo "Verifcar<br>";
echo "Encuesta numero ".$id_per."<br>";
echo "Proyecto ".$proyecto."<br>";
echo "fecha_proyecto ".$fecha_proyecto."<br>";
echo "SelectorItem ".$SelectorItem."<br>";
echo "ditem1 ".$ditem1."<br>";
echo "item1 ".$item1."<br>";
echo "ditem2 ".$ditem2."<br>";
echo "item2 ".$item2."<br>";
echo "ditem3 ".$ditem3."<br>";
echo "item3 ".$item3."<br>";
echo "ditem4 ".$ditem4."<br>";
echo "item4 ".$item4."<br>";
echo "ditem5 ".$ditem5."<br>";
echo "item5 ".$item5."<br>";
echo "ditem6 ".$ditem6."<br>";
echo "item6 ".$item6."<br>";
echo "ditem7 ".$ditem7."<br>";
echo "item7 ".$item7."<br>";
echo "Obs_adi ".$obs_adi."<br>";
echo "nom_enc ".$nom_enc."<br>";
echo "fecha_enc ".$fecha_enc."<br>";
echo "promedio ".$promedio."<br>";









//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new enc_perc();
$con->editarencperc($id_per, $proyecto, $fecha_proyecto, $SelectorItem, $ditem1, $item1, $ditem2, $item2, $ditem3, $item3, $ditem4, $item4, $ditem5, $item5, $ditem6, $item6, $ditem7, $item7, $obs_adi, $nom_enc, $fecha_enc,$promedio);

//}

?>