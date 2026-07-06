<?php 

require 'conexion.php';

class Mecanicos extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarMecanico($CI, $nombre, $apellido, $fecha, $edad, $direccion, $estado, $proveedor, $incidencia) {

		$sql = "INSERT INTO mecanico VALUES('$CI', '$nombre', '$apellido', '$fecha', '$edad', '$direccion', '$estado', '$proveedor', '$incidencia');";
		$consulta  = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

	}

	public function listaMecanicos() {

		$sql = "SELECT mecanico.CI, mecanico.nombre, mecanico.apellido, mecanico.edad, mecanico.direccion, mecanico.estado, mecanico.incidencia_ID FROM mecanico;";
		$consulta = $this->conn->query($sql);

		$sql2 = "SELECT prov_servicio.nombre, prov_servicio.ramo FROM prov_servicio INNER JOIN mecanico ON prov_servicio.ID = mecanico.prov_servicio_ID;";
		$consulta2 = $this->conn->query($sql2);

		if ($consulta2) {
			if ($consulta2->num_rows > 0) {
				while ($fila = mysqli_fetch_assoc($consulta2)) {
					$proveedor = $fila['nombre'];
					$ramo = $fila['ramo'];
				}
			}
		}

		if ($consulta) {
			if ($consulta->num_rows > 0) {
				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_mecanicos'><thead>
							<tr>
								<th>Cédula</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Edad</th>
								<th>Dirección de Domicilio</th>
								<th>Proveedor de Servicios</th>
								<th>Ramo</th>
								<th># de Incidencia</th>
								<th>Estado</th>
								<th>Acciones</th>
								</tr></thead><tbody>";
				while ($fila = mysqli_fetch_assoc($consulta)) {
					if ($fila['estado'] == 1) {
						$estado = "En Incidencia";
         			$clase = "btn btn-block btn-warning";
					}

					echo "<tr>
								<td>".$fila['CI']."</td>
								<td>".$fila['nombre']."</td>
								<td>".$fila['apellido']."</td>
								<td>".$fila['edad']."</td>
								<td>".$fila['direccion']."</td>
								<td>".$proveedor."</td>
								<td>".$ramo."</td>
								<td>".$fila['incidencia_ID']."</td>
								<td><button class='".$clase."' value=''>".$estado."</button></td>
								<td><a type='button' class='btn btn-block btn-info' href='editar_mec.php?CI=".$fila["CI"]."'> Editar</a></td>";
				}
				echo "</tbody></table>";
			}
		}

	}

	public function editarMecanico($cedula, $nombre, $apellido, $fecha, $edad, $direccion, $estado, $proveedor, $incidencia) {

		$sql = "UPDATE mecanico SET nombre = '$nombre', apellido = '$apellido', fecha_nac = '$fecha', edad = '$edad', direccion = '$direccion', estado = '$estado', prov_servicio_ID = '$proveedor', incidencia_ID = '$incidencia' WHERE CI = '$cedula';";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			return TRUE;
		}else {
			die(($this->conn->error));
		}

	}


}




?>