<?php  


require 'conexion.php';

class Vehiculos extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function registrarVehiculo($matricula, $serial_carroc, $serial_motor, $marca, $modelo, $anno, $color, $num_puertas, $annos_servicio, $tipo_motor, $combustible_opc, $tanque_gas, $ejes, $peso, $num_cilindros, $activo, $transp_asig) {

      $validacion1 = "SELECT * FROM vehiculo WHERE matricula = '$matricula';";
      $con_validacion1 = $this->conn->query($validacion1);

      $validacion2 = "SELECT * FROM vehiculo WHERE sral_carroceria = '$serial_carroc';";
      $con_validacion2 = $this->conn->query($validacion2);

      $validacion3 = "SELECT * FROM vehiculo WHERE sral_motor = '$serial_motor';";
      $con_validacion3 = $this->conn->query($validacion3);

      if ($con_validacion1->num_rows <= 0 && $con_validacion2->num_rows <= 0 && $con_validacion3->num_rows <= 0){

        echo 1;

		$sql = "INSERT INTO vehiculo (matricula, sral_carroceria, sral_motor, marca, modelo, anno, color, num_puertas, annos_serv, motor, tipo_combustible, tanque_gasolina, ejes, peso, num_cilindros, estado, transportista_CI) VALUES ('$matricula', '$serial_carroc', '$serial_motor', '$marca', '$modelo', '$anno', '$color', '$num_puertas', '$annos_servicio', '$tipo_motor', '$combustible_opc', '$tanque_gas', '$ejes', '$peso', '$num_cilindros', '$activo','$transp_asig');";
		$consulta = $this->conn->query($sql);

		$sql = "UPDATE transportista SET estado = 1 WHERE CI = '$transp_asig';";
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

	public function consultarTransportista() {

		$sql = "SELECT * FROM transportista WHERE estado = 2;";
		$consulta = $this->conn->query($sql);

    if($consulta->num_rows > 0) {

      echo"<option selected='selected' value='' >Seleccione un Transportista</option>";
			while ($fila = mysqli_fetch_assoc($consulta)) {

       echo "<option value='".$fila['CI']."'>".$fila['nombre']." ".$fila['apellido']."</option>";
                 
      }

    }else {
      echo "<option>NO HAY TRANSPORTISTAS REGISTRADOS/DISPONIBLES</option>";
    }

	}


	public function listaVehiculos1() {

		$sql = "SELECT vehiculo.matricula, vehiculo.sral_carroceria, vehiculo.sral_motor, vehiculo.marca, vehiculo.modelo, vehiculo.anno, vehiculo.color, vehiculo.num_puertas, vehiculo.annos_serv, vehiculo.estado, transportista.nombre, transportista.apellido FROM vehiculo INNER JOIN transportista ON vehiculo.transportista_CI = transportista.CI;";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			
			if ($consulta->num_rows > 0) {

				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_vehiculos' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							<th>Matricula</th>
                     <th>Serial Carroceria</th>
                     <th>Serial Motor</th>
                     <th>Marca</th>
                     <th>Modelo</th>
                     <th>Año</th>
                     <th>Color</th>
                     <th>Número de Puertas</th>
                     <th>Años de Servicio</th>
                     <th>Transportista Asignado</th>
                     <th>Estado</th>
                     <th>Editar</th>
                     <th>Ver Detalles</th>
                  </tr>
                     </thead><tbody>";
				while ($fila = mysqli_fetch_assoc($consulta)) {

					if ($fila['estado'] == 3) {
         			$estado = "Operativo";
         			$clase = "btn btn-success";
  					}elseif ($fila['estado'] == 2) {
  						$estado = "En Mantenimiento";
  						$clase = "btn btn-warning";
  					}elseif ($fila['estado'] == 1) {
  						$estado = "Inoperativo";
  						$clase = "btn btn-danger";
  					}else {
              $estado = "Inactivo";
              $clase = "btn btn-danger";
            }


					echo "<tr>
         			<td>".$fila['matricula']."</td>
         			<td>".$fila['sral_carroceria']."</td>
         			<td>".$fila['sral_motor']."</td>
         			<td>".$fila['marca']."</td>
         			<td>".$fila['modelo']."</td>
         			<td>".$fila['anno']."</td>
         			<td>".$fila['color']."</td>
         			<td>".$fila['num_puertas']."</td>
         			<td>".$fila['annos_serv']."</td>
         			<td>".$fila['nombre']." ".$fila['apellido']."</td>
         			<td><button class='".$clase."' value=''>".$estado."</button></td>
              <td>
                <a type='button' class='btn btn-block btn-info' href='editar_vehiculo.php?matricula=".$fila["matricula"]."'> Editar</a>
              </td>
              <td><a type='button' class='btn btn-block btn-info' href='info_vehiculo.php?matricula=".$fila["matricula"]."''>Ver Detalles</a></td>
					</tr>";


        		}
        		echo "</tbody></table>";

				}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
  					<th>Matricula</th>
               <th>Serial Carroceria</th>
               <th>Serial Motor</th>
               <th>Marca</th>
               <th>Modelo</th>
               <th>Año</th>
               <th>Color</th>
               <th>Número de Puertas</th>
               <th>Años de Servicio</th>
               <th>Transportista Asignado</th>
               <th>Estado</th>
               <th>Acciones</th>
              </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY VEHÍCULOS REGISTRADOS</h3></div>";
        }

			}

		


		}




	public function listaVehiculos2() {



	}

	public function formVehiculos($matricula) {

		$sql = "SELECT vehiculo.matricula, vehiculo.sral_carroceria, vehiculo.sral_motor, vehiculo.marca, vehiculo.modelo, vehiculo.anno, vehiculo.color, vehiculo.num_puertas, vehiculo.annos_serv, vehiculo.motor, vehiculo.tipo_combustible, vehiculo.tanque_gasolina, vehiculo.ejes, vehiculo.peso, vehiculo.num_cilindros, vehiculo.estado, vehiculo.transportista_CI, transportista.CI, transportista.nombre, transportista.apellido FROM vehiculo INNER JOIN transportista ON vehiculo.transportista_CI = transportista.CI WHERE vehiculo.matricula = '$matricula';";
		$consulta = $this->conn->query($sql);

		echo "funcionaaaaaaaaaa";

		if ($consulta) {
			
			if ($consulta->num_rows > 0) {
				
				if ( $fila = mysqli_fetch_assoc($consulta)  ) {
					
					echo "<form role='form' method='post' id='editar_vehiculo'>
                  <div class='form-group col-md-4'>
                    <label for='matricula'><i class='fa fa-credit-card'></i> Matricula</label>
                    <input type='text' class='form-control' id='matricula' name='matricula' placeholder='KGO9868' maxlength='7' value='".$fila['matricula']."' required>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='srial_carroc'><i class='fa fa-car'></i> Serial de Carroceria</label>
                    <input type='text' class='form-control' id='srial_carroc' name='srial_carroc' placeholder='SJKGI12265' required>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='srial_motor'><i class='fa fa-slack'></i> Serial del Motor</label>
                    <input type='text' class='form-control' id='srial_motor' name='srial_motor' placeholder='152JKY4G2' required>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='marca'><i class='fa fa-medium'></i> Marca</label>
                    <input type='text' class='form-control' id='marca' name='marca' placeholder='Ford' required>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='modelo'><i class='fa fa-maxcdn'></i> Modelo</label>
                    <input type='text' class='form-control' id='modelo' name='modelo' placeholder='F-450' required>
                  </div>
                  <div class='form-group col-md-2'>
                    <label for='anno'><i class='fa fa-calendar-check-o'></i> Año</label>
                    <input type='text' class='form-control' id='anno' name='anno' placeholder='2005' required>
                  </div>
                  <div class='form-group col-md-2'>
                    <label for='color'><i class='fa fa-paint-brush'></i> Color</label>
                    <input type='text' class='form-control' id='color' name='color' placeholder='Blanco' required>
                  </div>
                  <div class='form-group col-md-3'>
                    <label for='num_puertas'><i class='fa fa-square'></i> Numero de Puertas</label>
                    <input type='number' class='form-control' id='num_puertas' name='num_puertas' placeholder='2' required>
                  </div>
                  <div class='form-group col-md-3'>
                    <label for='annos_servc'><i class='fa fa-road'></i> Años de Servicio</label>
                    <input type='text' class='form-control' id='annos_servc' name='annos_servc' placeholder='10' required>
                  </div>
                  <div class='form-group col-md-3'>
                    <label for='tipo_motor'><i class='fa fa-gears'></i> Tipo de </br>Motor</label>
                    <input type='text' class='form-control' id='tipo_motor' name='tipo_motor' placeholder='Sincronico'>
                  </div>
                  <div class='form-group col-md-3'>
                    <label for='tipo_comb'> <i class='fa fa-filter'></i> Tipo de Combustible</label>
                    <select namne='tipo_comb' id='tipo_comb' class='form-control'>
                      <option selected='selected' value='91'>91 Octanos</option>
                      <option value='95'>95 Octanos</option>
                    </select>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='tanque_gas'><i class='fa fa-tint'></i> Capacidad del Tanque de Gasolina (Litros)</label>
                    <input type='text' class='form-control' id='tanque_gas' name='tanque_gas'>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='ejes'><i class='fa fa-gear'></i> Ejes</label>
                    <input type='number' class='form-control' id='ejes' name='ejes' placehoder='2'>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='peso'><i class='fa fa-cube'></i> Peso (Kg)</label>
                    <input type='number' class='form-control' id='peso' name='peso' placeholder='650'>
                  </div>
                  <div class='form-group col-md-4'>
                    <label for='num_cdros'><i class='fa fa-arrows-h'></i> Numero de Cilindros</label>
                    <input type='number' class='form-control' id='num_cdros' name='num_cdros' placeholder='2'>
                  </div>
                  	
                  <div class='form-group col-md-4'>
                    <label for='transp_asig'> <i class='fa fa-user'></i> Transportista Asignado</label>
                    <select name='transp_asig' id='transp_asig' class='form-control'>
                      <option selected='selected' value='".$fila['transportista_CI']."'>".$fila['transportista_CI']." - ".$fila['nombre']." ".$fila['apellido']."</option>
                      <option selected='selected' value='".$fila['transportista_CI']."'>".$fila['transportista_CI']." - ".$fila['nombre']." ".$fila['apellido']."</option>
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                   <p class='help-block' style='color:red;'><i class='fa fa-info-circle'></i>  <i class='fa fa-asterisk'></i> Campos Obligatorios.</p>  
                 </div>
                  <div class='col-md-12'>
                    <button type='submit' name='submit' class='btn btn-success pull-left'>Editar Datos</button>
                    <a type='button' class='btn btn-danger pull-right' href='lista_vehiculos.php'>Cancelar Proceso</a>
                  </div>
              </form>";

				}

			}

		}


	}

  public function editarVehiculo($matricula, $serial_carroc, $serial_motor, $marca, $modelo, $anno, $color, $num_puertas, $annos_servicio, $tipo_motor, $combustible_opc, $tanque_gas, $ejes, $peso, $num_cilindros, $activo, $transp_asig) {

    echo 1;

    $sql = "UPDATE vehiculo SET sral_carroceria = '$serial_carroc', sral_motor = '$serial_motor', marca = '$marca', modelo = '$modelo', anno = '$anno', num_puertas = '$num_puertas', annos_serv = '$annos_servicio', motor = '$tipo_motor', tipo_combustible = '$combustible_opc', tanque_gasolina = '$tanque_gas', ejes = '$ejes', peso = '$peso', num_cilindros = '$num_cilindros', estado = '$activo', transportista_CI = '$transp_asig' WHERE matricula = '$matricula';";
    $consulta = $this->conn->query($sql);

    if ($activo == 3) {
      $sql = "UPDATE transportista SET estado = 1 WHERE CI = '$transp_asig';";
      $consulta = $this->conn->query($sql);
    }elseif ($activo == 2) {
      $sql = "UPDATE transportista SET estado = 1 WHERE CI = '$transp_asig';";
      $consulta = $this->conn->query($sql);
    }elseif ($activo == 1) {
      $sql = "UPDATE transportista SET estado = 1 WHERE CI = '$transp_asig';";
      $consulta = $this->conn->query($sql);
    }else {
      $sql = "UPDATE transportista SET estado = 2 WHERE CI = '$transp_asig';";
      $consulta = $this->conn->query($sql);
    }

    if ($consulta) {

      echo "esito";
      return TRUE;


    }else {

      die(($this->conn->error));

    }


    

  }



}


?>