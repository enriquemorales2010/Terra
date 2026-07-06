<?php  


require_once 'conexion.php';

class estadisticas extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarestadistica($proyecto,$month, $years, $fecha, $perdidos,$arrastrados, $accidentados, $profesionales) {


      $validacion1 = "SELECT estadisticas.idestadisticas, estadisticas.mes, estadisticas.year, estadisticas.fecha, estadisticas.perdidos, estadisticas.arrastrados, estadisticas.accidentados, estadisticas.profesionales, estadisticas.edificio_id_ed, edificio.nom_ed FROM estadisticas 
                  INNER JOIN edificio ON estadisticas.edificio_id_ed = edificio.id_ed WHERE estadisticas.fecha = '$fecha' AND 
                  estadisticas.edificio_id_ed = '$proyecto';";
      $con_validacion1 = $this->conn->query($validacion1);
      
      if ($con_validacion1->num_rows <= 0) {
        
        echo 1;
      
       $sql = "INSERT INTO estadisticas(idestadisticas, mes, year, fecha, perdidos, arrastrados, accidentados, profesionales, edificio_id_ed) VALUES ( NULL ,'$month','$years','$fecha','$perdidos','$arrastrados','$accidentados','$profesionales','$proyecto');";
       $consulta = $this->conn->query($sql);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
      }else {
          echo 0;
      }
  	}//registrar
	
	public function listaestadistica() {

  		$sql = " SELECT estadisticas.idestadisticas, estadisticas.mes, estadisticas.year, estadisticas.perdidos, estadisticas.arrastrados, estadisticas.accidentados, estadisticas.profesionales, estadisticas.edificio_id_ed, edificio.nom_ed FROM estadisticas 
                  INNER JOIN edificio ON estadisticas.edificio_id_ed = edificio.id_ed";
  		$consulta = $this->conn->query($sql);



  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							     <th>ID</th>
                     <th>Proyecto</th>
                     <th>Mes</th>
                     <th>Año</th>
                     <th>Accidentados</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		
           

            if($fila['mes'] ==1){
            $monthName = 'Enero';
            }elseif($fila['mes'] ==2){
            $monthName = 'Febrero';
            }elseif($fila['mes'] ==3){
            $monthName = 'Marzo';
            }elseif($fila['mes'] ==4){
            $monthName = 'Abril';
            }elseif($fila['mes'] ==5){
            $monthName = 'Mayo';
            }elseif($fila['mes'] ==6){
            $monthName = 'Junio';
            }elseif($fila['mes'] ==7){
            $monthName = 'Julio';
            }elseif($fila['mes'] ==8){
            $monthName = 'Agosto';
            }elseif($fila['mes'] ==9){
            $monthName = 'Septiembre';
            }elseif($fila['mes'] ==10){
            $monthName = 'Octubre';
            }elseif($fila['mes'] ==11){
            $monthName = 'Noviembre';
            }elseif($fila['mes'] ==12){
            $monthName = 'Diciembre';
            }else{
              $monthName = 'Algo Paso';
            }
            



         		echo "<tr>
         			<td>".$fila['idestadisticas']."</td>
         			<td>".$fila['nom_ed']."</td>
         			<td>".$monthName."</td>
         			<td>".$fila['year']."</td>
              <td>".$fila['accidentados']."</td>
              
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_estadistica.php?idestadisticas=".$fila["idestadisticas"]."'> Editar</a>
              </td>
					</tr>";
            }

        		
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_edificios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                 <th>ID</th>
                     <th>Proyecto</th>
                     <th>Mes</th>
                     <th>Año</th>
                     <th>Accidentados</th>
                     <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY ESTADISTICAS REGISTRADAS</h3></div>";
        }

 		   }

 	

  public function editarestadistica($id, $fecha, $month, $years, $proyecto, $perdidos, $arrastrados, $accidentados, $profesionales) {

       $validacion1 = "SELECT estadisticas.idestadisticas, estadisticas.mes, estadisticas.year, estadisticas.fecha, estadisticas.perdidos, estadisticas.arrastrados, estadisticas.accidentados, estadisticas.profesionales, estadisticas.edificio_id_ed, edificio.nom_ed FROM estadisticas 
                  INNER JOIN edificio ON estadisticas.edificio_id_ed = edificio.id_ed WHERE estadisticas.fecha = '$fecha' AND 
                  estadisticas.edificio_id_ed = '$proyecto';";
      $con_validacion1 = $this->conn->query($validacion1);

   if ($con_validacion1->num_rows <= 1) {
        
        echo 1;
      
      $sql = "UPDATE estadisticas SET 
       mes ='$month',
       year ='$years',
       fecha ='$fecha',
       perdidos ='$perdidos',
       arrastrados ='$arrastrados',
       accidentados ='$accidentados',
       profesionales ='$profesionales', 
       edificio_id_ed ='$proyecto' 
       WHERE estadisticas.idestadisticas = '$id';";
       $consulta = $this->conn->query($sql);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
      }else {
          echo 0;
      }

}
}


?>