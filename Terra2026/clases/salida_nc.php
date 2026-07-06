<?php  


require_once 'conexion.php';

class salida_nc extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarsalida($id_s, $area, $accion_a, $etapa, $ubicacion, $desc_sal_1, $evidencia_1, $nom_enc_1, $funcion_1, $origen_1,$fecha_sa_1, $desc_ac_in_2, $nom_enc_2, $funcion_2, $fecha_ac_in_2, $desc_ana_eva_3, $desc_int_3, $desc_imple_4, $nom_enc_4, $fecha_ac_co_4, $funcion_4, $aceptacion_5,$obs_acep_5, $nom_enc_5, $fecha_acep_5, $nom_enc_6, $funcion_6, $fecha_cie_6, $agregar_m ,$proyecto, $estado) {


      $validacion1 = "SELECT * FROM salida_no_c WHERE id_auto = NULL or (id_S_N_C = '$id_s' and edificio_id_ed = '$proyecto');";
      $con_validacion1 = $this->conn->query($validacion1);

    
      if ($con_validacion1->num_rows <= 0 ) {
        
        echo 1;

         $sql = "INSERT INTO salida_no_c (id_auto, id_S_N_C, Area, act_afec, etapa, ubicacion, desc_sal_nc_1, nom_enc_sal_nc_1, evidencia_sal_nc_1, fun_enc_sal_nc_1, origen_sal_nc_1, fecha_sal_nc_1, desc_ac_2, nom_enc_ac_2, funcion_2,fecha_ac_2, desc_ev_3, par_int_ev_3, imp_ac_co_4, nom_enc_ac_co_4, funcion_4,fecha_ac_co_4, aceptacion_5, obs_ac_ac_sa_5, nom_enc_ac_sa_5, fecha_ac_sa_5, nom_enc_cie_6, funcion_6, fecha_cie_6, agregar_m, edificio_id_ed, estado_m) VALUES ( NULL ,'$id_s',
          '$area',
          '$accion_a', 
          '$etapa',
          '$ubicacion',
          '$desc_sal_1',
          '$nom_enc_1',
          '$evidencia_1', 
          '$funcion_1',
          '$origen_1',
          '$fecha_sa_1', 
          '$desc_ac_in_2', 
          '$nom_enc_2', 
          '$funcion_2',
          '$fecha_ac_in_2', 
          '$desc_ana_eva_3', 
          '$desc_int_3', 
          '$desc_imple_4', 
          '$nom_enc_4',
          '$funcion_4', 
          '$fecha_ac_co_4',   
          '$aceptacion_5',
          '$obs_acep_5', 
          '$nom_enc_5', 
          '$fecha_acep_5', 
          '$nom_enc_6', 
          '$funcion_6', 
          '$fecha_cie_6',
          '$agregar_m', 
          '$proyecto',
          '$estado');";
        $consulta = $this->conn->query($sql);

     



        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
      }else {
          echo 0;
      }

 

  	}//registrarUsuario
	
	public function listaSalida() {

  		$sql = "SELECT salida_no_c.id_auto, salida_no_c.id_S_N_C, salida_no_c.Area, salida_no_c.desc_sal_nc_1, salida_no_c.nom_enc_sal_nc_1, salida_no_c.fun_enc_sal_nc_1 , salida_no_c.origen_sal_nc_1 , salida_no_c.fecha_sal_nc_1, salida_no_c.desc_ac_2, salida_no_c.fecha_cie_6, salida_no_c.estado_m, edificio.nom_ed FROM salida_no_c INNER JOIN edificio ON salida_no_c.edificio_id_ed = edificio.id_ed";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_edificios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							   <th>N° Salida</th>
                   <th>Proyecto</th>
                   <th>Area</th>
                   <th>Fecha de Inicio</th>
                   <th>Fecha de Cierre</th>
                   <th>Estado</th>
                   <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {

            


             switch ($fila['estado_m']) {
            case 0 :
            $estado = "Pendiente";
            $clase = "btn btn-xs btn-block btn-info";
            break;
            
            case 1 :
            $estado = "Cerrado";
            $clase = "btn btn-xs btn-block btn-success";
            break;
            
            case  2 :
            $estado = "Sin Analizar";
            $clase = "btn btn-xs btn-block btn-warning";
            break;

            default:
            $estado = "Llamar encargado";
            $clase = "btn btn-xs btn-block btn-danger";
            break;
            }   





            
              /*  if ($fila['fecha_rec'] == "" ){
                    $recepcion = "Aun en espera";
                    
                    }else {
                     $recepcion = $fila['fecha_rec'];
                     $recepcion = date("d-m-Y",strtotime($recepcion));
                   };*/




            switch ($fila['Area']) {
            case '1':
            $des_Area = "Finanza";
            break;
            
            case '2':
            $des_Area = "Prevención Riesgo";
            break;
            
            case '3':
            $des_Area = "Adquisiones";
            break;

            case '4':
            $des_Area = "S. de Gestion de Calidad";
            break;

            case '5':
            $des_Area = "Estudio de Proyectos";
            break;

            case '6':
            $des_Area = "Ejecución de Obra";
            break;

            default:
            echo "Error en la cedula";
            break;
            }         
            

            $fecha_inicio = $fila['fecha_sal_nc_1'];
             //$fecha_inicio = date("d-m-Y",strtotime($fecha_inicio));
            if ($fecha_inicio == 0 or $fecha_inicio == "1900-01-01") {
              $fecha_inicio = "S/F";
            }elseif ($fecha_inicio <> 0) {
              $fecha_inicio = $fila['fecha_sal_nc_1'];
            $fecha_inicio = date("d-m-Y",strtotime($fecha_inicio));
            } else{
              $fecha_inicio = "LLamar a Encargado Pivot Data";
            }



            $fecha_cierre = $fila['fecha_cie_6'];
            if ($fecha_cierre == 0 or $fecha_cierre == "1900-01-01") {
              $fecha_cierre = "S/F";
            }elseif ($fecha_cierre <> 0) {
              $fecha_cierre = $fila['fecha_cie_6'];
            $fecha_cierre = date("d-m-Y",strtotime($fecha_cierre));
            } else{
              $fecha_cierre = "LLamar a Encargado Pivot Data";
            }
            

         		echo "<tr>
         			<td>".$fila['id_S_N_C']."</td>
         			<td>".$fila['nom_ed']."</td>
              <td>".$des_Area."</td>
              <td>".$fecha_inicio."</td>
              <td>".$fecha_cierre."</td>
              <td><a type='button' class='".$clase."' disabled> ".$estado."</a></td>
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_salida_noc.php?id_auto=".$fila["id_auto"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                   <th>N° Salida</th>
                   <th>Proyecto</th>
                   <th>Area</th>
                   <th>Fecha de Inicio</th>
                   <th>Fecha de Cierre</th>
                   <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY SALIDA REGISTRADAS</h3></div>";
        }

 		   }

 	}

  public function editarsalida($id_s, $serial, $area, $accion_a, $etapa, $ubicacion, $desc_sal_1, $evidencia_1, $nom_enc_1, $funcion_1, $origen_1,$fecha_sa_1, $desc_ac_in_2, $nom_enc_2,  $funcion_2, $fecha_ac_in_2, $desc_ana_eva_3, $desc_int_3, $desc_imple_4, $nom_enc_4, $fecha_ac_co_4, $funcion_4, $aceptacion_5,$obs_acep_5, $nom_enc_5, $fecha_acep_5, $nom_enc_6, $funcion_6, $fecha_cie_6, $agregar_m ,$proyecto, $estado) {


      $validacion2 = "SELECT * FROM salida_no_c WHERE id_auto = '$id_s';";
      $con_validacion2 = $this->conn->query($validacion2);

      echo 1;

    $sql = "UPDATE salida_no_c SET  
     id_S_N_C = '$serial',
     Area = '$area',
     act_afec = '$accion_a',
     etapa = '$etapa',
     ubicacion = '$ubicacion',
     desc_sal_nc_1 = '$desc_sal_1', 
     nom_enc_sal_nc_1 = '$nom_enc_1',
     evidencia_sal_nc_1 = '$evidencia_1',
     fun_enc_sal_nc_1 = '$funcion_1', 
     origen_sal_nc_1 = '$origen_1',
     fecha_sal_nc_1 = '$fecha_sa_1',
     desc_ac_2 = '$desc_ac_in_2', 
     nom_enc_ac_2 = '$nom_enc_2', 
     funcion_2 = '$funcion_2',
     fecha_ac_2 = '$fecha_ac_in_2',
     desc_ev_3 = '$desc_ana_eva_3', 
     par_int_ev_3 = '$desc_int_3', 
     imp_ac_co_4 = '$desc_imple_4', 
     nom_enc_ac_co_4 = '$nom_enc_4',
     funcion_4 = '$funcion_4', 
     fecha_ac_co_4 = '$fecha_ac_co_4', 
     aceptacion_5 = '$aceptacion_5', 
     obs_ac_ac_sa_5 = '$obs_acep_5', 
     nom_enc_ac_sa_5 = '$nom_enc_5', 
     fecha_ac_sa_5 = '$fecha_acep_5', 
     nom_enc_cie_6 = '$nom_enc_6', 
     funcion_6 = '$funcion_6', 
     fecha_cie_6 = '$fecha_cie_6', 
     agregar_m = '$agregar_m',
     edificio_id_ed = '$proyecto',
     estado_m = '$estado'

     WHERE id_auto = '$id_s';";
    $consulta = $this->conn->query($sql);


      if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }

  }

  

}


?>