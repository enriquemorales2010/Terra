<?php  


require_once 'conexion.php';

class matrizdoc extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarmatrizdoc($id_calculado, $codigo_php, $origen_doc, $tipo, $mproceso, $num_doc, $nombre, $n_version, $estado_ver, $fecha_elab, $ubicacion, $observacion, $responsable, $responsable1, $responsable2, $responsable3, $responsable4, $almacenamiento, $proteccion, $recuperacion, $retencion, $disposicion) {


      $validacion1 = "SELECT matriz_doc.id_matriz_doc, matriz_doc.codigo_doc, matriz_doc.orig_doc, matriz_doc.macroproceso, matriz_doc.tipo_doc, matriz_doc.num_doc, matriz_doc.detalle_doc, matriz_doc.n_ver, matriz_doc.estado_ver, matriz_doc.fecha_elab_ver, matriz_doc.obs_ver, matriz_doc.ubi_ver, matriz_doc.respo_reg, matriz_doc.respo_reg1, matriz_doc.respo_reg2, matriz_doc.respo_reg3, matriz_doc.respo_reg4, matriz_doc.alm_reg, matriz_doc.prot_reg, matriz_doc.recup_reg, matriz_doc.tiempo_reg, matriz_doc.dispo_reg FROM matriz_doc WHERE matriz_doc.id_matriz_doc = NULL ;";
      $con_validacion1 = $this->conn->query($validacion1);

      $validacion2 = "SELECT matriz_doc.id_matriz_doc, matriz_doc.codigo_doc, matriz_doc.orig_doc, matriz_doc.macroproceso, matriz_doc.tipo_doc, matriz_doc.num_doc, matriz_doc.detalle_doc, matriz_doc.n_ver, matriz_doc.estado_ver, matriz_doc.fecha_elab_ver, matriz_doc.obs_ver, matriz_doc.ubi_ver, matriz_doc.respo_reg, matriz_doc.alm_reg, matriz_doc.prot_reg, matriz_doc.recup_reg, matriz_doc.tiempo_reg, matriz_doc.dispo_reg FROM matriz_doc WHERE matriz_doc.codigo_doc = '$codigo_php' ;";
      $con_validacion2 = $this->conn->query($validacion2);


      if ($con_validacion1->num_rows == 0 and $con_validacion2->num_rows == 0) {

      echo 1;
        $sql ="INSERT INTO matriz_doc( id_matriz_doc, codigo_doc,orig_doc,macroproceso, tipo_doc, num_doc, detalle_doc, n_ver, estado_ver, fecha_elab_ver, obs_ver, ubi_ver, respo_reg, respo_reg1, respo_reg2, respo_reg3, respo_reg4, alm_reg, prot_reg, recup_reg, tiempo_reg, dispo_reg) VALUES ( 
       NULL,'$codigo_php', '$origen_doc', '$mproceso', '$tipo','$num_doc', '$nombre','$n_version','$estado_ver','$fecha_elab','$observacion','$ubicacion','$responsable', '$responsable1', '$responsable2','$responsable3', '$responsable4','$almacenamiento','$proteccion','$recuperacion', '$retencion','$disposicion');";
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
	
	public function listamatrizdoc() {

  		$sql = "SELECT matriz_doc.id_matriz_doc, matriz_doc.codigo_doc, matriz_doc.orig_doc, matriz_doc.macroproceso, matriz_doc.tipo_doc, matriz_doc.num_doc, matriz_doc.detalle_doc, matriz_doc.n_ver, matriz_doc.estado_ver, matriz_doc.fecha_elab_ver, matriz_doc.obs_ver, matriz_doc.ubi_ver, matriz_doc.respo_reg, matriz_doc.alm_reg, matriz_doc.prot_reg, matriz_doc.recup_reg, matriz_doc.tiempo_reg, matriz_doc.dispo_reg FROM matriz_doc";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							   <th>Codigo</th>
                   <th>Nombre</th>
                   <th>Macroproceso</th>
                   <th>Origen</th>
                   <th>Fecha</th>
                   <th>Estado</th>
                   <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		if ($fila['estado_ver'] == 1) {
         			$estado = "Aprobado";
         			$clase = "btn btn-xs btn-block btn-success";
  					}
            elseif ($fila['estado_ver'] == 2) {
              $estado = "En Elaboracion";
              $clase = "btn btn-xs btn-block btn-info";
            }
            elseif ($fila['estado_ver'] == 3) {
              $estado = "En Revisión";
              $clase = "btn btn-xs btn-block btn-warning";
            }else {
  						$estado = "Obsoleto";
  						$clase = "btn btn-xs btn-block  btn-danger";
  					}


              /*
                if ($fila['fecha_rec'] == "" ){
                    $recepcion = "Aun en espera";
                    
                    }else {
                     $recepcion = $fila['fecha_rec'];
                     $recepcion = date("d-m-Y",strtotime($recepcion));
                   };*/

                /*
                Sistema De Gestión = 000001
                Prevención De Riesgos = 000002
                Recursos Humanos = 000003
                Contabilidad = 000004
                Adquisiciones= 000005
                Comunicaciones = 000006
                Revisión Por La Dirección = 000007
                Información Documentada = 000008
                Auditoria = 000009
                No Conformidad Y Acc. Correctiva = 000010*/




            switch ($fila['macroproceso']) {
            case '1':
            $mproceso = "Adquisiciones";
            break;
            
            case '2':
            $mproceso = "Ejecución de obra";
            break;
            
            case '3':
            $mproceso = "Estudio de propuesta";
            break;

            case '4':
            $mproceso = "Finanzas";
            break;

            case '5':
            $mproceso = "Post-ventas";
            break;

            case '6':
            $mproceso = "Prevención de riesgos";
            break;

            case '7':
            $mproceso = "Recursos humanos";
            break;

            case '8':
            $mproceso = "Sistema de Gestión";
            break;

            default:
            $mproceso = "Error Llamar Encargado Pivot Data";
            break;
            }

             switch ($fila['orig_doc']) {
            case '1':
            $ubica = "Interno";
            break;
            
            case '2':
            $ubica = "Externo";
            break;
            

            default:
            $ubica = "Error Llamar Encargado Pivot Data";
            break;
            }                   
            
             

            $fecha = $fila['fecha_elab_ver'];
            $fecha = date("d-m-Y",strtotime($fecha));

           

         		echo "<tr>
         			<td>".$fila['codigo_doc']."</td>
         			<td>".$fila['detalle_doc']."</td>
              <td>".$mproceso."</td>
              <td>".$ubica."</td>
              <td>".$fecha."</td>
              <td><a type='button' class='".$clase."'>".$estado."</a>
              </td>
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_matriz_doc.php?id_matriz_doc=".$fila["id_matriz_doc"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                   <th>Codigo</th>
                   <th>Nombre</th>
                   <th>Macroproceso</th>
                   <th>Origen</th>
                   <th>Fecha</th>
                   <th>Estado</th>
                   <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY DOCUMENTACIÓN REGISTRADAS</h3></div>";
        }

 		   }

 	}

  public function editararmatrizdoc($id_doc, $codigo_php, $origen_doc, $tipo, $mproceso, $num_doc, $nombre, $n_version, $estado_ver, $fecha_elab, $ubicacion, $observacion, $responsable, $responsable1, $responsable2, $responsable3, $responsable4, $almacenamiento, $proteccion, $recuperacion, $retencion, $disposicion) {


      $validacion2 = "SELECT * FROM matriz_doc WHERE id_matriz_doc = '$id_doc';";
      $con_validacion2 = $this->conn->query($validacion2);

      
    if ($con_validacion2->num_rows > 0  ) {
        

     $sql = "UPDATE matriz_doc SET 
     codigo_doc='$codigo_php',
     orig_doc='$origen_doc',
     macroproceso='$mproceso',
     tipo_doc='$tipo',
     num_doc='$num_doc',
     detalle_doc='$nombre',
     n_ver='$n_version',
     estado_ver='$estado_ver',
     fecha_elab_ver='$fecha_elab',
     obs_ver='$observacion',
     ubi_ver='$ubicacion',
     respo_reg='$responsable',
     respo_reg1='$responsable1',
     respo_reg2='$responsable2',
     respo_reg3='$responsable3',
     respo_reg4='$responsable4',
     alm_reg='$almacenamiento',
     prot_reg='$proteccion',
     recup_reg='$recuperacion',
     tiempo_reg='$retencion',
     dispo_reg='$disposicion' 
     WHERE  id_matriz_doc= '$id_doc';";
     echo 1;


    $consulta = $this->conn->query($sql);

          return TRUE;

        }else {

          die(($this->conn->error));
           echo 0;

    
         
      }
      }

   
}

     

?>