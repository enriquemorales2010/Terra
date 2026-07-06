<?php  


require '../clases/matrizdoc.php';
require_once '../clases/conexion.php';

/*$nombreBD(para asimilar con bd y atributo)=$_POST['nombrecontrol(boton,input)']*/
$id_calculado = $_POST['id_calculado'];
$codigo_doc = $_POST['codigo_serie'];
$origen_doc = $_POST['origen'];
$tipo = $_POST['tip_doc'];
$mproceso = $_POST['mproceso'];
$num_doc= $_POST['numerodoc'];
$nombre= $_POST['nombre'];
$n_version = $_POST['n_version'];
$estado_ver= $_POST['estado_ver'];
$fecha_elab = $_POST['fecha_elab'];
$ubicacion = $_POST['ubicacion'];
$observacion = $_POST['observacion'];
$responsable = $_POST['responsable'];
$responsable1 = $_POST['responsable1'];
$responsable2 = $_POST['responsable2'];
$responsable3 = $_POST['responsable3'];
$responsable4 = $_POST['responsable4'];
$almacenamiento = $_POST['almacenamiento'];
$proteccion = $_POST['proteccion'];
$recuperacion = $_POST['recuperacion'];
$retencion = $_POST['retencion'];
$disposicion = $_POST['disposicion'];






if($tipo == 1){
 $st = "M-";
}elseif($tipo == 2){
  $st = "P-";
}elseif($tipo == 3){
  $st = "I-";
}elseif($tipo == 4){
  $st = "R-";
}elseif($tipo == 5){
  $st = "D-";
}else{
  $st = null;
}


if($mproceso == 1){
  $sm = "AD-";
}elseif($mproceso == 2){
  $sm = "EO-";
}elseif($mproceso == 3){
  $sm = "EP-";
}elseif($mproceso == 4){
  $sm = "FS-";
}elseif($mproceso == 5){
  $sm = "PV-";
}elseif($mproceso == 6){
  $sm = "PR-";
}elseif($mproceso == 7){
  $sm = "RH-";
}elseif($mproceso == 8){
  $sm = "SG-";
}else{
  $sm = null;
}


$codigo_php = "".$st."".$sm."".$num_doc."";


if($responsable == 0 || $responsable == ""){
  $responsable = 0;
} else {
  $responsable = $responsable;
}

if($responsable1 == 0 || $responsable1 == ""){
  $responsable1 = 0;
} else {
  $responsable1 = $responsable1;
}


if($responsable2 == 0 || $responsable2 == ""){
  $responsable2 = 0;
} else {
  $responsable2 = $responsable2;
}


if($responsable3 == 0 || $responsable3 == ""){
  $responsable3 = 0;
} else {
  $responsable3 = $responsable3;
}


if($responsable4 == 0 || $responsable4 == ""){
  $responsable4 = 0;
} else {
  $responsable4 = $responsable4;
}







/*if(!empty($_POST['Country'])) {
    foreach($_POST['Country'] as $Prueba) {


              $sql =" INSERT INTO reponsable(idreponsable, responsable_num, matriz_doc_id_matriz_doc) VALUES ( NULL,'$Prueba', (SELECT MAX(matriz_doc.id_matriz_doc) as idmatriz_doc FROM matriz_doc))";
              $consulta = $this->conn->query($sql);


        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
    

       echo "".$Prueba."<br>";
     
     }           
    }*/

/*
echo "Prueba<br>";

echo "<br>CODIGO ".$codigo_doc."";
echo "<br> codigo 2".$codigo_php."";
echo "<br>Origen ".$origen_doc."";
echo "<br>tipo_doc ".$tipo."";
echo "<br>mproceso ".$mproceso."";
echo "<br>num_doc ".$num_doc."";
echo "<br>nomnbre ".$nombre."";
echo "<br>nUMERO DE VERSION ".$n_version."";
echo "<br>Estado de Ver ".$estado_ver."";
echo "<br>Fecha ".$fecha_elab."";
echo "<br> ubicacion ".$ubicacion."";
echo "<br> observacion ".$observacion."";
echo "<br> responsable ".$responsable."";
echo "<br> almacenamiento ".$almacenamiento."";
echo "<br> proteccion ".$proteccion."";
echo "<br> recuperacion ".$recuperacion."";
echo "<br> retencion ".$retencion."";
echo "<br> disposicion ".$disposicion."";
*/











/*if(($magnitud)== 1 || ($magnitud)== 2 ){
	$clasificacion = 1;
}elseif (( $magnitud)== 3 || ($magnitud)== 4 ) {
	 $clasificacion= 2;
}elseif (($magnitud)== 6 || ($magnitud)== 9) {
	 $clasificacion= 3;
}else{
 $magnitud= "LLamar Encargado";
}*/










//if(empty($_POST['user']) && empty($_POST['pass'])) {

	//echo "Error! No puedes dejar campos vacios";

//}else {

$con = new matrizdoc();
$con->registrarmatrizdoc($id_calculado, $codigo_php, $origen_doc, $tipo, $mproceso, $num_doc, $nombre, $n_version, $estado_ver, $fecha_elab, $ubicacion, $observacion, $responsable,$responsable1, $responsable2, $responsable3, $responsable4, $almacenamiento, $proteccion, $recuperacion, $retencion, $disposicion);

//}





?>