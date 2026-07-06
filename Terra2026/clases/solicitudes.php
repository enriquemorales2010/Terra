<?php  

require 'conexion.php';

class Solicitudes extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarSolicitud($ID, $prioridad, $asunto, $caracteristica, $estado) {

    echo 1;

		$sql = "INSERT INTO solicitud VALUES ('', now(), '$prioridad', '$asunto', '$caracteristica', '$estado', '$ID');";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

	}

	public function listaSolicitudesA() {

		$sql = "SELECT solicitud.ID, solicitud.fecha_hora_creada, solicitud.prioridad, solicitud.asunto, solicitud.caracteristicas, solicitud.status_solicitud_ID, solicitud.incidencia_ID FROM solicitud;";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			if ($consulta->num_rows > 0) {

				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  						<thead>
  							<tr>
  								<th>#</th>
                     	<th>Fecha de Registro</th>
                     	<th>Prioridad</th>
                     	<th>Asunto</th>
                    		<th>Descripción</th>
                    		<th>Incidencia</th>
                    		<th>Estado Solicitud</th>
                     	<th style='width: 115px;'>Operaciones</th>
                  					</tr>
                     				</thead><tbody>";

				while ($fila = mysqli_fetch_assoc($consulta)) {
					if ($fila['status_solicitud_ID'] == 000001) {
         			$estado = "Aprobada";
         			$clase = "btn btn-block btn-success";
  					}elseif ($fila['status_solicitud_ID'] == 000002) {
  						$estado = "Pendiente";
  						$clase = "btn btn-block btn btn-warning";
  					}else {
  						$estado = "Reprobada";
  						$clase = "btn btn-block btn btn-danger";
  					}

  					echo "<tr>
  								<td>".$fila['ID']."</td>
  								<td>".$fila['fecha_hora_creada']."</td>
  								<td>".$fila['prioridad']."</td>
  								<td>".$fila['asunto']."</td>
  								<td>".$fila['caracteristicas']."</td>
  								<td><a href='incidencia_detalles.php?ID=".$fila['incidencia_ID']."'>".$fila['incidencia_ID']."</a></td>
  								<td><button class='".$clase."' value=''>".$estado."</button></td>
  								<td><a type='button' class='btn btn-info' href='editar_solicitud.php?ID=".$fila["ID"]."'> Actualizar Estado</a></td>
  								</tr>";
					
				}
				echo "</tbody></table>";
			}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
               <th>#</th>
                      <th>Fecha de Registro</th>
                      <th>Prioridad</th>
                      <th>Asunto</th>
                        <th>Descripción</th>
                        <th>Incidencia</th>
                        <th>Estado Solicitud</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY SOLICITUDES REGISTRADAS</h3></div>";
                   }
		}

	}

	public function listaSolicitudesB() {

		$sql = "SELECT solicitud.ID, solicitud.fecha_hora_creada, solicitud.prioridad, solicitud.asunto, solicitud.caracteristicas, solicitud.status_solicitud_ID, solicitud.incidencia_ID FROM solicitud;";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			if ($consulta->num_rows > 0) {

				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  						<thead>
  							<tr>
  								<th>#</th>
                     	<th>Fecha de Registro</th>
                     	<th>Prioridad</th>
                     	<th>Asunto</th>
                    		<th>Descripción</th>
                    		<th>Incidencia</th>
                    		<th>Estado Solicitud</th>
                  					</tr>
                     				</thead><tbody>";

				while ($fila = mysqli_fetch_assoc($consulta)) {
					if ($fila['status_solicitud_ID'] == 000001) {
         			$estado = "Aprobada";
         			$clase = "btn btn-block btn-success";
  					}elseif ($fila['status_solicitud_ID'] == 000002) {
  						$estado = "Pendiente";
  						$clase = "btn btn-block btn btn-warning";
  					}else {
  						$estado = "Reprobada";
  						$clase = "btn btn-block btn btn-danger";
  					}

  					echo "<tr>
  								<td>".$fila['ID']."</td>
  								<td>".$fila['fecha_hora_creada']."</td>
  								<td>".$fila['prioridad']."</td>
  								<td>".$fila['asunto']."</td>
  								<td>".$fila['caracteristicas']."</td>
  								<td><a href='incidencia_detalles.php?ID=".$fila['incidencia_ID']."'>".$fila['incidencia_ID']."</a></td>
  								<td><button class='".$clase."' value=''>".$estado."</button></td>
  								</tr>";
					
				}
				echo "</tbody></table>";
			}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
               <th>#</th>
                      <th>Fecha de Registro</th>
                      <th>Prioridad</th>
                      <th>Asunto</th>
                        <th>Descripción</th>
                        <th>Incidencia</th>
                        <th>Estado Solicitud</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY SOLICITUDES REGISTRADAS</h3></div>";
                   }
		}

	}

	public function editarSolicitud($ID, $estado) {

    echo 1;

		$sql = "UPDATE solicitud SET status_solicitud_ID = '$estado' WHERE ID = '$ID';";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

	}

}


?>