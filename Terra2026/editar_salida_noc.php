<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/salida_nc.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$id = $_GET['id_auto'];

$con = new salida_nc();

  $sql = "SELECT salida_no_c.id_auto, salida_no_c.id_S_N_C, salida_no_c.Area, salida_no_c.act_afec, salida_no_c.etapa, salida_no_c.ubicacion, salida_no_c.desc_sal_nc_1, salida_no_c.nom_enc_sal_nc_1, salida_no_c.evidencia_sal_nc_1, salida_no_c.fun_enc_sal_nc_1, salida_no_c.origen_sal_nc_1, salida_no_c.fecha_sal_nc_1, salida_no_c.desc_ac_2, salida_no_c.nom_enc_ac_2, salida_no_c.funcion_2, salida_no_c.fecha_ac_2, salida_no_c.desc_ev_3,salida_no_c.par_int_ev_3, salida_no_c.imp_ac_co_4, salida_no_c.funcion_4, salida_no_c.nom_enc_ac_co_4, salida_no_c.fecha_ac_co_4, salida_no_c.aceptacion_5, salida_no_c.obs_ac_ac_sa_5, salida_no_c.nom_enc_ac_sa_5, salida_no_c.fecha_ac_sa_5, salida_no_c.nom_enc_cie_6, salida_no_c.funcion_6, salida_no_c.fecha_cie_6, salida_no_c.agregar_m, salida_no_c.estado_m, salida_no_c.edificio_id_ed, edificio.nom_ed FROM salida_no_c 
    INNER JOIN edificio ON salida_no_c.edificio_id_ed = edificio.id_ed
    WHERE salida_no_c.id_auto = '$id';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

     /* if($fila['estado'] == 1) {
        $estado = "Activo";
      }else {
        $estado = "Inactivo";
      }*/
  
      $serial = $fila['id_S_N_C'];
      $area = $fila['Area'];
      $act_afec = $fila['act_afec'];
      $etapa = $fila['etapa'];
      $ubicacion = $fila['ubicacion'];
      $desc_salida = $fila['desc_sal_nc_1'];
      $nom_1 = $fila['nom_enc_sal_nc_1'];
      $fun_1 = $fila['fun_enc_sal_nc_1'];
      $evidencia_12 = $fila['evidencia_sal_nc_1'];
      $origen = $fila['origen_sal_nc_1'];
      $fecha_inicio = $fila['fecha_sal_nc_1'];
      $desc_2 = $fila['desc_ac_2'];
      $nom_2 = $fila['nom_enc_ac_2'];
      $fun_2 = $fila['funcion_2'];
      $fecha_2 = $fila['fecha_ac_2'];
      $desc_3 = $fila['desc_ev_3'];
      $parte_3 = $fila['par_int_ev_3'];
      $imple_4 = $fila['imp_ac_co_4'];
      $nom_4 = $fila['nom_enc_ac_co_4'];
      $fecha_4 = $fila['fecha_ac_co_4'];
      $fun_4 = $fila['funcion_4'];  
      $acep_op_5 = $fila['aceptacion_5'];
      $obser_5 = $fila['obs_ac_ac_sa_5'];
      $nom_5 = $fila['nom_enc_ac_sa_5'];
      $fecha_5 = $fila['fecha_ac_sa_5'];
      $nom_6 = $fila['nom_enc_cie_6'];
      $fun_6 = $fila['funcion_6'];
      $fecha_6 = $fila['fecha_cie_6'];
      $agregar_m = $fila['agregar_m'];
      $edificio = $fila['edificio_id_ed'];
      $nombre_ed = $fila['nom_ed'];
      $estado  =$fila['estado_m'];


            if ($fecha_6 == 0 or $fecha_6 == "1900-01-01") {
              $fecha_6 = "";
            }elseif ($fecha_6 <> 0) {
              $fecha_6 = $fila['fecha_cie_6'];
            $fecha_6 = date("d-m-Y",strtotime($fecha_6));
            } else{
              $fecha_6 = "LLamar a Encargado Pivot Data";
            }

            if ($fecha_5 == 0 or $fecha_5 == "1900-01-01") {
              $fecha_5 = "";
            }elseif ($fecha_5 <> 0) {
              $fecha_5 = $fila['fecha_ac_sa_5'];
            $fecha_5 = date("d-m-Y",strtotime($fecha_5));
            } else{
              $fecha_5 = "LLamar a Encargado Pivot Data";
            }



    }

  }

}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Control de Salidas No Conformes</title>
  <?php echo head(); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    
    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
        <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-info"></i> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> <i class="fa fa-info"></i> <b>Inicio</b></span>
      </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <?php include_once('modulos/barratop.php'); ?>
        </nav>
      </header>

    <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
           <?php include_once('modulos/menu.php');
                if ($_SESSION['perfil'] == "Super Administrador") {
                  echo menuSuperAdministrador();
                }elseif ($_SESSION['perfil'] == "Encargado de Calidad") {
                  echo menuencCalid();
                 }elseif ($_SESSION['perfil'] == "Administrador") {
                  echo menuAdministrador();
                }elseif ($_SESSION['perfil'] == "Ejecutivo Post-Ventas") {
                  echo menuEjecutivo();
                }elseif ($_SESSION['perfil'] == "Coordinador de Calidad") {
                  echo menuCoorCalid();
                }elseif ($_SESSION['perfil'] == "Prevencion de Riesgo") {
                  echo menuPrevRies();
                }elseif ($_SESSION['perfil'] == "Oficina Tecnica") {
                  echo menuOfTec();
                }elseif ($_SESSION['perfil'] == "Usuario Basico") {
                  echo menuUsuarioB();
                }else {
                  echo menuLlamarEncargado();
                }
                ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              <i class="fa fa-file-text"></i> Salida No Conforme
              <small>Pagina para Editar de una Salida No Conforme. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Salida no Conforme</li>
            </ol>
        </section>
      
      <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Coordinador de Calidad") { ?>
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar de Control de Salida No Conforme <strong>#<?php echo "$id"; ?></strong></b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='post' id='editar_salida_nc'>
                <!--action="modulos/edit_salida_nc.php"-->
                <!--id="editar_salida_nc"-->
        
            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-sitemap'></i>Numero de Salida No Conforme </label>
             <input type='text' class='form-control'  name='serie' id='serie'  value='<?php echo "$serial";?>' required>
             <input type='hidden' name='proyecto_v' id='proyecto_v' value='<?php echo $edificio; ?>'>
             <input type='hidden' id='id_s' name='id_s' value='<?php echo $id; ?>'>
           
            </div>  





              
            
            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-building'></i> Proyecto : </label>
             <select name='proyecto' id='proyecto' class='form-control'>
               <option value='' selected>Seleccionar Una Opción</option>
               <?php

                              $con = new salida_nc();
                              $sql = "SELECT edificio.id_ed, edificio.nom_ed FROM edificio;";
                              $consulta = $con->conn->query($sql);
                              
                              if ($consulta) {
                              if ($consulta->num_rows > 0) {
                              while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_ed'];
                              $nombre = $fila['nom_ed'];
                              
                              echo "<option value='".$ID."'>".$nombre."</option>";
                              }
                              }else {
                              echo "<option selected='selected' value=''>NO HAY EDIFfICIO (LLAMAR A ENCARGADO)</option>";
                              }
                              }


               ?>
             </select>
            </div>


            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-building'></i>Proyecto Actual: </label>
             <strong> <input type='text' class='form-control' id='id_s' name='id_s' value='<?php echo "$nombre_ed";  ?>'
              disabled></strong>
           
            </div>

        
                        <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-sitemap'></i> Aréa : </label>
               <?php if ($area == "000001") { ?>
                           <select name='area' id='area' class='form-control'>
                              <option value ='000001' selected>Finanza</option>
                              <option value ='000002'>Prevención Riesgo</option>
                              <option value ='000003'>Adquisiones</option>
                              <option value ='000004'>S. de Gestion de Calidad</option>
                              <option value ='000005'>Estudio de Proyectos</option>
                              <option value ='000006'>Ejecución de Obra</option>
                          </select>
               
               <?php }elseif ($area == "000002") { ?>
                          <select name='area' id='area' class='form-control'>
                              <option value ='000001'>Finanza</option>
                              <option value ='000002' selected>Prevención Riesgo</option>
                              <option value ='000003'>Adquisiones</option>
                              <option value ='000004'>S. de Gestion de Calidad</option>
                              <option value ='000005'>Estudio de Proyectos</option>
                              <option value ='000006'>Ejecución de Obra</option>
                          </select>
               <?php }elseif ($area == "000003") { ?>
                          <select name='area' id='area' class='form-control'>
                              <option value ='000001'>Finanza</option>
                              <option value ='000002'>Prevención Riesgo</option>
                              <option value ='000003' selected>Adquisiones</option>
                              <option value ='000004'>S. de Gestion de Calidad</option>
                              <option value ='000005'>Estudio de Proyectos</option>
                              <option value ='000006'>Ejecución de Obra</option>
                          </select>
               <?php }elseif ($area == "000004") { ?>
                          <select name='area' id='area' class='form-control'>
                              <option value ='000001'>Finanza</option>
                              <option value ='000002'>Prevención Riesgo</option>
                              <option value ='000003'>Adquisiones</option>
                              <option value ='000004' selected>S. de Gestion de Calidad</option>
                              <option value ='000005'>Estudio de Proyectos</option>
                              <option value ='000006'>Ejecución de Obra</option>
                          </select>
               <?php }elseif ($area == "000005") { ?>
                          <select name='area' id='area' class='form-control'>
                              <option value ='000001'>Finanza</option>
                              <option value ='000002'>Prevención Riesgo</option>
                              <option value ='000003'>Adquisiones</option>
                              <option value ='000004'>S. de Gestion de Calidad</option>
                              <option value ='000005' selected >Estudio de Proyectos</option>
                              <option value ='000006'>Ejecución de Obra</option>
                          </select>
               <?php }elseif ($area == "000006") { ?>
                          <select name='area' id='area' class='form-control'>
                              <option value ='000001'>Finanza</option>
                              <option value ='000002'>Prevención Riesgo</option>
                              <option value ='000003'>Adquisiones</option>
                              <option value ='000004'>S. de Gestion de Calidad</option>
                              <option value ='000005'>Estudio de Proyectos</option>
                              <option value ='000006' selected >Ejecución de Obra</option>
                          </select> 
               <?php }else{ ?>
                          <select name='area' id='area' class='form-control'>
                              <option value =''>Llamar Encargado Pivot Data</option>
                              
                          </select>
                <?php }?>
               
             </select>
            </div>

            <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-external-link-square'></i> Acción Afectada:</label>
                   <input type='text' class='form-control' id='accion_a' name='accion_a' placeholder='Accion' value="<?php echo "$act_afec"; ?>" maxlength="50" required>
            </div>


            <div class='form-group col-md-4'>
             <label for='area'><i class='fa fa-sitemap'></i> Etapa : </label>
              <?php if ($etapa == "000001") { ?>
                          <select name='etapa' id='etapa' class='form-control' required>
                              <option value='000001' selected>Obra Gruesa</option>
                              <option value='000002'>Terminaciones</option>
                              <option value='000003'>Instalación Electricas</option>
                              <option value='000004'>Instalación Sanitarias</option>
                          </select>
               <?php }elseif ($etapa == "000002") { ?>
                          <select name='etapa' id='etapa' class='form-control' required>
                              <option value ='000001'>Obra Gruesa</option>
                              <option value ='000002' selected >Terminaciones</option>
                              <option value='000003'>Instalación Electricas</option>
                              <option value='000004'>Instalación Sanitarias</option>
                             
                          </select>
               <?php }elseif ($etapa == "000003") { ?>
                          <select name='etapa' id='etapa' class='form-control' required>
                              <option value='000001'>Obra Gruesa</option>
                              <option value='000002'>Terminaciones</option>
                              <option value='000003' selected>Instalación Electricas</option>
                              <option value='000004'>Instalación Sanitarias</option>
                          </select>
               <?php }elseif ($etapa == "000004") { ?>
                          <select name='etapa' id='etapa' class='form-control' required>
                              <option value='000001'>Obra Gruesa</option>
                              <option value='000002'>Terminaciones</option>
                              <option value='000003'>Instalación Electricas</option>
                              <option value='000004' selected >Instalación Sanitarias</option>
                          </select>

               <?php }else{ ?>
                          <select name='area' id='area' class='form-control'>
                              <option value =''>Llamar Encargado Pivot Data</option>
                              
                          </select>
                <?php }?>
             </select>
            </div>



            
            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-map-marker'></i> Ubicación: </label>
                    <textarea class='form-control' id='ubicacion' name='ubicacion' placeholder='Ubicación' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$ubicacion"; ?></textarea>
            </div>

            


            

            <div class="form-group col-md-12 well well-sm text-center"><strong>1ª PARTE: DETERMINACIÓN DE LA SALIDA NO CONFORME.</strong></div>
            
             <div class='form-group col-md-12'>
              <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Descripción de Salida No Conforme</label>
              <textarea class='form-control' id='desc_sal_1' name='desc_sal_1' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)" maxlength="2500"><?php echo "$desc_salida"; ?></textarea>
             </div>

               <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Evidencia Objetiva: </label>
                    <textarea class='form-control' id='evidencia_1' name='evidencia_1' placeholder='Descripción de Evidencia' onkeypress="return validarDir(event)"  maxlength="2500"><?php echo "$evidencia_12"; ?></textarea>
              </div>

             <div class='form-group col-md-3'>
              <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre de Quien Detecta:</label>
              <input type='text' class='form-control' id='nom_enc_1' name='nom_enc_1' placeholder='JUAN DANIEL MARQUEZ' value="<?php echo "$nom_1"; ?>" maxlength="25" onkeypress="return validarMayusculas(event)">
             </div>
  

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función de quien detecta: </label>
                  <?php if ($fun_1 == "000001") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001' selected>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000002") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002' selected>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000003") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' selected>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000004") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004' selected>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000005") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005' selected>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>     
                  <?php }elseif ($fun_1 == "000006") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006' selected>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000007") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007' selected>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000008") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008' selected>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000009") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009' selected >Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000010") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' selected>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000011") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011' selected >Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000012") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'  selected  >Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000013") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'  selected >Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000014") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014' selected >Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000015") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'  selected >Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>        
                  <?php }elseif ($fun_1 == "000016") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'  selected >Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_1 == "000017") { ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'  selected >Otro</option>
                          </select>
                  <?php }else{ ?>
                          <select name='funcion_1' id='funcion_1' class='form-control' >
                              <option value ='' selected> Escoger Funcion </option>
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }?>
  
            </div>

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Origen : </label>


              <?php if ($origen == "000001") { ?>
                           <select name='origen_1' id='origen_1' class='form-control' >
                              <option value='000001' selected>Requisito de Cliente</option>
                              <option value='000002'>Requisito de Organización</option>
                              <option value='000003'>Requisito Legal</option>
                              <option value='000004'>Otro</option>
                          </select>
                          
                  
                 <?php }elseif ($origen == "000002") { ?>
                           <select name='origen_1' id='origen_1' class='form-control' >
                              <option value='000001'>Requisito de Cliente</option>
                              <option value='000002' selected>Requisito de Organización</option>
                              <option value='000003'>Requisito Legal</option>
                              <option value='000004'>Otro</option>
                          </select>
                          

                <?php }elseif ($origen == "000003") { ?>
                           <select name='origen_1' id='origen_1' class='form-control' >
                              <option value='000001'>Requisito de Cliente</option>
                              <option value='000002'>Requisito de Organización</option>
                              <option value='000003' selected >Requisito Legal</option>
                              <option value='000004'>Otro</option>
                          </select>

                 <?php }elseif ($origen == "000004") { ?>
                           <select name='origen_1' id='origen_1' class='form-control' >
                              <option value='000001'>Requisito de Cliente</option>
                              <option value='000002'>Requisito de Organización</option>
                              <option value='000003'>Requisito Legal</option>
                              <option value='000004' selected >Otro</option>
                          </select>
                        


                <?php }else{ ?>
                          <select name='origen_1' id='origen_1' class='form-control' >
                              <option value ='' selected>LLAMAR ENCARGADO PIVOTDATA </option>
                              
                          </select>
                 <?php }?>


              
            </div>
              

            <div class="form-group col-md-3">
              <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
              <input type="date" class="form-control" name="fecha_sa_1" id="fecha_sa_1" value="<?php echo"$fecha_inicio" ?>">
            </div>
            
            



          
            <div class="form-group col-md-12 well well-sm text-center"><strong>2ª PARTE: ACCIONES PARA CONTROLAR Y CORREGIR LA SALIDA NO CONFORME.</strong></div>


                  <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Acción Inmediata: </label>
                    <textarea class='form-control' id='desc_ac_in_2' name='desc_ac_in_2' placeholder='Descripcion de Acciones Inmediatas' onkeypress="return validarDir(event)"  maxlength="2500"><?php echo "$desc_2"; ?></textarea>
                  </div>
                  <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre del Responsable de La Implementación: </label>
                   <input type='text' class='form-control' id='nom_enc_2' name='nom_enc_2' placeholder='JUAN DANIEL MARQUEZ' value="<?php echo"$nom_2" ?>" maxlength="50" onkeypress="return validarMayusculas(event)" >
                  </div>

                  <div class='form-group col-md-4'>
                  <label for='area'><i class='fa fa-circle-o-notch'></i> Función del Responsable de La Implementación: </label>
                  <?php if ($fun_2 == "000001") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001' selected>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000002") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002' selected>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000003") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' selected>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000004") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004' selected>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000005") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005' selected>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>     
                  <?php }elseif ($fun_2 == "000006") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006' selected>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000007") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007' selected>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000008") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008' selected>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000009") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009' selected >Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000010") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' selected>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000011") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011' selected >Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000012") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'  selected  >Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000013") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'  selected >Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000014") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014' selected >Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000015") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'  selected >Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>        
                  <?php }elseif ($fun_2 == "000016") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'  selected >Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_2 == "000017") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'  selected >Otro</option>
                          </select>
                  <?php }else{ ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='' selected> Escoger Funcion </option>
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                              
                          </select>
                  <?php }?>
  
            </div>


                  <div class="form-group col-md-3">
                    <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
                    <input type="date" class="form-control" name="fecha_ac_in_2" id="fecha_ac_in_2" value="<?php echo "$fecha_2"; ?>">
                  </div>


            <div class="form-group col-md-12 well well-sm text-center"><strong>3ª PARTE: EVALUACIÓN DE ACCIONES PARA ELIMINAR CAUSAS DE  LA SALIDA NO CONFORME.</strong></div>
                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Análisis y Determinación de Causa(s) Raíz(ces) de la Salida No Conforme: </label>
                    <textarea class='form-control' id='desc_ana_eva_3' name='desc_ana_eva_3' placeholder='Descripcion de Analisis y Determinación' onkeypress="return validarDir(event)" maxlength="2500"><?php echo"$desc_3"; ?></textarea>
                </div>
                <div class='form-group col-md-4'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Parte Interesada Responsable de la Causa de la No Conformidad: </label>
                    
                    
                  <?php if ($parte_3 == "Gerente General") { ?>
                           <select name='desc_int_3' id='desc_int_3' class='form-control' >
                             <option value ='Gerente Genera' selected >Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Subgerente") { ?>
                           <select name='desc_int_3' id='desc_int_3' class='form-control' >
                            <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente' selected>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Gerente Tecnico") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico' selected>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Jefe de Calidad") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad' selected >Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Jefe de Seguridad") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad' selected >Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>     
                  <?php }elseif ($parte_3 == "Encargado de Calidad") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad' selected >Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Coordinador de Calidad") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                              <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad' selected >Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Supervisor") { ?>
                          <select name='funcion_2' id='funcion_2' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor' selected >Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Adm. de Obra") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra' selected >Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Jefe de Terreno") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                            <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno' selected >Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Oficina Técnica") { ?>
                         <select name='desc_int_3' id='desc_int_3' class='form-control' >
                           <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica' selected >Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Jefe de Obra<") { ?>
                         <select name='desc_int_3' id='desc_int_3' class='form-control' >
                           <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra' selected >Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Proveedor de Servicios") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios' selected >Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                            </select>
                  <?php }elseif ($parte_3 == "Proveedor de Producto") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                           
                           <option value ='Gerente Genera'>Gerente General</option>
                           <option value ='Subgerente'>Subgerente</option>
                           <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                           <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                           <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                           <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                           <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                           <option value ='Supervisor'>Supervisor</option>
                           <option value ='Adm. de Obra'>Adm. de Obra</option>
                           <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                           <option value ='Oficina Técnica'>Oficina Técnica</option>
                           <option value ='Jefe de Obra'>Jefe de Obra</option>
                           <option value ='Proveedor de Servicios' selected >Proveedor de Servicios</option>
                           <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                           <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                           <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                           <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Mandante (ITO)") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                             
                             <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)' selected >Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Prevención de Riesgo") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                           
                           <option value ='Gerente Genera'>Gerente General</option>
                           <option value ='Subgerente'>Subgerente</option>
                           <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                           <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                           <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                           <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                           <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                           <option value ='Supervisor'>Supervisor</option>
                           <option value ='Adm. de Obra'>Adm. de Obra</option>
                           <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                           <option value ='Oficina Técnica'>Oficina Técnica</option>
                           <option value ='Jefe de Obra'>Jefe de Obra</option>
                           <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                           <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                           <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                           <option value ='Prevención de Riesgo' selected >Prevención de Riesgo</option>
                           <option value ='Otro'>Otro</option>
                          </select>
                  <?php }elseif ($parte_3 == "Otro") { ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                           <option value ='Gerente Genera'>Gerente General</option>
                             <option value ='Subgerente'>Subgerente</option>
                             <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                             <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                             <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                             <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                             <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                             <option value ='Supervisor'>Supervisor</option>
                             <option value ='Adm. de Obra'>Adm. de Obra</option>
                             <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                             <option value ='Oficina Técnica'>Oficina Técnica</option>
                             <option value ='Jefe de Obra'>Jefe de Obra</option>
                             <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                             <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                             <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                             <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                             <option value ='Otro' selected>Otro</option>
                          </select>
                  <?php }else{ ?>
                          <select name='desc_int_3' id='desc_int_3' class='form-control' >
                       <option value ='' selected>Seleccionar Una Opción</option>
                       <option value ='Gerente Genera'>Gerente General</option>
                       <option value ='Subgerente'>Subgerente</option>
                       <option value ='Gerente Tecnico'>Gerente Tecnico</option>
                       <option value ='Jefe de Calidad'>Jefe de Calidad</option>
                       <option value ='Jefe de Seguridad'>Jefe de Seguridad</option>
                       <option value ='Encargado de Calidad'>Encargado de Calidad</option>
                       <option value ='Coordinador de Calidad'>Coordinador de Calidad</option>
                       <option value ='Supervisor'>Supervisor</option>
                       <option value ='Adm. de Obra'>Adm. de Obra</option>
                       <option value ='Jefe de Terreno'>Jefe de Terreno</option>
                       <option value ='Oficina Técnica'>Oficina Técnica</option>
                       <option value ='Jefe de Obra'>Jefe de Obra</option>
                       <option value ='Proveedor de Servicios'>Proveedor de Servicios</option>
                       <option value ='Proveedor de Producto'>Proveedor de Producto</option>
                       <option value ='Mandante (ITO)'>Mandante (ITO)</option>
                       <option value ='Prevención de Riesgo'>Prevención de Riesgo</option>
                       <option value ='Otro'>Otro</option>
                      </select>
                  <?php }?>

                </div>



            <div class="form-group col-md-12 well well-sm text-center"><strong>4ª PARTE: ACCIÓN CORRECTIVA.</strong></div>

            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Implementación de Acciones Necesarias Para Corregir la(s) Causa(S) Raíz(ces) de la salida No Conforme: </label>
                    <textarea class='form-control' id='desc_imple_4' name='desc_imple_4' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)"  maxlength="2500"><?php echo "$imple_4"; ?></textarea>
            </div>

             <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre del Responsable del Proceso Designado por la Alta Dirección: </label>
                   <input type='text' class='form-control' id='nom_enc_4' name='nom_enc_4' placeholder='JUAN DANIEL MARQUEZ'  maxlength="50" onkeypress="return validarMayusculas(event)" value="<?php echo "$nom_4" ;?>" >
             </div>

          <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función: <br><br></label>
                  <?php if ($fun_4 == "000001") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001' selected>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000002") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002' selected>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000003") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' selected>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000004") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004' selected>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000005") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005' selected>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>     
                  <?php }elseif ($fun_4 == "000006") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006' selected>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000007") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007' selected>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000008") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008' selected>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000009") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009' selected >Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000010") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' selected>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000011") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011' selected >Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000012") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'  selected  >Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000013") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'  selected >Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000014") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014' selected >Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000015") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'  selected >Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>        
                  <?php }elseif ($fun_4 == "000016") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'  selected >Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_4 == "000017") { ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'  selected >Otro</option>
                          </select>
                  <?php }else{ ?>
                          <select name='funcion_4' id='funcion_4' class='form-control' >
                              <option value ='' selected> Escoger Funcion </option>
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                              
                          </select>
                  <?php }?>
  
            </div>
                    


             <div class="form-group col-md-3">
                <label for='area'><i class='fa fa-calendar'></i> Fecha : <br><br></label>
                <input type="date" class="form-control" name="fecha_ac_co_4" id="fecha_ac_co_4" value="<?php echo "$fecha_4"; ?>">
             </div>
              

            <div class="form-group col-md-12 well well-sm text-center"><strong>5ª PARTE: ACEPTACIÓN DE LA SALIDA NO CONFORME BAJO CONCESIÓN DE PARTE DEL CLIENTE.</strong></div>  
                     <div class='form-group col-md-3'>
                     <label for='area'><i class='fa fa-circle-o-notch'></i> Aceptación bajo Concesión:</label>
                     
                     <?php if ($acep_op_5 == "1") { ?>
                          <select name='aceptacion_5' id='aceptacion_5' class='form-control' >
                             <option value='<?php echo $acep_op_5; ?>'>Si</option>
                             <option value='000002'>No</option>
                          </select>
                          <?php }elseif ($acep_op_5 == "2") { ?>
                           <select name='aceptacion_5' id='aceptacion_5' class='form-control' >
                             <option value='<?php echo $acep_op_5; ?>'>No</option>
                             <option value='000001'>Si</option>
                            </select>
                          <?php } else { ?>
                            <select name='aceptacion_5' id='aceptacion_5' class='form-control' >
                             <option value=''>Escoge Opción</option>
                             <option value='000001'>Si</option>
                             <option value='000002'>No</option>
                            </select>
                          <?php } ?>
                     </select>
                     </div>
                     
                     <div class='form-group col-md-12'>
                     <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Observación de la Aceptación (Sólo Si Corresponde): </label>
                     <textarea class='form-control' id='obs_acep_5' name='obs_acep_5' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)" maxlength="2500"><?php echo "$obser_5"; ?></textarea>
                     </div>
                     
                     <div class='form-group col-md-3'>
                     <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre del Cliente</label>
                     <input type='text' class='form-control' id='nom_enc_5' name='nom_enc_5' placeholder='JUAN DANIEL MARQUEZ' value=" <?php echo"$nom_5"; ?> " maxlength="50" onkeypress="return validarMayusculas(event)">
                     </div>
                     <div class="form-group col-md-3">
                     <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
                     <input type="date" class="form-control" name="fecha_acep_5" id="fecha_acep_5" value="<?php echo"$fecha_5";?>">
                     </div>

          
            <div class="form-group col-md-12 well well-sm text-center"><strong>6ª PARTE: CIERRE DEL REGISTRO.</strong></div>

                        <div class  ='form-group col-md-3'>
                        <label for  ='nombre_usuario'><i class='fa fa-male'></i> Responsable del Proceso Designado por la Alta Dirección:</label>
                        <input type ='text' class='form-control' id='nom_enc_6' name='nom_enc_6' placeholder='JUAN DANIEL MARQUEZ' value="<?php echo"$nom_6"; ?>" maxlength="50" onkeypress="return validarMayusculas(event)">
                        </div>
                        
              <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función del Responsable del Proceso Designado por la Alta Dirección : </label>
                  <?php if ($fun_6 == "000001") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001' selected>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000002") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002' selected>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000003") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' selected>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000004") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004' selected>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000005") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005' selected>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>     
                  <?php }elseif ($fun_6 == "000006") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006' selected>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000007") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007' selected>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000008") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008' selected>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000009") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009' selected >Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000010") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' selected>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000011") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011' selected >Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000012") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'  selected  >Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000013") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'  selected >Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000014") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014' selected >Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000015") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'  selected >Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>        
                  <?php }elseif ($fun_6 == "000016") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'  selected >Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                          </select>
                  <?php }elseif ($fun_6 == "000017") { ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003' >Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010' >Jefe de Terreno</option>
                              <option value ='000011'selected>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'  selected >Otro</option>
                          </select>
                  <?php }else{ ?>
                          <select name='funcion_6' id='funcion_6' class='form-control' >
                              <option value ='' selected> Escoger Funcion </option>
                              <option value ='000001'>Gerente General</option>
                              <option value ='000002'>Subgerente</option>
                              <option value ='000003'>Gerente Tecnico</option>
                              <option value ='000004'>Jefe de Calidad</option>
                              <option value ='000005'>Jefe de Seguridad</option>
                              <option value ='000006'>Encargado de Calidad</option>
                              <option value ='000007'>Coordinador de Calidad</option>
                              <option value ='000008'>Supervisor</option>
                              <option value ='000009'>Adm. de Obra</option>
                              <option value ='000010'>Jefe de Terreno</option>
                              <option value ='000011'>Oficina Técnica</option>
                              <option value ='000012'>Jefe de Obra</option>
                              <option value ='000013'>Proveedor de Servicios</option>
                              <option value ='000014'>Proveedor de Producto</option>
                              <option value ='000015'>Mandante (ITO)</option>
                              <option value ='000016'>Prevención de Riesgo</option>
                              <option value ='000017'>Otro</option>
                              
                          </select>
                  <?php }?>
  
            </div>

                  <div class="form-group col-md-4">
                    <label for='area'><i class='fa fa-calendar'></i> Fecha : <br><br></label>
                     <input type="date" class="form-control"  name="fecha_cie_6" id="fecha_cie_6" value="<?php echo"$fecha_6"; ?>">
                  </div>

                  <div class    ='form-group col-md-4'>
                        <label for    ='area'><i class='fa fa-sitemap'></i>¿Se Agrega a Matriz de Riesgos y Oportunidades?: </label>
                    
                        
                        <?php if ($agregar_m == "000001") { ?>
                          <select name  ='agregar_m' id='agregar_m' required class='form-control'>
                            <option value ='000001' selected >Si</option>
                            <option value ='000002'>No</option>
                          </select>
                          
                           <?php }elseif ($agregar_m == "000002") { ?>
                          <select name  ='agregar_m' id='agregar_m' required class='form-control'>
                            <option value ='000001' >Si</option>
                            <option value ='000002' selected >No</option>
                          </select>

                            <?php }else{ ?>
                                      <select  name  ='agregar_m' id='agregar_m' class='form-control' >
                                          <option value ='' required selected>Escoge una Opcion </option>
                                          <option value ='000001'>Si</option>
                                          <option value ='000002'>No</option>
                                      </select>
                             <?php }?>


                  </div>

                                          <div class    ='form-group col-md-4 pull-right'>
                                          <label for    ='area'><i class='fa fa-sitemap'></i> Estado de la Salida: </label>
                                          
                                          
                                          <?php if ($estado == "000000") { ?>
                                          <select name  ='estado' id='estado' required class='form-control'>
                                          <option value ='000000' selected >Pendiente</option>
                                          <option value ='000001'>Cerrado</option>
                                          <option value ='000002'>Sin Analizar</option>
                                          
                                          </select>
                                          
                                          <?php }elseif ($estado == "000001") { ?>
                                          <select name  ='estado' id='estado' required class='form-control'>
                                          <option value ='000000' >Pendiente</option>
                                          <option value ='000001' selected >Cerrado</option>
                                          <option value ='000002'>Sin Analizar</option>
                                          </select>

                                           <?php }elseif ($estado == "000002") { ?>
                                          <select name  ='estado' id='estado' class='form-control'>
                                          <option value ='000000' >Pendiente</option>
                                          <option value ='000001' >Cerrado</option>
                                          <option value ='000002'selected >Sin Analizar</option>
                                          </select>
                                          
                                          <?php }else{ ?>
                                          <select  name  ='estado' id='estado' required class='form-control' >
                                          <option value ='' selected>Escoge una Opcion </option>
                                          <option value ='000000'>Pendiente</option>
                                          <option value ='000001'>Cerrado</option>
                                          <option value ='000002'>Sin Analizar</option>
                                          </select>
                                          <?php }?>
                                          
                                          
                                          </div>
      

                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Salida">
                    <a type='button' class='btn btn-danger pull-left' href='lista_salidanc.php'>Cancelar Proceso</a>
                  </div>




                     </form>

            </div>
          </div><!-- /.box-body -->

        </div>
          
        </section><!-- cierre content -->

        <?php }else { echo "<div class='box-body'>
              <div class='alert alert-danger alert-dismissible'>
              <h4><i class='icon fa fa-ban'></i> Alerta!</h4>
              Disculpe estimado usuario, no tiene permisos para gestionar este módulo.
              </div></div>"; } ?>


      </div><!-- /.content-wrapper - Contenedor Principal de la Página -->

      <?php echo insertar_footer(); ?>



  </div><!-- ./wrapper -->

  <?php echo insertarScripts(); ?>

<script type="text/javascript">

function validarLetras(e) 
  {
    tecla = (document.form) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z\sáéíóúñÁÉÍÓÚÑ']{1,45}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras.");
    };
    return patron.test(te);
  }

  function validarMayusculas(e) 
  {
    tecla = (document.form) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Z SÁÉÍÓÚÑ']{1,45}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras Mayusculas.");
    };
    return patron.test(te);
  }

function validarCorreo(e) 
  { 

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9_.\-@]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo letras, números y caracteres como: _.\-");
    };
    return patron.test(te); 

  }

function validarPass(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/^[A-Za-z0-9]{1,16}$/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la contraseña debe ingresar solo letras y números y debe tener mínimo 8 dígitos.");
    };
    return patron.test(te); 

  }

function validarDir(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-#,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/@*#!");
    };
    return patron.test(te); 

  }

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
</script>
</body>
</html>