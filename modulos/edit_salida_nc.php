<?php  


require '../clases/salida_nc.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/

/*$nombre = $_POST['nombre_edificio'];
$direccion = $_POST['dir_edificio'];
$f_rec = $_POST['fecha_rec'];
$estado = 1;*/


$id_s = $_POST['id_s'];
$serial = $_POST['serie'];
$area = $_POST['area'];
$proyecto= $_POST['proyecto'];
$accion_a = $_POST['accion_a'];
$etapa = $_POST['etapa'];
$ubicacion = $_POST['ubicacion'];
$desc_sal_1= $_POST['desc_sal_1'];
$evidencia_1 = $_POST['evidencia_1'];
$nom_enc_1= $_POST['nom_enc_1'];
$funcion_1= $_POST['funcion_1'];
$origen_1= $_POST['origen_1'];
$fecha_sa_1= $_POST['fecha_sa_1'];
$desc_ac_in_2= $_POST['desc_ac_in_2'];
$nom_enc_2= $_POST['nom_enc_2'];
$funcion_2= $_POST['funcion_2'];
$fecha_ac_in_2= $_POST['fecha_ac_in_2'];
$desc_ana_eva_3= $_POST['desc_ana_eva_3'];
$desc_int_3 = $_POST['desc_int_3'];
$desc_imple_4= $_POST['desc_imple_4'];
$nom_enc_4= $_POST['nom_enc_4'];
$fecha_ac_co_4= $_POST['fecha_ac_co_4'];
$funcion_4 = $_POST['funcion_4'];
$aceptacion_5= $_POST['aceptacion_5'];
$obs_acep_5= $_POST['obs_acep_5'];
$nom_enc_5= $_POST['nom_enc_5'];
$fecha_acep_5= $_POST['fecha_acep_5'];
$nom_enc_6 = $_POST['nom_enc_6'];
$funcion_6= $_POST['funcion_6'];
$fecha_cie_6= $_POST['fecha_cie_6'];
$agregar_m = $_POST['agregar_m'];
$proyecto_v = $_POST['proyecto_v'];
$estado = $_POST['estado'];


if ($proyecto == "") {
   $proyecto = $proyecto_v;
}

else{
  $proyecto = $proyecto;
}





if($fecha_sa_1 == 0 || $fecha_sa_1 == ""){
  $fecha_sa_1 = "1900-01-01";
} else {
  $fecha_sa_1 = $fecha_sa_1;
}

if($fecha_ac_in_2 == 0 || $fecha_ac_in_2 == ""){
  $fecha_ac_in_2 = "1900-01-01";
} else {
  $fecha_ac_in_2 = $fecha_ac_in_2;
}

if($fecha_ac_co_4 == 0 || $fecha_ac_co_4 == ""){
  $fecha_ac_co_4 = "1900-01-01";
} else {
  $fecha_ac_co_4 = $fecha_ac_co_4;
}

if($fecha_acep_5 == 0 || $fecha_acep_5 == ""){
  $fecha_acep_5 = "1900-01-01";
} else {
  $fecha_acep_5 = $fecha_acep_5;
}

if($fecha_cie_6 == 0 || $fecha_cie_6 == ""){
  $fecha_cie_6 = "1900-01-01";
} else {
  $fecha_cie_6 = $fecha_cie_6;
}

if($origen_1 == 0 || $origen_1 == ""){
  $origen_1 = 0;
} else {
  $origen_1 = $origen_1;
}

if($funcion_1 == 0 || $funcion_1 == ""){
  $funcion_1 = 0;
} else {
  $funcion_1 = $funcion_1;
}


if($funcion_2 == 0 || $funcion_2 == ""){
  $funcion_2 = 0;
} else {
  $funcion_2 = $funcion_2;
}

if($funcion_4 == 0 || $funcion_4 == ""){
  $funcion_4 = 0;
} else {
  $funcion_4 = $funcion_4;
}

if($funcion_6 == 0 || $funcion_6 == ""){
  $funcion_6 = 0;
} else {
  $funcion_6 = $funcion_6;
}

if($aceptacion_5 == 0 || $aceptacion_5 == ""){
  $aceptacion_5 = 0;
} else {
  $aceptacion_5 = $aceptacion_5;
}

if($agregar_m == 0 || $agregar_m == ""){
  $agregar_m = 0;
} else {
  $agregar_m = $agregar_m;
}





/*echo "<br> Pase de Datos <br>";
echo "<br>1) Id : ".$id_s." ";
echo "<br>1) SERIAL : ".$serial." ";
echo "<br>2) Area : ".$area." ";
echo "<br>3) accion_a : ".$accion_a." ";
echo "<br>4) etapa : ".$etapa." ";
echo "<br>5) ubicacion : ".$ubicacion." ";
echo "<br>6)Descripcion 1 : ".$desc_sal_1." " ;
echo "<br>7) Nombre Enc 1  : ".$nom_enc_1." ";
echo "<br>8) evidencia_1 : ".$evidencia_1." ";
echo "<br>9) funcion_1     : ".$funcion_1." ";
echo "<br>10) Origen        : ".$origen_1." ";
echo "<br>11) fecha_sa_1    : ".$fecha_sa_1." ";
echo "<br>12) Descripcion  acc 2 : ".$desc_ac_in_2."";
echo "<br>13) Nombre Encargado 2 : ".$nom_enc_2."";
echo "<br>9) funcion_2     : ".$funcion_2." ";
echo "<br>14) Fecha 2: ".$fecha_ac_in_2."";
echo "<br>15) Descripcion analisi: ".$desc_ana_eva_3."";
echo "<br>16) Descripcion Interes: ".$desc_int_3."";
echo "<br>17) Descripcion Imple : ".$desc_imple_4."";
echo "<br>18) Nombre Encargado 4 : ".$nom_enc_4."";
echo "<br>19) Fecha Ac. Correc: ".$fecha_ac_co_4."";
echo "<br>20) Aceptacion Decision: ".$aceptacion_5."";
echo "<br>21) Descripcion Aceptacion: ".$obs_acep_5."";
echo "<br>22) Nombre encargado 5: ".$nom_enc_5."";
echo "<br>23) Fecha Aceptación: ".$fecha_acep_5."";
echo "<br>24) Nombre Emp Cier : ".$nom_enc_6."";
echo "<br>25) Funcion cierre  : ".$funcion_6."";
echo "<br>26) fecha de cierre : ".$fecha_cie_6."";
echo "<br>27) agregar m : ".$agregar_m."";
echo "<br>28) Edificio: ".$proyecto." ";
echo "<br>29) Edificio V: ".$proyecto_v." ";
echo "<br>30) Estado: ".$estado." ";*/






/*echo "<br> YA PASO POR IF<br>";
echo "Edificio C = ".$proyecto."";*/




//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new salida_nc();
$con->editarsalida($id_s, $serial, $area, $accion_a, $etapa, $ubicacion, $desc_sal_1, $evidencia_1, $nom_enc_1, $funcion_1, $origen_1,$fecha_sa_1, $desc_ac_in_2, $nom_enc_2,$funcion_2 ,$fecha_ac_in_2, $desc_ana_eva_3, $desc_int_3, $desc_imple_4, $nom_enc_4, $fecha_ac_co_4, $funcion_4, $aceptacion_5,$obs_acep_5, $nom_enc_5, $fecha_acep_5, $nom_enc_6, $funcion_6, $fecha_cie_6, $agregar_m ,$proyecto, $estado);

//}

?>