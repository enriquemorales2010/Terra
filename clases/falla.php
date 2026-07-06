<?php  


require_once 'conexion.php';

class fallas extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrarfalla($etiqueta, $clase, $tipo) {


      $validacion1 = "SELECT * FROM falla WHERE etiq_falla = '$etiqueta';";
      $con_validacion1 = $this->conn->query($validacion1);
      $validacion2 = "SELECT * FROM falla WHERE clase_falla_id_clase_falla = '$clase';";
      $con_validacion2 = $this->conn->query($validacion2);
      $validacion3 = "SELECT * FROM falla WHERE tipo_falla_id_tipo_falla = '$tipo';";
      $con_validacion3 = $this->conn->query($validacion3);
      
        echo 1;
      
        $sql = "INSERT INTO falla (id_fal,etiq_falla ,clase_falla_id_clase_falla, tipo_falla_id_tipo_falla) VALUES (NULL, '$etiqueta', '$clase', '$tipo');";
        $consulta = $this->conn->query($sql);


     

        if($consulta) {

          return TRUE;
          echo "Listo";

        }else {

          die(($this->conn->error));
          ini_set("display_error", false);
          echo 0;
        
          }
            

 

  	}//registrar
	
	public function listafalla() {

  		$sql = " SELECT falla.id_fal, falla.etiq_falla, tipo_falla.etiqueta_tipo, clase_falla.etiqueta_clase FROM falla 
                  INNER JOIN tipo_falla ON tipo_falla.id_tipo_falla = falla.tipo_falla_id_tipo_falla
              INNER JOIN clase_falla ON clase_falla.id_clase_falla = falla.clase_falla_id_clase_falla";
  		$consulta = $this->conn->query($sql);


  		if ($consulta) {
  			if ($consulta->num_rows > 0) {
  				echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_edificios' cellspacing='0' width='100%'>
  					<thead>
  						<tr>
  							      <th>ID</th>
                      <th>Nombre de la Falla</th>
                     <th>Clase</th>
                     <th>Elemento</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
         	while ($fila = mysqli_fetch_assoc($consulta)) {
         		


           
            



         		echo "<tr>
         			<td>".$fila['id_fal']."</td>
         			<td>".$fila['etiq_falla']."</td>
         			<td>".$fila['etiqueta_clase']."</td>
         			<td>".$fila['etiqueta_tipo']."</td>
              
              
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_falla.php?id_fal=".$fila["id_fal"]."'> Editar</a>
              </td>
					</tr>";
            }

        		}
        	echo "</tbody></table>";
     		}else {
          echo "<table class='table table-striped table-bordered' >
            <thead>
              <tr>
                <th>ID</th>
                      <th>Nombre de la Falla</th>
                     <th>Clase</th>
                     <th>Tipo</th>
                     <th>Acciones</th>
                </tr>
                     </thead><tbody>
                        <tr></tr>
                     </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY FALLAS REGISTRADAS</h3></div>";
        }

 		   }

 	

  public function editarfalla($id, $etiq, $clasereal, $tiporeal) {


      //$validacion2 = "SELECT * FROM falla WHERE nom_ed = '$id';";
      //$con_validacion2 = $this->conn->query($validacion2);

     
      echo 1;

    $sql = "UPDATE falla SET etiq_falla='$etiq', clase_falla_id_clase_falla='$clasereal', tipo_falla_id_tipo_falla='$tiporeal' WHERE id_fal = '$id';";
    $consulta = $this->conn->query($sql);


      if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }

  }

  
public function registrarclasefalla($etiqueta) {


      $validacion1 = "SELECT * FROM clase_falla WHERE etiqueta_clase = '$etiqueta';";
      $con_validacion1 = $this->conn->query($validacion1);
      


      if ($con_validacion1->num_rows <= 0) {
        
        echo 1;

        $sql = "INSERT INTO clase_falla (id_clase_falla, etiqueta_clase) VALUES (NULL, '$etiqueta');";
        $consulta = $this->conn->query($sql);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
      }else {
          echo 0;
      }
            

 

    }//registrarClase

public function registrartipofalla($etiqueta) {


      $validacion1 = "SELECT * FROM tipo_falla WHERE etiqueta_tipo = '$etiqueta';";
      $con_validacion1 = $this->conn->query($validacion1);
      


      if ($con_validacion1->num_rows <= 0) {
        
        echo 1;

        $sql = "INSERT INTO tipo_falla (id_tipo_falla, etiqueta_tipo) VALUES (NULL, '$etiqueta');";
        $consulta = $this->conn->query($sql);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));

        }
      }else {
          echo 0;
      }
            

 

    }//registrarElemento




public function buscar($clase_falla) {


      $queryM = "SELECT DISTINCT tipo_falla.id_tipo_falla, tipo_falla.etiqueta_tipo, clase_falla.id_clase_falla FROM falla
          INNER JOIN tipo_falla ON tipo_falla.id_tipo_falla = falla.tipo_falla_id_tipo_falla
          INNER JOIN clase_falla ON clase_falla.id_clase_falla = falla.clase_falla_id_clase_falla
              WHERE clase_falla.id_clase_falla = '$clase_falla' ORDER BY etiqueta_tipo;";

        $resultadoM = $this->conn->query($queryM);
  
        $html= "<option value=''>Seleccionar</option>";
  
        while($rowM = mysqli_fetch_assoc($resultadoM))
      {
    $html.= "<option value='".$rowM['id_tipo_falla']."'>".$rowM['etiqueta_tipo']."</option>";
    

        }
    echo $html;
    }//registrarElemento


public function buscarfalla($elemento) {


      $queryM = "SELECT DISTINCT falla.etiq_falla, falla.id_fal, falla.clase_falla_id_clase_falla, falla.tipo_falla_id_tipo_falla, tipo_falla.id_tipo_falla
                  FROM falla
                  INNER JOIN tipo_falla ON falla.tipo_falla_id_tipo_falla = tipo_falla.id_tipo_falla WHERE tipo_falla.id_tipo_falla = '$elemento'  
                  ORDER BY id_fal;";

        $resultadoM = $this->conn->query($queryM);
  
        $html = "<option value=''>Seleccionar</option>";
        
        while($rowM = mysqli_fetch_assoc($resultadoM))
      {

    $html.= "<option value='".$rowM['id_fal']."'>".$rowM['etiq_falla']."</option>";
    

        }
  
     echo $html; 


    
            

 

    }//registrarElemento



 public function editarfallacaso($idcaso, $idfallas, $idfallacaso) {


      //$validacion2 = "SELECT * FROM falla WHERE nom_ed = '$id';";
      //$con_validacion2 = $this->conn->query($validacion2);

     
      echo 1;

    $sql = "UPDATE postventas_has_falla SET falla_id_fal='$idfallas' WHERE postventas_num_caso = '$idcaso' and id_pos_has_fal = '$idfallacaso';";
    $consulta = $this->conn->query($sql);


      if($consulta) {

        return TRUE;

      }else {

        die(($this->conn->error));

      }

  }




}


?>