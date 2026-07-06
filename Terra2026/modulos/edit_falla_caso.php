<?php  


require_once '../clases/postventas.php';


$idn = $_POST['falla'];
$actual = $_POST['fallaa'];
$casofalla = $_POST['caso_falla'];
$valor = 0; 

/*idn =  valor del select
  actual = Valor del Input hidden
  valor = Guarda	
*/


  if($idn){

 if($idn == 0) {

 $valor = $actual;

 }elseif ($idn > 0) {

 	$valor = $idn;

 }else{
 	$valor = $valor;
 }

}











$con = new postventas();
$con->editarfallacaso($valor,$casofalla);


?>