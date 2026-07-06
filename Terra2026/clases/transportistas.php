<?php  


require 'conexion.php';

class Transportistas extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarTransportista($CI, $nombre, $apellido, $fecha_nac, $edad, $direccion, $email, $estado, $licencia_opc, $telf_hab, $telf_cel, $venc_licencia) {

      $validacion1 = "SELECT * FROM transportista WHERE CI = '$CI';";
      $con_validacion1 = $this->conn->query($validacion1);

      $validacion2 = "SELECT * FROM transportista WHERE correo = '$email';";
      $con_validacion2 = $this->conn->query($validacion2);

       if ($con_validacion1->num_rows <= 0 && $con_validacion2->num_rows <= 0) {

        echo 1;

		$sql= "INSERT INTO transportista (CI, nombre, apellido, fecha_nac, edad, direccion, correo, estado, grado_licencia, venc_licencia) VALUES ('$CI', '$nombre', '$apellido', '$fecha_nac', '$edad', '$direccion', '$email', '$estado', '$licencia_opc', '$venc_licencia');";
		$consulta = $this->conn->query($sql);

    $sql = "INSERT INTO telef_transportista (habitacion, celular, transportista_CI) VALUES ('$telf_hab', '$telf_cel', '$CI');";
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


	public function listaTransportistas() {

  		$sql = "SELECT transportista.CI, transportista.nombre, transportista.apellido, transportista.fecha_nac, transportista.edad, transportista.direccion, transportista.correo, transportista.grado_licencia, transportista.venc_licencia, transportista.estado, telef_transportista.habitacion, telef_transportista.celular, telef_transportista.transportista_CI FROM transportista INNER JOIN telef_transportista ON transportista.CI = telef_transportista.transportista_CI;";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_transp' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							<th>Cédula</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Fecha de Nacimiento</th>
                     <th>Edad</th>
                     <th>Dirección de Domicilio</th>
                     <th>Correo</th>
                     <th>Teléfono Habitación</th>
                     <th>Teléfono Celular</th>
                     <th>Licencia</th>
                     <th>Vencimiento Licencia</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                  </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		if ($fila['estado'] == 2) {
         			$estado = "Disponible";
         			$clase = "btn btn-success btn-mini";
  					}else if ($fila['estado'] == 1) {
  						$estado = "Con Vehículo Asignado";
  						$clase = "btn btn-warning btn-mini";
  					}else{
              	$estado = "Inactivo";
              	$clase = "btn btn-danger btn-mini";
           		}
         		echo "<tr>
         			<td>".$fila['CI']."</td>
         			<td>".$fila['nombre']."</td>
         			<td>".$fila['apellido']."</td>
         			<td>".$fila['fecha_nac']."</td>
         			<td>".$fila['edad']."</td>
         			<td>".$fila['direccion']."</td>
         			<td>".$fila['correo']."</td>
         			<td>".$fila['habitacion']."</td>
         			<td>".$fila['celular']."</td>
         			<td>".$fila['grado_licencia']."</td>
         			<td>".$fila['venc_licencia']."</td>
         			<td><button class='".$clase."' value=''>".$estado."</button></td>
              <td>
                <a type='button' class='btn btn-block btn-info' href='editar_transp.php?CI=".$fila["CI"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                <th>Cédula</th>
                     <th>Nombre</th>
                     <th>Apellido</th>
                     <th>Dirección de Domicilio</th>
                     <th>Correo</th>
                     <th>Teléfono Habitación</th>
                     <th>Teléfono Celular</th>
                     <th>Perfil</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY TRANSPORTISTAS REGISTRADOS</h3></div>";
        }

 		   }

 	}

  public function editarTransportista($cedula, $nombre, $apellido, $fecha_nac, $edad, $direccion, $email, $estado, $licencia_opc, $telf_hab, $telf_cel, $venc_licencia) {

    echo 1;

    $sql = "UPDATE transportista SET nombre='$nombre', apellido='$apellido', fecha_nac='$fecha_nac', edad='$edad', direccion='$direccion', correo='$email', grado_licencia='$licencia_opc', estado='$estado' WHERE CI='$cedula';";
    $consulta = $this->conn->query($sql);

    $sql = "UPDATE telef_transportista SET habitacion='$telf_hab', celular='$telf_cel' WHERE transportista_CI='$cedula';";

    $consulta = $this->conn->query($sql);

        if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }


}

}


?>