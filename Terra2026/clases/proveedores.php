<?php  


require 'conexion.php';

class proveedores extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	

        
public function registrarProveedor($rut, $nombre_proveedor, $direccion, $correo, $telef_proveedor, $cel_proveedor) {

        $validacion1 = "SELECT * FROM proveedores WHERE rut = '$rut';";
        $con_validacion1 = $this->conn->query($validacion1);

        $validacion2 = "SELECT * FROM proveedores WHERE correo = '$correo';";
        $con_validacion2 = $this->conn->query($validacion2);

         if ($con_validacion1->num_rows <= 0 && $con_validacion2->num_rows <= 0) {

            echo 1;

        $sql = "INSERT INTO proveedores (ID, rut, nombre, direccion, correo) VALUES (NULL, '$rut', '$nombre_proveedor', '$direccion', '$correo');";
        $consulta = $this->conn->query($sql);


        $ID=$this->conn->insert_id;


        $sql = "INSERT INTO telef_prov VALUES (NULL, '$telef_proveedor', '$cel_proveedor',  '$ID' );";
        $consulta = $this->conn->query($sql);

        if ($consulta) {
            
            return TRUE;

        }else {

            die(($this->conn->error));

        }

       }else {
        echo 0;
      }


	}

	public function listaProveedores() {

		$sql = "SELECT * FROM proveedores INNER JOIN telef_prov ON proveedores.ID = telef_prov.prov_servicio_ID;";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			
			if ($consulta->num_rows > 0) {
			
				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_prov' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  					 <th>RUT</th>
                     <th>Nombre Proveedor</th>
                     <th>Dirección</th>
                     <th>Correo</th>
                     <th>Teléfono Empresa</th>
                     <th>Teléfono Celular</th>                   
                     <th>Acciones</th>
                  </tr>
                     </thead><tbody>";
            while ($fila = mysqli_fetch_assoc($consulta)) {
            	
            	echo "<tr>
         			<td>".$fila['rut']."</td>
         			<td>".$fila['nombre']."</td>
         			<td>".$fila['direccion']."</td>
         			<td>".$fila['correo']."</td>
         			<td>".$fila['principal']."</td>
         			<td>".$fila['celular']."</td>
         			
         			
         			<td style='text-align: center;'>
                <a type='button' class='btn btn-xs btn-info' href='editar_prov.php?ID=".$fila["ID"]."'> Editar</a>
              </td>
					</tr>";

            }
            echo "</tbody></table>";

			}else {
                echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                     <th>RUT</th>
                     <th>Nombre Proveedor</th>
                     <th>Dirección</th>
                     <th>Correo</th>
                     <th>Teléfono Empresa</th>
                     <th>Teléfono Celular</th>
                     <th>Acciones</th>
                  </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY REGISTROS EN LA BASE DE DATOS</h3></div>";
            }

		}



	}

    public function formProveedores() {

        $sql = "SELECT * FROM proveedores;";
        $consulta = $this->conn->query($sql);

        


    }

    public function editarProveedor($ID, $rut, $nombre_proveedor, $direccion, $correo, $telef_proveedor, $cel_proveedor) {

        echo 1;

        $sql = "UPDATE proveedores SET rut = '$rut', nombre =  '$nombre_proveedor', direccion = '$direccion', correo = '$correo' WHERE ID = '$ID'; ";
        $consulta = $this->conn->query($sql);

        $sql2 = "UPDATE telef_prov SET principal = '$telef_proveedor', celular = '$cel_proveedor' WHERE prov_servicio_ID = '$ID'; ";
        $consulta2 = $this->conn->query($sql2);

        if ($consulta)  {
            
            return TRUE;

        }else {

            die(($this->conn->error));

        }



    }




}

//$con = new ProvServicios();
//$con->registrarProveedor();
?>