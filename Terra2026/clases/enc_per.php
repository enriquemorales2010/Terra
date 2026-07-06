<?php  


require_once 'conexion.php';

class enc_perc extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarencperc($proyecto, $fecha_proyecto, $SelectorItem, $ditem1, $item1, $ditem2, $item2, $ditem3, $item3, $ditem4, $item4, $ditem5, $item5, $ditem6, $item6, $ditem7, $item7, $obs_adi, $nom_enc, $fecha_enc,$promedio) {


      $validacion1 = "SELECT encuesta_percepcion.id_per, encuesta_percepcion.fecha_per, encuesta_percepcion.item1, encuesta_percepcion.ditem1, encuesta_percepcion.item2, encuesta_percepcion.ditem2, encuesta_percepcion.item3, encuesta_percepcion.ditem3, encuesta_percepcion.item4, encuesta_percepcion.ditem4, encuesta_percepcion.item5, encuesta_percepcion.ditem5, encuesta_percepcion.item6, encuesta_percepcion.ditem6, encuesta_percepcion.item7, encuesta_percepcion.ditem7, encuesta_percepcion.obs_gen, encuesta_percepcion.nombre_enc, encuesta_percepcion.fecha, encuesta_percepcion.promedio, encuesta_percepcion.edificio_id_ed FROM encuesta_percepcion 
                  INNER JOIN edificio ON encuesta_percepcion.edificio_id_ed = edificio.id_ed WHERE encuesta_percepcion.fecha_per = '$fecha_proyecto' AND 
                  encuesta_percepcion.edificio_id_ed = '$proyecto' AND encuesta_percepcion.nombre_enc = '$nom_enc';";
      $con_validacion1 = $this->conn->query($validacion1);
      
      if ($con_validacion1->num_rows <= 0) {
        
        echo 1;
      
       $sql = "INSERT INTO encuesta_percepcion(id_per, fecha_per, tipo, item1, ditem1, item2, ditem2, item3, ditem3, item4, ditem4, item5, ditem5, item6, ditem6, item7, ditem7, obs_gen, nombre_enc, fecha, promedio, edificio_id_ed) VALUES (NULL,'$fecha_proyecto','$SelectorItem','$item1','$ditem1','$item2','$ditem2','$item3','$ditem3','$item4','$ditem4','$item5','$ditem5','$item6','$ditem6','$item7','$ditem7','$obs_adi','$nom_enc','$fecha_enc','$promedio','$proyecto');";
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
	


 	  public function listaencuesta() {

      $sql = "SELECT encuesta_percepcion.id_per, encuesta_percepcion.fecha_per, encuesta_percepcion.item1, encuesta_percepcion.ditem1, encuesta_percepcion.item2, encuesta_percepcion.ditem2, encuesta_percepcion.item3, encuesta_percepcion.ditem3, encuesta_percepcion.item4, encuesta_percepcion.ditem4, encuesta_percepcion.item5, encuesta_percepcion.ditem5, encuesta_percepcion.item6, encuesta_percepcion.ditem6, encuesta_percepcion.item7, encuesta_percepcion.ditem7, encuesta_percepcion.obs_gen, encuesta_percepcion.nombre_enc, encuesta_percepcion.fecha, encuesta_percepcion.promedio, encuesta_percepcion.edificio_id_ed, edificio.nom_ed FROM encuesta_percepcion 
                  INNER JOIN edificio ON encuesta_percepcion.edificio_id_ed = edificio.id_ed";
      $consulta = $this->conn->query($sql);



        if ($consulta->num_rows > 0) {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                     <th>ID</th>
                     <th>Proyecto</th>
                     <th>Mes</th>
                     <th>Año</th>
                     <th>Encuestado</th>
                     <th>Promedio</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
          while ($fila = mysqli_fetch_assoc($consulta)) {
            
          /* 

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
            
          */


            echo "<tr>
              <td>".$fila['id_per']."</td>
              <td>".$fila['nom_ed']."</td>
              <td>".$fila['fecha_per']."</td>
              <td>".$fila['fecha_per']."</td>
              <td>".$fila['nombre_enc']."</td>
              <td>".$fila['promedio']."</td>
              
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_enc_perc.php?id_per=".$fila["id_per"]."'> Editar</a>
              </td>
          </tr>";
            }

            
          echo "</tbody></table>";
        }else {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                 <th>ID</th>
                     <th>Proyecto</th>
                     <th>Mes</th>
                     <th>Año</th>
                     <th>Encuestado</th>
                     <th>Promedio</th>
                     <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY ENCUESTAS REGISTRADAS</h3></div>";
        }

       }

  public function editarencperc($id_per, $proyecto, $fecha_proyecto, $SelectorItem, $ditem1, $item1, $ditem2, $item2, $ditem3, $item3, $ditem4, $item4, $ditem5, $item5, $ditem6, $item6, $ditem7, $item7, $obs_adi, $nom_enc, $fecha_enc,$promedio) {

       $validacion1 = "SELECT encuesta_percepcion.id_per, encuesta_percepcion.fecha_per, encuesta_percepcion.item1, encuesta_percepcion.ditem1, encuesta_percepcion.item2, encuesta_percepcion.ditem2, encuesta_percepcion.item3, encuesta_percepcion.ditem3, encuesta_percepcion.item4, encuesta_percepcion.ditem4, encuesta_percepcion.item5, encuesta_percepcion.ditem5, encuesta_percepcion.item6, encuesta_percepcion.ditem6, encuesta_percepcion.item7, encuesta_percepcion.ditem7, encuesta_percepcion.obs_gen, encuesta_percepcion.nombre_enc, encuesta_percepcion.fecha, encuesta_percepcion.promedio, encuesta_percepcion.edificio_id_ed FROM encuesta_percepcion 
                  INNER JOIN edificio ON encuesta_percepcion.edificio_id_ed = edificio.id_ed WHERE encuesta_percepcion.fecha_per = '$fecha_proyecto' AND 
                  encuesta_percepcion.edificio_id_ed = '$proyecto' AND encuesta_percepcion.nombre_enc = '$nom_enc';";
      $con_validacion1 = $this->conn->query($validacion1);

   if ($con_validacion1->num_rows <= 1) {
        
        echo 1;
      
       $sql = "UPDATE encuesta_percepcion SET fecha_per='$fecha_proyecto', tipo = '$SelectorItem', item1='$item1',ditem1='$ditem1',item2='$item2',ditem2='$ditem2',item3='$item3',ditem3='$ditem3',item4='$item4',ditem4='$ditem4',item5='$item5',ditem5='$ditem5',item6='$item6',ditem6='$ditem6',item7='$item7',ditem7='$ditem7',obs_gen='$obs_adi',nombre_enc='$nom_enc',fecha='$fecha_enc',promedio='$promedio',edificio_id_ed='$proyecto' WHERE id_per = '$id_per';";
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