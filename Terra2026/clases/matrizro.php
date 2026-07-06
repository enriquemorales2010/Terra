<?php  


require_once 'conexion.php';

class matrizro extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarmatriz($proceso, $contexto, $part_int, $rie_opo, $suceso, $consecuencia, $probabilidad, $severidad, $magnitud, $clasificacion, $optradio, $descripcion_2, $frecuencia, $funcion_1, $plazo, $eficacia, $evidencia1, $fecha, $estado) {


      $validacion1 = "SELECT  matriz_r_o.caso , matriz_r_o.proceso  ,matriz_r_o.contexto, matriz_r_o.part_int, matriz_r_o.descrip_1, matriz_r_o.dec_o_r, matriz_r_o.con_pre, matriz_r_o.probabilidad, matriz_r_o.severidad,  matriz_r_o.magnitud, matriz_r_o.clasificacion, matriz_r_o.dec_acc, matriz_r_o.desc_acc, matriz_r_o.frecuencia, matriz_r_o.responsable, matriz_r_o.plazo, matriz_r_o.eficacia, matriz_r_o.fecha,  matriz_r_o.objetivo, matriz_r_o.estado  FROM  matriz_r_o WHERE matriz_r_o.caso = NULL ;";
      $con_validacion1 = $this->conn->query($validacion1);

    
      if ($con_validacion1->num_rows <= 0 ) {
        
        echo 1;

         $sql = "INSERT INTO matriz_r_o (caso, proceso, contexto, part_int, descrip_1, dec_o_r, con_pre, probabilidad, severidad, magnitud, clasificacion, dec_acc, desc_acc, frecuencia, plazo, responsable, fecha, eficacia, objetivo, estado) VALUES ( NULL,
          '$proceso',
          '$contexto', 
          '$part_int',
          '$suceso',
          '$rie_opo',
          '$consecuencia',
          '$probabilidad', 
          '$severidad',
          '$magnitud',
          '$clasificacion',
          '$optradio',
          '$descripcion_2',
          '$frecuencia',
          '$plazo',
          '$funcion_1',
          '$fecha',
          '$eficacia',
          '$evidencia1',
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
	
	public function listamatriz() {

  		$sql = "SELECT  matriz_r_o.caso , matriz_r_o.proceso  ,matriz_r_o.contexto, matriz_r_o.part_int, matriz_r_o.descrip_1, matriz_r_o.dec_o_r, matriz_r_o.con_pre, matriz_r_o.probabilidad, matriz_r_o.severidad,  matriz_r_o.magnitud, matriz_r_o.clasificacion, matriz_r_o.dec_acc, matriz_r_o.desc_acc, matriz_r_o.frecuencia, matriz_r_o.plazo, matriz_r_o.fecha,  matriz_r_o.objetivo, matriz_r_o.estado  FROM  matriz_r_o";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							   <th>N° Caso</th>
                   <th>Proyecto</th>
                   <th>Parte Int.</th>
                   <th>Clasificacion</th>
                   <th>Fecha</th>
                   <th>Estado</th>
                   <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		if ($fila['estado'] == 1) {
         			$estado = "Finalizado";
         			$clase = "btn btn-xs btn-block btn-success";
  					}else {
  						$estado = "Pendiente";
  						$clase = "btn btn-xs btn-block  btn-warning";
  					}




        


            switch ($fila['proceso']) {
            case '1':
            $des_pro = "Sistema De Gestión";
            break;
            
            case '2':
            $des_pro = "Prevención de Riesgo";
            break;
            
            case '3':
            $des_pro = "Recursos Humanos";
            break;

            case '4':
            $des_pro = "Contabilidad";
            break;

            case '5':
            $des_pro = " Adquisiciones";
            break;

            case '6':
            $des_pro = "Comunicaciones";
            break;

            case '7':
            $des_pro = "Revisión Por La Dirección";
            break;

            case '8':
            $des_pro = "Información Documentada";
            break;

            case '9':
            $des_pro = "Auditoria";
            break;

            case '10':
            $des_pro = "No Conformidad Y Acc. Correctiva";
            break;

            case '11':
            $des_pro = "Ejecución de Obra";
            break;


            case '12':
            $des_pro = "Diseño y Desarrollo (Inmobiliaria)";
            break;

            default:
            $des_pro = "Error Llamar Encargado Pivot Data";
            break;
            }


             switch ($fila['part_int']) {
            case '1':
            $des_part = "Cliente (Inmobiliaria)";
            break;
            
            case '2':
            $des_part = "Cliente Final";
            break;
            
            case '3':
            $des_part = "Proveedor De Productos";
            break;

            case '4':
            $des_part = "Proveedor De Servidores";
            break;

            case '5':
            $des_part = "Colaboradores";
            break;

            case '6':
            $des_part = "Competidores";
            break;

            case '7':
            $des_part = "Sociedad";
            break;

            default:
            $des_part = "Error Llamar Encargado Pivot Data";
            break;
            }                   
            
             switch ($fila['clasificacion']) {
            case '1':
            $des_clas = "Riesgo Bajo";
            break;
            
            case '2':
            $des_clas = "Riesgo Medio";
            break;
            
            case '3':
            $des_clas = "Riesgo Alto";
            break;

           

            default:
            $des_clas = "Error Llamar Encargado Pivot Data";
            break;
            }          

            $fecha = $fila['fecha'];
            $fecha = date("d-m-Y",strtotime($fecha));

           

         		echo "<tr>
         			<td>".$fila['caso']."</td>
         			<td>".$des_pro."</td>
              <td>".$des_part."</td>
              <td>".$des_clas."</td>
              <td>".$fecha."</td>
              <td><a type='button' class='".$clase."'>".$estado."</a>
              </td>
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_matrizro.php?caso=".$fila["caso"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                   <th>N° Caso</th>
                   <th>Proyecto</th>
                   <th>Parte Int.</th>
                   <th>Clasificacion</th>
                   <th>Fecha</th>
                   <th>Fecha</th>
                   <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY SALIDA REGISTRADAS</h3></div>";
        }

 		   }

 	}

  public function editarmatriz($proceso, $contexto, $part_int, $rie_opo, $suceso, $consecuencia, $probabilidad,$magnitud, $clasificacion, $severidad, $optradio, $descripcion_2, $frecuencia, $funcion_1, $plazo, $eficacia, $evidencia1, $fecha, $estado, $caso) {


      $validacion2 = "SELECT * FROM matriz_r_o WHERE caso = '$caso';";
      $con_validacion2 = $this->conn->query($validacion2);

      

     $sql = "UPDATE matriz_r_o SET 
     proceso = '$proceso', 
     contexto='$contexto', 
     part_int = '$part_int', 
     descrip_1 ='$suceso' , 
     dec_o_r = '$rie_opo', 
     con_pre='$consecuencia', 
     probabilidad='$probabilidad',
     severidad ='$severidad',
     magnitud = '$magnitud', 
     clasificacion= '$clasificacion', 
     dec_acc= '$optradio',
     desc_acc='$descripcion_2', 
     frecuencia='$frecuencia',
     plazo='$plazo',
     eficacia = '$eficacia',
     responsable='$funcion_1',
     fecha='$fecha', 
     objetivo='$evidencia1',
     estado='$estado'
     WHERE caso = '$caso';";
     echo 1;
    $consulta = $this->conn->query($sql);


      if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }

  }

  

}


?>