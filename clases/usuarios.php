<?php  


require_once 'conexion.php';

class Usuarios extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarUsuario($rut, $nombre, $apellido, $direccion, $correo, $pass, $estado, $perfil_opc) {


      $validacion1 = "SELECT * FROM usuario WHERE rut_usu = '$rut';";
      $con_validacion1 = $this->conn->query($validacion1);

      $validacion2 = "SELECT * FROM usuario WHERE cor_usu = '$correo';";
      $con_validacion2 = $this->conn->query($validacion2);

      if ($con_validacion1->num_rows <= 0 && $con_validacion2->num_rows <= 0) {
        
        echo 1;

        $sql = "INSERT INTO usuario (rut_usu, nom_usu, ape_usu, dir_usu, cor_usu, clave_usu, estado, id_per) VALUES ('$rut', '$nombre', '$apellido', '$direccion', '$correo', '$pass', '$estado', '$perfil_opc');";
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
	
	public function listaUsuarios() {

  		$sql = "SELECT usuario.rut_usu, usuario.nom_usu, usuario.ape_usu, usuario.dir_usu, usuario.cor_usu, usuario.estado, perfil.eti_per FROM usuario, perfil WHERE perfil.id_per = usuario.id_per ";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							<th>R.U.T.</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Dirección de Domicilio</th>
                     <th>Correo</th>
                     <th>Perfiles</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                  </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		if ($fila['estado'] == 1) {
         			$estado = "Activo";
         			$clase = "btn btn-xs btn-success";
  					}else {
  						$estado = "Inactivo";
  						$clase = "btn btn-xs btn-danger";
  					}
         		echo "<tr>
         			<td>".$fila['rut_usu']."</td>
         			<td>".$fila['nom_usu']."</td>
         			<td>".$fila['ape_usu']."</td>
         			<td>".$fila['dir_usu']."</td>
         			<td>".$fila['cor_usu']."</td>
              <td>".$fila['eti_per']."</td>
              <td><button class='".$clase."' value=''>".$estado."</button></td>
              <td>
                <a type='button' class='btn btn-xs btn-info' href='editar_usuario.php?rut_usu=".$fila["rut_usu"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                <th>R.U.T.</th>
                     <th>Nombres</th>
                     <th>Apellidos</th>
                     <th>Dirección de Domicilio</th>
                     <th>Correo</th>
                     <th>Perfil</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY USUARIOS REGISTRADOS</h3></div>";
        }

 		   }

 	}

  public function editarUsuarios($rut, $nombre, $apellido, $direccion, $correo, $pass, $estado, $perfil_opc) {

      $validacion1 = "SELECT * FROM usuario WHERE rut_usu = '$rut';";
      $con_validacion1 = $this->conn->query($validacion1);

      $validacion2 = "SELECT * FROM usuario WHERE cor_usu = '$correo';";
      $con_validacion2 = $this->conn->query($validacion2);

      echo 1;

    $sql = "UPDATE usuario SET nom_usu='$nombre', ape_usu='$apellido', dir_usu='$direccion', cor_usu='$correo', clave_usu='$pass', id_per='$perfil_opc', estado='$estado' WHERE rut_usu = '$rut';";
    $consulta = $this->conn->query($sql);


      if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }

  }

  

}


?>