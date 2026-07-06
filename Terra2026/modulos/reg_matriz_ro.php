<?php  


require '../clases/matrizro.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

$proceso = $_POST['proceso'];
$contexto = $_POST['contexto'];
$part_int = $_POST['part_int'];
$rie_opo = $_POST['rie_opo'];
$suceso= $_POST['suceso'];
$consecuencia= $_POST['consecuencia'];
$probabilidad = $_POST['probabilidad'];
$severidad= $_POST['severidad'];
$optradio = $_POST['optradio'];
$descripcion_2= $_POST['descripcion_2'];
$frecuencia = $_POST['frecuencia'];
$funcion_1= $_POST['funcion_1'];
$plazo = $_POST['plazo'];
$evidencia1 = $_POST['evidencia1'];
$eficacia = $_POST['eficacia'];
$fecha = date('Y/m/d');
$estado = 0;

$magnitud = $probabilidad * $severidad;


if(($magnitud)== 1 || ($magnitud)== 2 ){
	$clasificacion = 1;
}elseif (( $magnitud)== 3 || ($magnitud)== 4 ) {
	 $clasificacion= 2;
}elseif (($magnitud)== 6 || ($magnitud)== 9) {
	 $clasificacion= 3;
}else{
 $magnitud= "LLamar Encargado";
}



/*$fecha_ac_in_2= $_POST['fecha_ac_in_2'];
$desc_ana_eva_3= $_POST['desc_ana_eva_3'];
$desc_int_3 = $_POST['desc_int_3'];
$desc_imple_4= $_POST['desc_imple_4'];
$nom_enc_4= $_POST['nom_enc_4'];
$funcion_4= $_POST['funcion_4'];
$fecha_ac_co_4= $_POST['fecha_ac_co_4'];
$aceptacion_5= $_POST['aceptacion_5'];
$obs_acep_5= $_POST['obs_acep_5'];
$nom_enc_5= $_POST['nom_enc_5'];
$fecha_acep_5= $_POST['fecha_acep_5'];
$nom_enc_6 = $_POST['nom_enc_6'];
$funcion_6= $_POST['funcion_6'];
$fecha_cie_6= $_POST['fecha_cie_6'];
$agregar_m = $_POST['agregar_m'];*/





/*echo "<br> Pase de Datos <br>";

echo "<br>1) proceso : ".$proceso." ";
echo "<br>2) contexto : ".$contexto." ";
echo "<br>3) Part. Inst: ".$part_int." ";
echo "<br>4) Riesgo/ Oportunidad : ".$rie_opo." ";
echo "<br>5) Suceso : ".$suceso." ";
echo "<br>6)consecuencia : ".$consecuencia." " ;
echo "<br>7)probabilidad : ".$probabilidad." " ;
echo "<br>8)severidad  : ".$severidad." ";
echo "<br>9)optradio  : ".$optradio." ";
echo "<br>10) descripcion_2       : ".$descripcion_2." ";
echo "<br>11) frecuencia    : ".$frecuencia." ";
echo "<br>12) funcion_1 : ".$funcion_1."";
echo "<br>13) plazo : ".$plazo."";
echo "<br>14) Evidencia Obj ".$evidencia1."";
echo "<br>14) estado: ".$estado."";
echo "<br>15) fecha: ".$fecha."";
echo "<br>16) Magnitud: ".$magnitud." ";
echo "<br>17) Clasificacion ".$clasificacion."<br>";*/

//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new matrizro();
$con->registrarmatriz($proceso, $contexto, $part_int, $rie_opo, $suceso, $consecuencia, $probabilidad, $severidad, $magnitud, $clasificacion, $optradio, $descripcion_2, $frecuencia, $funcion_1, $plazo, $eficacia, $evidencia1, $fecha, $estado);

//}

?>