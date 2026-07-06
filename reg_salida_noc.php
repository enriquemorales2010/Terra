<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/salida_nc.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');



$con = new salida_nc();

  $sql = "SELECT count(*) from salida_no_c";
  $consulta = $con->conn->query($sql);
  $contador = $consulta->num_rows;

  if ($contador == 0){

    $contador = 1 ;

  } else{

  $contador = $contador +1;

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
              <small>Pagina para Ingreso de una Salida No Conforme. <i class="fa fa-info"></i></small>
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
              <h3 class="box-title"><b>Registro de Control de Salida No Conforme</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='post' id='reg_salida_nc' >
                    <!--id='reg_salida_nc'-->
                   <!--action="modulos/reg_salida_nc.php"-->

          
           <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-sitemap'></i>Numero de Salida No Conforme </label>
             <strong> <input type='text' class='form-control' name='id_s' id='id_s' required onkeypress="return validarCodigo(event)" maxlength="10"></strong>
            </div>  



          <div class='form-group col-md-4'>
             <label for='area'><i class='fa fa-sitemap'></i> Aréa : </label>
             <select name='area' id='area' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Finanza</option>
               <option value='000002'>Prevención Riesgo</option>
               <option value='000003'>Adquisiones</option>
               <option value='000004'>S. de Gestion de Calidad</option>
               <option value='000005'>Estudio de Proyectos</option>
               <option value='000006'>Ejecución de Obra</option>
               
               <!--Finanza = 000001 
                   Prevención Riesgo = 000002 
                   Adquisiones = 000003 
                   S. de Gestion de Calidad = 000004
                   Estudio de Proyectos = 000005-->
             </select>
            
          </div>
              
            
            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-building'></i> Proyecto : </label>
             <select name='proyecto' id='proyecto' class='form-control' required>
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
                              echo "<option selected='selected' value=''>NO HAY EDIICIO (LLAMAR A ENCARGADO)</option>";
                              }
                              }


               ?>
             </select>
            </div>
              


            <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-external-link-square'></i> Acción Afectada:</label>
                   <input type='text' class='form-control' id='accion_a' name='accion_a' placeholder='Accion' value="" maxlength="50" required>
            </div>


            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-sitemap'></i> Etapa : </label>
             <select name='etapa' id='etapa' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Obra Gruesa</option>
               <option value='000002'>Terminaciones</option>
               <option value='000003'>Instalación Electricas</option>
               <option value='000004'>Instalación Sanitarias</option>
               
             </select>
            </div>

            
            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-map-marker'></i> Ubicación: </label>
                    <textarea class='form-control' id='ubicacion' name='ubicacion' placeholder='Ubicación' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
            </div>

            

            <div class="form-group col-md-12 well well-sm text-center"><strong>1ª PARTE: DETERMINACIÓN DE LA SALIDA NO CONFORME.</strong></div>
            
             <div class='form-group col-md-12'>
              <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Descripción de Salida No Conforme</label>
              <textarea class='form-control' id='desc_sal_1' name='desc_sal_1' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)" maxlength="2500"></textarea>
             </div>

              <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Evidencia Objetiva: </label>
                    <textarea class='form-control' id='evidencia_1' name='evidencia_1' placeholder='Descripción de Evidencia' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
              </div>

             <div class='form-group col-md-3'>
              <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre de quien detecta</label>
              <input type='text' class='form-control' id='nom_enc_1' name='nom_enc_1' placeholder='JUAN DANIEL MARQUEZ' value="" maxlength="25" onkeypress="return validarMayusculas(event)" >
             </div>
              
            <!--
                  GERENTE GENERAL
                  SUBGERENTE
                  GERENTE TÉCNICO 
                  JEFE DE CALIDAD 
                  JEFE DE SEGURIDAD 
                  ENCARGADO DE CALIDAD 
                  COORDINADOR DE CALIDAD 
                  SUPERVISOR
                  ADMINISTRADOR DE OBRA
                  JEFE DE TERRENO
                  OF. TÉCNICA
            -->

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función de quien detecta: </label>
               <select name='funcion_1' id='funcion_1' class='form-control'>
               <option value ='' selected>Seleccionar Una Opción</option>
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
            </div>

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Origen : </label>
               <select name='origen_1' id='origen_1' class='form-control' >
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Requisito de Cliente</option>
               <option value='000002'>Requisito de Organización</option>
               <option value='000003'>Requisito Legal</option>
               <option value='000004'>Otro</option>
               </select>
            </div>
              

            <div class="form-group col-md-3">
              <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
              <input type="date" class="form-control" name="fecha_sa_1" id="fecha_sa_1">
            </div>
            
            



          
            <div class="form-group col-md-12 well well-sm text-center"><strong>2ª PARTE: ACCIONES PARA CONTROLAR Y CORREGIR LA SALIDA NO CONFORME.</strong></div>


                  <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Acción Inmediata: </label>
                    <textarea class='form-control' id='desc_ac_in_2' name='desc_ac_in_2' placeholder='Descripcion de Acciones Inmediatas' onkeypress="return validarDir(event)" maxlength="2500"></textarea>
                  </div>
                  <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-male'></i>Nombre del Responsable de La Implementación:</label>
                   <input type='text' class='form-control' id='nom_enc_2' name='nom_enc_2' placeholder='JUAN DANIEL MARQUEZ' value="" maxlength="50" onkeypress="return validarMayusculas(event)" >
                  </div>

            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función del Responsable de la Implementación: </label>
               <select name='funcion_2' id='funcion_2' class='form-control' >
               <option value ='' selected>Seleccionar Una Opción</option>
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
            </div>
                  <div class="form-group col-md-3">
                    <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
                    <input type="date" class="form-control" name="fecha_ac_in_2" id="fecha_ac_in_2">
                  </div>


            <div class="form-group col-md-12 well well-sm text-center"><strong>3ª PARTE: EVALUACIÓN DE ACCIONES PARA ELIMINAR CAUSAS DE  LA SALIDA NO CONFORME.</strong></div>
                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Análisis y Determinación de Causa(s) Raíz(ces) de la Salida No Conforme: </label>
                    <textarea class='form-control' id='desc_ana_eva_3' name='desc_ana_eva_3' placeholder='Descripcion de Analisis y Determinación' onkeypress="return validarDir(event)" maxlength="2500"></textarea>
                </div>
                <div class='form-group col-md-4'>
                      <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Parte Interesada Responsable de la Causa de la No Conformidad: </label>
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
                </div>
                



            <div class="form-group col-md-12 well well-sm text-center"><strong>4ª PARTE: ACCIÓN CORRECTIVA.</strong></div>

            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Implementación de Acciones Necesarias Para Corregir la(s) Causa(S) Raíz(ces) de la salida No Conforme: </label>
                    <textarea class='form-control' id='desc_imple_4' name='desc_imple_4' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)"  maxlength="2500"></textarea>
            </div>

             <div class='form-group col-md-4'>
                   <label for='nombre_usuario'><i class='fa fa-male'></i>Nombre del Responsable del Proceso Designado por la Alta Dirección:</label>
                   <input type='text' class='form-control' id='nom_enc_4' name='nom_enc_4' placeholder='JUAN DANIEL MARQUEZ' maxlength="50" onkeypress="return validarMayusculas(event)" >
             </div>

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Función: <br><br></label>
               <select name='funcion_4' id='funcion_4' class='form-control'>
               <option value ='' selected>Seleccionar Una Opción</option>
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
            </div>

             <div class="form-group col-md-3">
                <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
                <input type="date" class="form-control" name="fecha_ac_co_4" id="fecha_ac_co_4">
             </div>
              

            <div class="form-group col-md-12 well well-sm text-center"><strong>5ª PARTE: ACEPTACIÓN DE LA SALIDA NO CONFORME BAJO CONCESIÓN DE PARTE DEL CLIENTE.</strong></div>  
                     <div class='form-group col-md-3'>
                     <label for='area'><i class='fa fa-circle-o-notch'></i> Aceptación bajo Concesión:</label>
                     <select name='aceptacion_5' id='aceptacion_5' class='form-control'>
                     <option value='' selected>Seleccionar Una Opción</option>
                     <option value='000001'>Si</option>
                     <option value='000002'>No</option>
                     </select>
                     </div>
                     
                     <div class='form-group col-md-12'>
                     <label for='dir_usuario'><i class='fa fa-external-link-square'></i> Observación de la Aceptación (Sólo Si Corresponde): </label>
                     <textarea class='form-control' id='obs_acep_5' name='obs_acep_5' placeholder='Descripcion de Salida' onkeypress="return validarDir(event)" maxlength="2500"></textarea>
                     </div>
                     
                     <div class='form-group col-md-3'>
                     <label for='nombre_usuario'><i class='fa fa-male'></i> Nombre del Cliente</label>
                     <input type='text' class='form-control' id='nom_enc_5' name='nom_enc_5' placeholder='JUAN DANIEL MARQUEZ' value="" maxlength="50" onkeypress="return validarMayusculas(event)" >
                     </div>
                     <div class="form-group col-md-3">
                     <label for='area'><i class='fa fa-calendar'></i> Fecha : </label>
                     <input type="date" class="form-control" name="fecha_acep_5" id="fecha_acep_5">
                     </div>

          
            <div class="form-group col-md-12 well well-sm text-center"><strong>6ª PARTE: CIERRE DEL REGISTRO.</strong></div>

                        <div class  ='form-group col-md-4'>
                        <label for  ='nombre_usuario'><i class='fa fa-male'></i> Responsable del Proceso Designado por la Alta Dirección:</label>
                        <input type ='text' class='form-control' id='nom_enc_6' name='nom_enc_6' placeholder='JUAN DANIEL MARQUEZ' value="" maxlength="50" onkeypress="return validarMayusculas(event)">
                        </div>
                        
                        <div class    ='form-group col-md-4'>
                        <label for    ='area'><i class='fa fa-sitemap'></i> Función del Responsable del Proceso Designado por la Alta Dirección : </label>
                        <select name  ='funcion_6' id='funcion_6' class='form-control'>
                        <option value ='' selected>Seleccionar Una Opción</option>
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
                        </div>

                  <div class="form-group col-md-4">
                    <label for='area'><i class='fa fa-calendar'></i> Fecha : <br><br></label>
                     <input type="date" class="form-control" name="fecha_cie_6" id="fecha_cie_6">
                  </div>
                  
                   <div class    ='form-group col-md-4'>
                        <label for    ='area'><i class='fa fa-sitemap'></i>¿Se Agrega a Matriz de Riesgos y Oportunidades?: </label>
                        <select name  ='agregar_m' id='agregar_m' class='form-control'>
                        <option value ='' selected>Seleccionar Una Opción</option>
                        <option value ='000001'>Si</option>
                        <option value ='000002'>No</option>
                        </select>
                        </div>  


                        <div class    ='form-group col-md-4 pull-right'>
                        <label for    ='area'><i class='fa fa-sitemap'></i> Estado de la Salida: </label>
                        <select name  ='estado' id='estado' class='form-control'>
                          <option value ='' selected >Seleccionar</option>
                          <option value ='000000'>Pendiente</option>
                          <option value ='000001'>Cerrado</option>
                          <option value ='000002'>Sin Analizar</option>
                        </select>
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

  function validarCodigo(e) 
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