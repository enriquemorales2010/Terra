<?php  


require_once 'conexion.php';

class edificios extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registraredificio($nombre, $direccion, $f_rec, $estado) {


      $validacion1 = "SELECT * FROM edificio WHERE nom_ed = '$nombre';";
      $con_validacion1 = $this->conn->query($validacion1);

    
      if ($con_validacion1->num_rows <= 0 ) {
        
        echo 1;

         $sql = "INSERT INTO edificio (id_ed,nom_ed ,dir_ed, fecha_rec, estado) VALUES (NULL, '$nombre', '$direccion', '$f_rec','$estado');";
        $consulta = $this->conn->query($sql);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));
          ini_set("display_error", false);

        }
      }else {
          echo 0;
      }

 

  	}//registrarUsuario
	
	public function listaedificio() {

  		$sql = "SELECT * FROM edificio ";
  		$consulta = $this->conn->query($sql);

  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_edificios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							      <th>Nombre Edificio</th>
                      <th>Dirección de Domicilio</th>
                     <th>Fecha Rec. Municipal</th>
                     <th>Estado</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		if ($fila['estado'] == 1) {
         			$estado = "Activo";
         			$clase = "btn-xs btn-success";
  					}else {
  						$estado = "Inactivo";
  						$clase = "btn-xs btn-danger";
  					}


            
                if ($fila['fecha_rec'] == NULL || $fila['fecha_rec'] == 0 ){
                    $recepcion = "Aun en espera";
                    
                    }else {
                     $recepcion = $fila['fecha_rec'];
                     $recepcion = date("d-m-Y",strtotime($recepcion));
                   };




            



         		echo "<tr>
         			<td>".$fila['nom_ed']."</td>
         			<td>".$fila['dir_ed']."</td>
              <td>".$recepcion."</td>
              <td><button class='".$clase."' value=''>".$estado."</button></td>
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_edificio.php?id_ed=".$fila["id_ed"]."'> Editar</a>
              </td>
					</tr>";


        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                <th>R.U.T.</th>
                       <th>Nombre Edificio</th>
                      <th>Dirección de Domicilio</th>
                     <th>Fecha Rec. Municipal</th>
                     <th>Estado</th>
                     <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY EDIFICIOS REGISTRADOS</h3></div>";
        }

 		   }

 	}

  public function editaredificio($id, $nombre, $direccion, $f_rec, $estado) {


      $validacion2 = "SELECT * FROM edificio WHERE nom_ed = '$nombre';";
      $con_validacion2 = $this->conn->query($validacion2);
  

  if ($con_validacion2->num_rows <= 1 ) {

      echo 1;

    $sql = "UPDATE edificio SET nom_ed='$nombre', dir_ed='$direccion',fecha_rec='$f_rec', estado='$estado' WHERE id_ed = '$id';";
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
}

?>