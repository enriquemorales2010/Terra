<?php 


session_start();

require 'conexion.php';

class Sesiones extends Conexion {

	public function constructor() {

		parent::__construct();

	}

	public function login($usuario, $clave) {

		$sql = "SELECT usuario.rut_usu, usuario.nom_usu, usuario.ape_usu, usuario.dir_usu, usuario.cor_usu, usuario.clave_usu, usuario.estado, perfil.eti_per FROM usuario INNER JOIN perfil ON usuario.id_per = perfil.id_per WHERE usuario.cor_usu = '$usuario' AND usuario.clave_usu = '$clave';";
		$consulta = $this->conn->query($sql);

		if ($consulta) {
			
			if ($consulta->num_rows > 0) {
				
				$fila = $consulta->fetch_assoc();
				$_SESSION['usuario'] = $fila['cor_usu'];
				$_SESSION['pass'] = $fila['clave_usu'];
				$_SESSION['rut'] = $fila['rut_usu'];
				$_SESSION['nombre_usuario'] = $fila['nom_usu'];
				$_SESSION['apellido_usuario'] = $fila['ape_usu'];
				$_SESSION['direccion_usuario'] = $fila['dir_usu'];
				$_SESSION['perfil'] = $fila['eti_per'];
				$_SESSION['estado'] = $fila['estado'];
				

				if ($_SESSION['perfil'] == "Base") {

					header('Location: ../index2.php');
				
				}elseif ($_SESSION['estado'] == 1) {
					header('Location: ../index.php');

				} else{

					session_destroy();
					header('Location: ../error_login.php?error=true');

				}

			
			}else {
				header('Location: ../error_login.php?error=false');		
			}

		}

	}


}//class


?>