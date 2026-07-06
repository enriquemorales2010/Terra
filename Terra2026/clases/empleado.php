<?php 

require 'conexion.php';

class empleado extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarempleado($rut, $nombre, $apellido, $fecha, $edad, $direccion, $cargo, $estado) {

		$validacion = "SELECT * FROM empleado WHERE rut_emp = '$rut';";
      $con_validacion = $this->conn->query($validacion);

      if ($con_validacion->num_rows <= 0 ) {

      	echo 1;

		$sql = "INSERT INTO empleado VALUES('$rut', '$nombre', '$apellido', '$fecha', '$edad', '$direccion', '$cargo' ,'$estado' );";
		$consulta  = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

      }else {
          echo 0;
      }

	}

	public function listaempleado() {

		$sql = "SELECT * FROM empleado";
		$consulta = $this->conn->query($sql);

		

		

		if ($consulta) {
			if ($consulta->num_rows > 0) {

				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_empl'><thead>
							<tr>
								<th>RUT</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Edad</th>
								<th>Dirección de Domicilio</th>
								<th>Cargo</th>
								<th>Estado</th>
								<th>Acciones</th>
								</tr></thead><tbody>";
				while ($fila = mysqli_fetch_assoc($consulta)) {
					if ($fila['estado'] == 1) {
						$estado = "Activo";
         			$clase = "btn btn-block btn-success";
					}else {
						$estado = "Inactivo";
         			$clase = "btn btn-block btn-danger";
					}

					echo "<tr>
								<td>".$fila['rut_emp']."</td>
								<td>".$fila['nom_emp']."</td>
								<td>".$fila['ape_emp']."</td>
								<td>".$fila['edad_emp']."</td>
								<td>".$fila['dir_emp']."</td>
								<td>".$fila['cargo_emp']."</td>
								<td><button class='".$clase."' value=''>".$estado."</button></td>
								<td><a type='button' class='btn btn-block btn-info' href='editar_empleado.php?rut_emp=".$fila["rut_emp"]."'> Editar</a></td>";
				}
				echo "</tbody></table>";
			}else {
				echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                				<th>RUT</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Edad</th>
								<th>Dirección de Domicilio</th>
								<th>Cargo</th>
								<th>Estado</th>
								<th>Acciones</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY EMPLEADO REGISTRADOS</h3></div>";
			}
		}

	}

	public function editarMecanico($cedula, $nombre, $apellido, $fecha, $edad, $direccion, $estado, $proveedor) {

		echo 1;

		$sql = "UPDATE mecanico SET nombre = '$nombre', apellido = '$apellido', fecha_nac = '$fecha', edad = '$edad', direccion = '$direccion', estado = '$estado', prov_servicio_ID = '$proveedor' WHERE CI = '$cedula';";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

	}

	public function asignarempleado($cedula_mecanico, $id_incidencia) {

		echo 1;

		$sql = "INSERT INTO incidencia_has_mecanico VALUES ('$id_incidencia', '$cedula_mecanico');";
		$consulta = $this->conn->query($sql);

		$sql2 = "UPDATE mecanico SET estado = 1 WHERE CI = '$cedula_mecanico';";
		$consulta2 = $this->conn->query($sql2);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}


	}


}




?>