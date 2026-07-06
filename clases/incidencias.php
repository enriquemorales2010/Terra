<?php  


require 'conexion.php';

class Incidencias extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarIncidencia($tipo, $descripcion, $matricula, $ID_usuario, $status_incidencia) {

    echo 1;

		$sql = "INSERT INTO incidencia VALUES ('', now(), '$tipo', '$descripcion',  '', '$ID_usuario', '$matricula', '$status_incidencia');";
		$consulta = $this->conn->query($sql);

		$sql = "UPDATE vehiculo SET estado = 2 WHERE matricula = '$matricula';";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			
			return TRUE;

		}else {

			die(($this->conn->error));

		}

	}

	public function listaIncidencias() {

		$sql = "SELECT * FROM incidencia;";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			
			if ($consulta->num_rows > 0) {

				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  						<thead>
  							<tr>
  								<th>#</th>
                     						<th>Fecha de Registro</th>
                     						<th>Tipo de Mantenimiento</th>
                     						<th>Descripción</th>
                    						<th>Usuario</th>
                    					 	<th>Matrícula del Vehículo</th>
                                <th>Fecha Cambio de Estado</th>
                     						<th style='width: 115px;'>Operaciones</th>
                                <th>Estado Incidencia</th>
                  					</tr>
                     				</thead><tbody>";
				
				while ($fila = mysqli_fetch_assoc($consulta)) {
					if ($fila['status_incidencia_ID'] == 000001) {
         			$estado = "Finalizada";
         			$clase = "btn btn-block btn-success";
  					}elseif ($fila['status_incidencia_ID'] == 000002) {
  						$estado = "En Progreso";
  						$clase = "btn btn-block btn-warning";
  					}else {
  						$estado = "Paralizado";
  						$clase = "btn btn-block btn-danger";
  					}

  					echo "<tr>
         			<td>".$fila['ID']."</td>
         			<td>".$fila['fecha_hora_creada']."</td>
         			<td>".$fila['tipo']."</td>
         			<td>".$fila['descripcion']."</td>
         			<td>".$fila['usuario_CI']."</td>
         			<td>".$fila['vehiculo_matricula']."</td>
              <td>".$fila['fecha_hora_fin']."</td>
              <td>
                <div class='btn-group'>
    <a type='button' class='btn btn-info' href='incidencia_detalles.php?ID=".$fila["ID"]."'>Ver Detalles</a>
    <button type='button' class='btn btn-info  dropdown-toggle' data-toggle='dropdown'>
      <span class='caret'></span>
      <span class='sr-only'>Toggle Dropdown</span>
    </button>
    <ul class='dropdown-menu' role='menu'>
       <li><a href='editar_incidencia.php?ID=".$fila["ID"]."'>Modificar status de incidencia</a></li>
    </ul>
  </div>
              </td>
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
                     	<th>Tipo de Mantenimiento</th>
                     	<th>Descripción</th>
                    	<th>Usuario</th>
                    	<th>Matrícula del Vehículo</th>
                     	<th>Estado Incidencia</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY INCIDENCIAS REGISTRADAS</h3></div>";
			}

		}

	

	}

  public function editarIncidencia($ID, $estado, $matricula) {

    echo 1;

    if ($estado == 000001) {

      $sql = "UPDATE incidencia SET status_incidencia_ID = '$estado', fecha_hora_fin = now() WHERE ID = '$ID';";
      $consulta = $this->conn->query($sql);

      $sql2 = "UPDATE vehiculo SET estado = 3 WHERE matricula = '$matricula';";
      $consulta2 = $this->conn->query($sql2);


      if ($consulta) {
        return TRUE;
      }else {
        die(($this->conn->error));
      }

    }elseif ($estado == 000003) {

      $sql = "UPDATE incidencia SET status_incidencia_ID = '$estado', fecha_hora_fin = now() WHERE ID = '$ID';";
      $consulta = $this->conn->query($sql);

      $sql2 = "UPDATE vehiculo SET estado = 1 WHERE matricula = '$matricula';";
      $consulta2 = $this->conn->query($sql2);

      if ($consulta) {
        return TRUE;
      }else {
        die(($this->conn->error));
      }

    }

  }




}


?>