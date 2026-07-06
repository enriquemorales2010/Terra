<?php  


require_once 'conexion.php';

class obs_pro extends Conexion {

	//Métodos
	public function constructor() {

		parent::__construct();

	}

 	public function registrardatosproyecto($proyecto, $piso, $num_dep, $cant_mtrs, $tipo_depto) {


      $validacion1 = "SELECT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed FROM datos_proyecto WHERE datos_proyecto.num_depto = '$num_dep'  and datos_proyecto.edificio_id_ed = '$proyecto';";
      $con_validacion1 = $this->conn->query($validacion1);
      
      if ($con_validacion1->num_rows <= 0) {
        
        echo 1;
        $cant_rev = 0;
      
       $sql = "INSERT INTO datos_proyecto(id_Proyecto, num_depto, piso, cant_m2, tipo_depto, cant_rev, edificio_id_ed) VALUES (NULL,'$num_dep', '$piso', '$cant_mtrs','$tipo_depto', '$cant_rev' ,'$proyecto');";
       $consulta = $this->conn->query($sql);


     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));
              }
      }else {
          echo 0;
      }
  	}//registrar

    public function registrarrevisionm2($id_proyecto, $fecha_revision, $cant_obs, $obs_m2, $inspector) {


      $validacion1 = "SELECT revision_proyecto.idRev, revision_proyecto.tipo_r, revision_proyecto.fecha_re, revision_proyecto.cant_obs, revision_proyecto.ob_mt, revision_proyecto.inspector, revision_proyecto.Datos_Proyecto_id_Proyecto FROM revision_proyecto 
          WHERE revision_proyecto.Datos_Proyecto_id_Proyecto = '$id_proyecto'; ";
      $con_validacion1 = $this->conn->query($validacion1);


      $validacion2 = "SELECT MAX(revision_proyecto.tipo_r) as Cantidad FROM revision_proyecto 
          WHERE revision_proyecto.Datos_Proyecto_id_Proyecto = '$id_proyecto' ";
      $con_validacion2 = $this->conn->query($validacion2);

      if ($con_validacion2) {
      while ($fila = mysqli_fetch_assoc($con_validacion2)) {
          $cantidad = $fila['Cantidad']; 
          //echo"<br>".$cantidad."<br>";
         }}




      
      if ($con_validacion1->num_rows < 3 && $cantidad < 3 ) {
        echo 1;
         
      $cantidad = $cantidad + 1;
     
      
       $sql = "INSERT INTO revision_proyecto(idRev, tipo_r, fecha_re, cant_obs, ob_mt, inspector, Datos_Proyecto_id_Proyecto) VALUES 
       (NULL,'$cantidad', '$fecha_revision','$cant_obs','$obs_m2','$inspector','$id_proyecto');";
       $consulta = $this->conn->query($sql); 

       $sql1 = "UPDATE datos_proyecto SET cant_rev='$cantidad'  WHERE datos_proyecto.id_Proyecto = '$id_proyecto';";
       $consulta1 = $this->conn->query($sql1);

     

        if($consulta) {

          return TRUE;

        }else {

          die(($this->conn->error));
              }
      }else {
          echo 0;
      }
    }//registrar



     

	


 	  public function listaproyecto() {

      $sql = "SELECT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.tipo_depto, datos_proyecto.cant_rev,datos_proyecto.edificio_id_ed, edificio.nom_ed FROM datos_proyecto
                  INNER JOIN edificio ON datos_proyecto.edificio_id_ed = edificio.id_ed";
      $consulta = $this->conn->query($sql);



        if ($consulta->num_rows > 0) {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_postventas' cellspacing='0' width='100%'>
            <thead>
              <tr>
                     <th>ID</th>
                     <th>Proyecto</th>
                     <th>Num. Depto</th>
                     <th>Tipo</th>
                     <th>M2</th>
                     <th>Cantidad de Rev.</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
          while ($fila = mysqli_fetch_assoc($consulta)) {
            
          /* 

            if($fila['mes'] ==1){
            $monthName = 'Enero';
            }elseif($fila['mes'] ==2){
            $monthName = 'Febrero';
            }elseif($fila['mes'] ==3){
            $monthName = 'Marzo';
            }elseif($fila['mes'] ==4){
            $monthName = 'Abril';
            }elseif($fila['mes'] ==5){
            $monthName = 'Mayo';
            }elseif($fila['mes'] ==6){
            $monthName = 'Junio';
            }elseif($fila['mes'] ==7){
            $monthName = 'Julio';
            }elseif($fila['mes'] ==8){
            $monthName = 'Agosto';
            }elseif($fila['mes'] ==9){
            $monthName = 'Septiembre';
            }elseif($fila['mes'] ==10){
            $monthName = 'Octubre';
            }elseif($fila['mes'] ==11){
            $monthName = 'Noviembre';
            }elseif($fila['mes'] ==12){
            $monthName = 'Diciembre';
            }else{
              $monthName = 'Algo Paso';
            }
            
          */


            echo "<tr>
              <td>".$fila['id_Proyecto']."</td>
              <td>".$fila['nom_ed']."</td>
              <td>".$fila['num_depto']."</td>
              <td>".$fila['tipo_depto']."</td>
              <td>".$fila['cant_m2']."</td>
              <td>".$fila['cant_rev']."</td>
              
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_proy_obs.php?id_Proyecto=".$fila["id_Proyecto"]."'> Editar</a>
              </td>
          </tr>";
            }

            
          echo "</tbody></table>";
        }else {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                  <th>ID</th>
                     <th>Proyecto</th>
                     <th>Num. Depto</th>
                     <th>Tipo</th>
                     <th>M2</th>
                     <th>Cantidad de Rev.</th>
                     <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                <tr></tr>
            </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY ENCUESTAS REGISTRADAS</h3></div>";
        }

       }




          public function listaobservacion() {

      $sql = "SELECT revision_proyecto.idRev, revision_proyecto.tipo_r, datos_proyecto.num_depto, revision_proyecto.fecha_re, datos_proyecto.cant_m2, revision_proyecto.cant_obs, revision_proyecto.ob_mt, revision_proyecto.inspector, revision_proyecto.Datos_Proyecto_id_Proyecto, edificio.nom_ed FROM datos_proyecto
INNER JOIN edificio ON edificio.id_ed = datos_proyecto.edificio_id_ed
INNER JOIN revision_proyecto ON datos_proyecto.id_Proyecto = revision_proyecto.Datos_Proyecto_id_Proyecto";
      $consulta = $this->conn->query($sql);



        if ($consulta->num_rows > 0) {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                     <th>Proyecto</th>
                     <th>Apto</th>
                     <th>Fecha</th>
                     <th>M2</th>
                     <th>Cant. de Obs.</th>
                     <th>Ob. Por M2</th>
                     <th>Tipo de Rev.</th>
                     <th>Inspector</th>
                     <th>Acciones</th>

              </tr>
                     </thead><tbody>";
          while ($fila = mysqli_fetch_assoc($consulta)) {
            
          /* 

            if($fila['mes'] ==1){
            $monthName = 'Enero';
            }elseif($fila['mes'] ==2){
            $monthName = 'Febrero';
            }elseif($fila['mes'] ==3){
            $monthName = 'Marzo';
            }elseif($fila['mes'] ==4){
            $monthName = 'Abril';
            }elseif($fila['mes'] ==5){
            $monthName = 'Mayo';
            }elseif($fila['mes'] ==6){
            $monthName = 'Junio';
            }elseif($fila['mes'] ==7){
            $monthName = 'Julio';
            }elseif($fila['mes'] ==8){
            $monthName = 'Agosto';
            }elseif($fila['mes'] ==9){
            $monthName = 'Septiembre';
            }elseif($fila['mes'] ==10){
            $monthName = 'Octubre';
            }elseif($fila['mes'] ==11){
            $monthName = 'Noviembre';
            }elseif($fila['mes'] ==12){
            $monthName = 'Diciembre';
            }else{
              $monthName = 'Algo Paso';
            }
            
          */
         
          if($fila['tipo_r'] ==1){
            $revision = 'R1';
            }elseif($fila['tipo_r'] ==2){
            $revision = 'R2';
            }elseif($fila['tipo_r'] ==3){
            $revision = 'R3';
          }else{
              $revision = 'Algo Paso';
            }


            echo "<tr>
              
              <td>".$fila['nom_ed']."</td>
              <td>".$fila['num_depto']."</td>
              <td>".$fila['fecha_re']."</td>
              <td>".$fila['cant_m2']."</td>
              <td>".$fila['cant_obs']."</td>
              <td>".$fila['ob_mt']."</td>
              <td>".$revision."</td>
              <td>".$fila['inspector']."</td>
              <td>
                <a type='button' class='btn btn-xs btn-block btn-info' href='editar_obs_m2.php?idRev=".$fila["idRev"]."'> Editar</a>
              </td>
          </tr>";
            }

            
          echo "</tbody></table>";
        }else {
          echo "<table class='table table-striped table-bordered dt-responsive nowrap' id='tabla_usuarios' cellspacing='0' width='100%'>
            <thead>
              <tr>
                 <th>ID</th>
                 <th>Proyecto</th>
                 <th>Num. Depto</th>
                 <th>Tipo</th>
                 <th>M2</th>
                 
                 <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                <tr></tr>
            </tbody></table><div style='text-align:center; color:red;'><h3>NO HAY ENCUESTAS REGISTRADAS</h3></div>";
        }

       }





  public function editardatosproyecto($id_proyecto, $proyecto, $num_dep, $piso, $cant_mtrs, $tipo_depto) {

       $validacion1 = "SELECT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed FROM datos_proyecto WHERE datos_proyecto.num_depto = '$num_dep'  and datos_proyecto.edificio_id_ed = '$proyecto';";
      $con_validacion1 = $this->conn->query($validacion1);

   if ($con_validacion1->num_rows < 2) {
        
        echo 1;
      
       $sql = "UPDATE datos_proyecto SET num_depto='$num_dep', piso = '$piso', cant_m2='$cant_mtrs', tipo_depto='$tipo_depto', edificio_id_ed='$proyecto' WHERE id_Proyecto= '$id_proyecto';";
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


public function editarrevisionm2($id_rev, $id_proyecto, $fecha_revision, $cant_obs,$obs_m2, $inspector) {

     
      $validacion1 = "SELECT revision_proyecto.idRev, revision_proyecto.tipo_r, revision_proyecto.fecha_re, revision_proyecto.cant_obs, revision_proyecto.ob_mt, revision_proyecto.inspector, revision_proyecto.Datos_Proyecto_id_Proyecto FROM revision_proyecto 
          WHERE revision_proyecto.Datos_Proyecto_id_Proyecto = '$id_proyecto'; ";
      $con_validacion1 = $this->conn->query($validacion1);


      $validacion2 = "SELECT MAX(revision_proyecto.tipo_r) as Cantidad FROM revision_proyecto 
          WHERE revision_proyecto.Datos_Proyecto_id_Proyecto = '$id_proyecto' ";
      $con_validacion2 = $this->conn->query($validacion2);

      if ($con_validacion2) {
      while ($fila = mysqli_fetch_assoc($con_validacion2)) {
          $cantidad = $fila['Cantidad']; 
         // echo"<br>".$cantidad."<br>";
         }}




      
      if ($cantidad <= 3 ) {
        echo 1;
         
     
      
       $sql = "UPDATE revision_proyecto SET fecha_re='$fecha_revision',cant_obs='$cant_obs',ob_mt='$obs_m2',inspector='$inspector' WHERE  idRev='$id_rev';";
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



public function buscare($id_proyecto) {


      $queryM = "SELECT DISTINCT datos_proyecto.piso, datos_proyecto.edificio_id_ed FROM datos_proyecto WHERE  datos_proyecto.edificio_id_ed = '$id_proyecto' AND datos_proyecto.cant_rev < 3 ; ";

        $resultadoM = $this->conn->query($queryM);
  
        $html= "<option value=''>Escoja Una Opcion";
  
        while($rowM = mysqli_fetch_assoc($resultadoM))
      {

    $html.= "<option value='".$rowM['piso']."'>".$rowM['piso']."</option>";
    //$html1 = "document.getElementById('cant_mtrs').value = '".$rowM['cant_m2']."';";
    

        }
    echo $html;
    //echo $html1;
    
    }//registrarElemento



public function buscarapto($id_proyecto, $piso) {


      $queryM = "SELECT DISTINCT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.piso, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed FROM datos_proyecto WHERE  datos_proyecto.edificio_id_ed = '$id_proyecto' AND datos_proyecto.piso = '$piso' AND datos_proyecto.cant_rev < 3 ; ";

        $resultadoM = $this->conn->query($queryM);
  
        $html= "<option value=''>Escoja Una Opcion";
  
        while($rowM = mysqli_fetch_assoc($resultadoM))
      {

    $html.= "<option value='".$rowM['id_Proyecto']."'>".$rowM['num_depto']."-".$rowM['tipo_depto']."</option>";
    

        }
    echo $html;

    }//registrarElemento



public function buscarM2($apto) {


      $queryM = "SELECT DISTINCT datos_proyecto.id_Proyecto, datos_proyecto.num_depto, datos_proyecto.cant_m2, datos_proyecto.piso, datos_proyecto.tipo_depto, datos_proyecto.edificio_id_ed FROM datos_proyecto WHERE  datos_proyecto.id_Proyecto = '$apto' AND datos_proyecto.cant_rev < 3 ;";

        $resultadoM = $this->conn->query($queryM);
  
        
  
        while($rowM = mysqli_fetch_assoc($resultadoM))
      {

    $html= $rowM['cant_m2'];
    

        }
    echo $html;

    }//registrarElemento







}


?>