<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/matrizdoc.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');



$id = $_GET['id_matriz_doc'];

$con = new matrizdoc();

  $sql = "SELECT matriz_doc.id_matriz_doc, matriz_doc.codigo_doc, matriz_doc.orig_doc, matriz_doc.macroproceso, matriz_doc.tipo_doc, matriz_doc.num_doc, matriz_doc.detalle_doc, matriz_doc.n_ver, matriz_doc.estado_ver, matriz_doc.fecha_elab_ver, matriz_doc.obs_ver, matriz_doc.ubi_ver, matriz_doc.respo_reg, matriz_doc.respo_reg1, matriz_doc.respo_reg2, matriz_doc.respo_reg3, matriz_doc.respo_reg4, matriz_doc.alm_reg, matriz_doc.prot_reg, matriz_doc.recup_reg, matriz_doc.tiempo_reg, matriz_doc.dispo_reg FROM matriz_doc WHERE matriz_doc.id_matriz_doc = '$id';";
$consulta = $con->conn->query($sql);


  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

     /* if($fila['estado'] == 1) {
        $estado = "Activo";
      }else {
        $estado = "Inactivo";
      }*/
  $id = $fila['id_matriz_doc'];
  $codigo_doc = $fila['codigo_doc'];
  $orig_doc = $fila['orig_doc'];
  $macroproceso = $fila['macroproceso'];
  $tipo_doc = $fila['tipo_doc'];
  $num_doc = $fila['num_doc'];
  $detalle_doc = $fila['detalle_doc'];
  $n_ver = $fila['n_ver'];
  $estado_ver = $fila['estado_ver'];
  $obs_ver = $fila['obs_ver'];
  $fecha_elab1 = $fila['fecha_elab_ver'];
  $ubi_ver = $fila['ubi_ver'];
  $respo_reg = $fila['respo_reg'];
  $respo_reg1 = $fila['respo_reg1'];
  $respo_reg2 = $fila['respo_reg2'];
  $respo_reg3 = $fila['respo_reg3'];
  $respo_reg4 = $fila['respo_reg4'];
  $alm_reg = $fila['alm_reg'];
  $prot_reg = $fila['prot_reg'];
  $recup_reg = $fila['recup_reg'];
  $tiempo_reg = $fila['tiempo_reg'];
  $dispo_reg = $fila['dispo_reg'];

}
}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Control de Documentación</title>
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
            <h1>Control de Documentación
              <small>Pagina para Ingreso de un Registro de Doc. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sis. de Gestión de Datos</a></li>
              <li class="active">Control de Documentación</li>
            </ol>
        </section>
      
      <?php if ($_SESSION['perfil'] == "Super Administrador" or $_SESSION['perfil'] == "Coordinador de Calidad") { ?>
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Edición de Documentación</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='POST' id='editar_matriz_doc' >
                    <!--id='editar_matriz_doc'-->
                   <!--action="modulos/edit_mat_doc.php"-->

          <div class="form-group col-md-12 well well-sm text-center"><strong> CLASIFICACIÓN DE DOCUMENTO.</strong></div>
          <div class='form-group col-md-3 col-md-offset-1'>
             <label for='area'><i class='fa fa-list'></i> Codigo: </label>
              <input type='text' class='form-control' name='codigo_serie' id='codigo_serie'  placeholder='' value = '<?php echo "$codigo_doc";?>' disabled>
              
            </div>   


            <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Origen : </label>
              <?php if ($orig_doc == 1){ ?>
               <select name='origen' id='origen' class='form-control' required>
               <option value='000001' selected>Interno</option>
               <option value='000002'>Externo</option>
             </select>
              <?php } elseif($orig_doc == 2){ ?>
                <select name='origen' id='origen' class='form-control' required>
               <option value='000001'>Interno</option>
               <option value='000002' selected>Externo</option>
             </select>
             <?php } else{ ?>
                <select name='origen' id='origen' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Interno</option>
               <option value='000002'>Externo</option>
             </select>
             
              <?php } ?>

            </div>



             <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Tipo de Documento : </label>
               <?php if ($tipo_doc == 1){ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='000001' seleted >Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003'>Instructivo</option>
               <option value='000004'>Registro</option>
               <option value='000005'>Documento Especial</option>
               </select>
               <?php }elseif ($tipo_doc == 2){ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='000001'>Manual</option>
               <option value='000002' seleted >Procedimiento</option>
               <option value='000003'>Instructivo</option>
               <option value='000004'>Registro</option>
               <option value='000005'>Documento Especial</option>
               </select>
               <?php } elseif($tipo_doc == 3){ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='000001'>Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003' selected >Instructivo</option>
               <option value='000004' >Registro</option>
               <option value='000005'>Documento Especial</option>
               </select>
                <?php } elseif($tipo_doc == 4){ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='000001'>Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003'>Instructivo</option>
               <option value='000004' selected >Registro</option>
               <option value='000005'>Documento Especial</option>
               </select>
               <?php } elseif($tipo_doc == 5){ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='000001'>Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003'>Instructivo</option>
               <option value='000004' >Registro</option>
               <option value='000005' selected >Documento Especial</option>
               </select>
               <?php } else{ ?>
               <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='' selected   >Seleccionar Una Opción</option>
               <option value='000001'>Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003'>Registro</option>
               <option value='000004'>Documento Especial</option>
               </select>
               <?php } ?>
            </div>
            
        <!--
        Prevención de riesgos: PR
Ejecución de obra: EO
Finanzas: FS
Adquisiciones: AD
Recursos humanos: RH
Estudio de propuesta: EP
Post venta: PV
Sistema de gestión: SG-->

         

          <div class='form-group col-md-3 col-md-offset-1'>
             <label for='area'><i class='fa fa-sitemap'></i> Macroproceso : </label>


              <?php if ($macroproceso == 1){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)" disabled required>
                <option value='01' selected >Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select> 

              <?php }elseif ($macroproceso == 2){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02' selected >Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 3){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03' selected >Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 4){ ?>
              <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04' selected >Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 5){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05' selected >Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 6){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06' selected >Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 7){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07' selected >Recursos humanos</option>
                <option value='08'>Sistema de Gestión</option>
                </select>
              <?php } elseif($macroproceso == 8){ ?>
                <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
                <option value='01'>Adquisiciones</option>
                <option value='02'>Ejecución de obra</option>
                <option value='03'>Estudio de propuesta</option>
                <option value='04'>Finanzas</option>
                <option value='05'>Post-ventas</option>
                <option value='06'>Prevención de riesgos</option>
                <option value='07'>Recursos humanos</option>
                <option value='08' selected >Sistema de Gestión</option>
                </select>
              <?php } else{ ?>
             <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)"  required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='01'>Adquisiciones</option>
               <option value='02'>Ejecución de obra</option>
               <option value='03'>Estudio de propuesta</option>
               <option value='04'>Finanzas</option>
               <option value='05'>Post-ventas</option>
               <option value='06'>Prevención de riesgos</option>
               <option value='07'>Recursos humanos</option>
               <option value='08'>Sistema de Gestión</option>
             </select>  
              <?php } ?>      
           </div>
          
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Numero de Documentación :</label>
              <input type='text' class='form-control' name = 'numerodoc' id = 'numerodoc'  placeholder='01' maxlength="2" onkeypress="return validarNumeroVersion(event)" onchange =" return hacerevento1(event) " value='<?php echo "$num_doc";?>'>
            </div> 

           <div class='form-group col-md-3 '>
             <label for='area'><i class='fa fa-list'></i> Detalle o Nombre del Documento: </label>
              <input type='text' class='form-control' name="nombre" id="nombre"  placeholder='' value='<?php echo "$detalle_doc"; ?>' >
            </div> 
            
            <div class="form-group col-md-12 well well-sm text-center"><strong>CONTROL DE VERSIONES.</strong></div> 

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Numero de Version :</label>
              <input type='text' class='form-control' name="n_version" id="n_version"  placeholder='01' maxlength="2" onkeypress="return validarNumeroVersion(event)" value= '<?php echo "$n_ver"; ?>'>
            </div> 

            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Estado: </label>
             <?php if ($estado_ver == 1){ ?>
               <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='000001' selected >Aprobado</option>
               <option value='000002'>En Elaboración</option>
               <option value='000003'>En Revisión</option>
               <option value='000004'>Obsoleto</option>
              </select> 
             <?php }elseif ($estado_ver == 2){ ?>
               <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='000001'>Aprobado</option>
               <option value='000002' selected >En Elaboración</option>
               <option value='000003'>En Revisión</option>
               <option value='000004'>Obsoleto</option>
              </select> 
              <?php }elseif ($estado_ver == 3){ ?>
               <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='000001'>Aprobado</option>
               <option value='000002'>En Elaboración</option>
               <option value='000003' selected >En Revisión</option>
               <option value='000004'>Obsoleto</option>
              </select> 
               <?php }elseif ($estado_ver == 4){ ?>
               <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='000001'>Aprobado</option>
               <option value='000002'>En Elaboración</option>
               <option value='000003'>En Revisión</option>
               <option value='000004' selected >Obsoleto</option>
              </select>  
             <?php }else{ ?>
               <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='' selected > Escoja Una Opción</option>
               <option value='000001'>Aprobado</option>
               <option value='000002'>En Elaboración</option>
               <option value='000003'>En Revisión</option>
               <option value='000004'>Obsoleto</option>
              </select> 
             <?php }?>
            </div> 

            <div class="form-group col-md-3">
              <label for='area'><i class='fa fa-calendar'></i> Fecha de Elaboracion / <br> Fecha de Modificación </label>
              <input type="date" class="form-control" name="fecha_elab" id="fecha_elab"  value="<?php echo"$fecha_elab1" ?>" required>
            </div>

            <div class='form-group col-md-3'>
            <label for='area'><i class='fa fa-list'></i> Ubicacion: </label>




              <?php if ($ubi_ver == 1){ ?>
              <select name='ubicacion' id='ubicacion' class='form-control' required>
               <option value='000001' selected >Intranet</option>
               <option value='000002'>Aplicación</option>
               <option value='000003'>En Carpetas</option>
              </select>
              <?php }elseif ($ubi_ver == 2){ ?>
               <select name='ubicacion' id='ubicacion' class='form-control' required>
               <option value='000001'>Intranet</option>
               <option value='000002' selected >Aplicación</option>
               <option value='000003'>En Carpetas</option>
              </select>
              <?php }elseif ($ubi_ver == 3){ ?>
              <select name='ubicacion' id='ubicacion' class='form-control' required>
               <option value='000001'>Intranet</option>
               <option value='000002' >Aplicación</option>
               <option value='000003' selected>En Carpetas</option>
              </select>
              <?php }else{ ?>
              <select name='ubicacion' id='ubicacion' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Intranet</option>
               <option value='000002'>Aplicación</option>
               <option value='000003'>En Carpetas</option>
              </select>
              <?php }?>
  
            </div> 

            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Observación: </label>
                    <textarea class='form-control' id='observacion' name='observacion' placeholder='Observación' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$obs_ver"; ?></textarea>
             </div> 
            

            <div class="form-group col-md-12 well well-sm text-center"><strong>CONTROL DE RESPONSABLES.</strong></div> 

             <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               


               <?php if ($respo_reg == 1){ ?>

               <select name='responsable' id='responsable' class='form-control' >
               <option value ='000001' selected >Gerente General</option>
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

               <?php }elseif ($respo_reg == 2){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002' selected >Subgerente</option>
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
               <?php }elseif ($respo_reg == 3){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003' selected >Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg == 4){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg == 5){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005' selected >Jefe de Seguridad</option>
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
               <?php }elseif ($respo_reg == 6){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006' selected >Encargado de Calidad</option>
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
               <?php }elseif ($respo_reg == 7){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007' selected >Coordinador de Calidad</option>
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
               <?php }elseif ($respo_reg == 8){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008' selected >Supervisor</option>
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
               <?php }elseif ($respo_reg == 9){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg == 10){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008'>Supervisor</option>
               <option value ='000009'>Adm. de Obra</option>
               <option value ='000010' selected >Jefe de Terreno</option>
               <option value ='000011'>Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 11){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000011' selected >Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 12){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000012' selected >Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 13){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000013' selected >Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 14){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000014' selected >Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 15){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000015' selected >Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 16){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000016' selected >Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg == 17){ ?>
               <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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
               <option value ='000017' selected >Otro</option>
               </select>
               <?php }else{ ?>
                <select name='responsable' id='responsable' class='form-control' onchange= "return Desactivar(event)" >
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

               <?php }?>
            </div>


            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               


               <?php if ($respo_reg1 == 1){ ?>

               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001' selected >Gerente General</option>
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

               <?php }elseif ($respo_reg1 == 2){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002' selected >Subgerente</option>
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
               <?php }elseif ($respo_reg1 == 3){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003' selected >Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg1 == 4){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg1 == 5){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005' selected >Jefe de Seguridad</option>
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
               <?php }elseif ($respo_reg1 == 6){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006' selected >Encargado de Calidad</option>
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
               <?php }elseif ($respo_reg1 == 7){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007' selected >Coordinador de Calidad</option>
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
               <?php }elseif ($respo_reg1 == 8){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008' selected >Supervisor</option>
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
               <?php }elseif ($respo_reg1 == 9){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg1 == 10){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008'>Supervisor</option>
               <option value ='000009'>Adm. de Obra</option>
               <option value ='000010' selected >Jefe de Terreno</option>
               <option value ='000011'>Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 11){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000011' selected >Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 12){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000012' selected >Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 13){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000013' selected >Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 14){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000014' selected >Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 15){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000015' selected >Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 16){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000016' selected >Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg1 == 17){ ?>
               <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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
               <option value ='000017' selected >Otro</option>
               </select>
               <?php }else{ ?>
                <select name='responsable1' id='responsable1' class='form-control' onchange= "return Desactivar2(event)">
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

               <?php }?>
            </div>


                         <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               


               <?php if ($respo_reg2 == 1){ ?>

              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)">
               <option value ='000001' selected >Gerente General</option>
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

               <?php }elseif ($respo_reg2 == 2){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002' selected >Subgerente</option>
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
               <?php }elseif ($respo_reg2 == 3){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003' selected >Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg2 == 4){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg2 == 5){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005' selected >Jefe de Seguridad</option>
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
               <?php }elseif ($respo_reg2 == 6){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006' selected >Encargado de Calidad</option>
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
               <?php }elseif ($respo_reg2 == 7){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007' selected >Coordinador de Calidad</option>
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
               <?php }elseif ($respo_reg2 == 8){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008' selected >Supervisor</option>
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
               <?php }elseif ($respo_reg2 == 9){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg2 == 10){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008'>Supervisor</option>
               <option value ='000009'>Adm. de Obra</option>
               <option value ='000010' selected >Jefe de Terreno</option>
               <option value ='000011'>Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 11){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000011' selected >Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 12){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000012' selected >Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 13){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000013' selected >Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 14){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000014' selected >Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 15){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000015' selected >Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 16){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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
               <option value ='000016' selected >Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg2 == 17){ ?>
              <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)">
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
               <option value ='000017' selected >Otro</option>
               </select>
               <?php }else{ ?>
               <select name='responsable2' id='responsable2' class='form-control' onchange= "return Desactivar3(event)" >
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

               <?php }?>
            </div>

            <div class='form-group col-md-4 col-md-offset-1'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               


               <?php if ($respo_reg3 == 1){ ?>

               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001' selected >Gerente General</option>
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

               <?php }elseif ($respo_reg3 == 2){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002' selected >Subgerente</option>
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
               <?php }elseif ($respo_reg3 == 3){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003' selected >Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg3 == 4){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004' selected>Jefe de Calidad</option>
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
               <?php }elseif ($respo_reg3 == 5){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005' selected >Jefe de Seguridad</option>
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
               <?php }elseif ($respo_reg3 == 6){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006' selected >Encargado de Calidad</option>
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
               <?php }elseif ($respo_reg3 == 7){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007' selected >Coordinador de Calidad</option>
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
               <?php }elseif ($respo_reg3 == 8){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008' selected >Supervisor</option>
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
               <?php }elseif ($respo_reg3 == 9){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg3 == 10){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008'>Supervisor</option>
               <option value ='000009'>Adm. de Obra</option>
               <option value ='000010' selected >Jefe de Terreno</option>
               <option value ='000011'>Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 11){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000011' selected >Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 12){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000012' selected >Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 13){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000013' selected >Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 14){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000014' selected >Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 15){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000015' selected >Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 16){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000016' selected >Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg3 == 17){ ?>
               <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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
               <option value ='000017' selected >Otro</option>
               </select>
               <?php }else{ ?>
                <select name='responsable3' id='responsable3' class='form-control' onchange= "return Desactivar4(event)">
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

               <?php }?>
            </div>

              <div class='form-group col-md-4 col-md-offset-1'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               


               <?php if ($respo_reg4 == 1){ ?>

               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001' selected >Gerente General</option>
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

               <?php }elseif ($respo_reg4 == 2){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002' selected >Subgerente</option>
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
               <?php }elseif ($respo_reg4 == 3){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003' selected >Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg4 == 4){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004' selected>Jefe de Calidad</option>
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
               <?php }elseif ($respo_reg4 == 5){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005' selected >Jefe de Seguridad</option>
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
               <?php }elseif ($respo_reg4 == 6){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006' selected >Encargado de Calidad</option>
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
               <?php }elseif ($respo_reg4 == 7){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007' selected >Coordinador de Calidad</option>
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
               <?php }elseif ($respo_reg4 == 8){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008' selected >Supervisor</option>
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
               <?php }elseif ($respo_reg4 == 9){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
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
               <?php }elseif ($respo_reg4 == 10){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
               <option value ='000001'>Gerente General</option>
               <option value ='000002'>Subgerente</option>
               <option value ='000003'>Gerente Tecnico</option>
               <option value ='000004'>Jefe de Calidad</option>
               <option value ='000005'>Jefe de Seguridad</option>
               <option value ='000006'>Encargado de Calidad</option>
               <option value ='000007'>Coordinador de Calidad</option>
               <option value ='000008'>Supervisor</option>
               <option value ='000009'>Adm. de Obra</option>
               <option value ='000010' selected >Jefe de Terreno</option>
               <option value ='000011'>Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 11){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000011' selected >Oficina Técnica</option>
               <option value ='000012'>Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 12){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000012' selected >Jefe de Obra</option>
               <option value ='000013'>Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 13){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000013' selected >Proveedor de Servicios</option>
               <option value ='000014'>Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 14){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000014' selected >Proveedor de Producto</option>
               <option value ='000015'>Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 15){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000015' selected >Mandante (ITO)</option>
               <option value ='000016'>Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 16){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000016' selected >Prevención de Riesgo</option>
               <option value ='000017'>Otro</option>
               </select>
               <?php }elseif ($respo_reg4 == 17){ ?>
               <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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
               <option value ='000017' selected >Otro</option>
               </select>
               <?php }else{ ?>
                <select name='responsable4' id='responsable4' class='form-control' onchange= "return Desactivar5(event)">
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

               <?php }?>
            </div>


             <div class='form-group col-md-3 '>
             <label for='area'><i class='fa fa-list'></i> Almacenamiento: </label>
             <input type='text' class='form-control' name="almacenamiento" id="almacenamiento"  maxlength="250" onkeypress="return validarLetrasSig(event)"  placeholder='ARCHIVADOR DE PREVENCIONISTA DE OBRA' value= '<?php echo "$alm_reg"; ?>' >
             </div> 
              
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Proteccion: </label>
              <input type='text' class='form-control' name="proteccion" id="proteccion" onkeypress="return validarLetrasSig(event)"  maxlength="250" placeholder='PROGRAMA DE PREVENCION DE RIESGOS' value= '<?php echo "$prot_reg"; ?>' >
              </div>  
              
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Recuperación: </label>
              <input type='text' class='form-control' name="recuperacion" id="recuperacion" onkeypress="return validarLetrasSig(event)"  maxlength="250" 
               placeholder='ARCHIVADOR MAQUINARIA (PREV)' value= '<?php echo "$recup_reg"; ?>' >
              </div>

              <div class='form-group col-md-3 '>
              <label for='retencion_Etiqueta'><i class='fa fa-list'></i> Tiempo de Retención: </label>
              <input type='text' class='form-control' name = 'retencion' id = 'retencion'  onkeypress="return validarLetraSig(event)"  maxlength="250" 
              placeholder='PERMANENTE' value= '<?php echo "$tiempo_reg"; ?>' >
              </div>
            
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Disposición: </label>
              <input type='text' class='form-control' name="disposicion" id="disposicion"  onkeypress="return validarLetrasSig(event)"  maxlength="250" 
              placeholder='OFICINA ENC. DE PREVENCION DE RIESGOS' value= '<?php echo "$dispo_reg"; ?>'>
              </div>
          
              


                  <div class="col-md-12">
                    <input type="hidden" name="id_doc" id="id_doc" value="<?php echo "$id" ?>">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Documentación" onclick =" return activar(event)">
                     <a type='button' class='btn btn-danger pull-left' href='lista_matriz_doc.php'>Cancelar Proceso</a>
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


   

      $(document).ready(function () {

        var res = document.getElementById("responsable").value;
        var res1 = document.getElementById("responsable1").value;
        var res2 = document.getElementById("responsable2").value;
        var res3 = document.getElementById("responsable3").value;
        var res4 = document.getElementById("responsable4").value;


        if ( res != 0)
        {
        
        document.getElementById("responsable1").disabled = false;
        
        };

        if ( res2 == 0)
        {
        
        document.getElementById("responsable2").disabled = true;
        
        };

        if ( res3 == 0)
        {
        
        document.getElementById("responsable3").disabled = true;
        
        };

        if ( res4 == 0)
        {
        
        document.getElementById("responsable4").disabled = true;
        
        };
         

      });

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



function hacerevento1(e)
{
 

var codigo_doc = Number(document.getElementById("mproceso").value);
var tipo = Number(document.getElementById("tip_doc").value);


if ( codigo_doc == 1)
{

var codigo1 = "AD-";

};

if ( codigo_doc == 2)
{

var codigo1 = "EO-";

};

if ( codigo_doc == 3)
{

var codigo1 = "EP-";
};

if ( codigo_doc == 4)
{

var codigo1 = "FS-";
};

if ( codigo_doc == 5)
{

var codigo1 = "PV-";
};

if ( codigo_doc == 6)
{

var codigo1 = "PR-";

};

if ( codigo_doc == 7)
{
var codigo1 = "RH-";
};

if ( codigo_doc == 8)
{
var codigo1 = "SG-";

};


if( codigo_doc == 0){
var codigo1 = "S/N";

};



if ( tipo == 1)
{

var codigo2 = "M-";

};

if ( tipo == 2)
{

var codigo2 = "P-";

};

if ( tipo == 3)
{

var codigo2 = "I-";
};

if ( tipo == 4)
{

var codigo2 = "R-";
};

if ( tipo == 5)
{

var codigo2 = "D-";
};

if( codigo_doc == 0  ){

var codigo1 = "S/D";

};
/*M : Manual
-  P : Procedimiento
-  I : Instructivo
-  R : Registro
-  D : Documento especial (política, organigrama, mapa de proceso, etc.)
*/

if ( codigo_doc != 0 && tipo != 0 ){
var codigo3 = document.getElementById("numerodoc").value;
var codigocompleto = codigo2+codigo1+codigo3;
document.getElementById("codigo_serie").disabled = false;
document.getElementById("codigo_serie").value = " ";
document.getElementById("codigo_serie").value = codigocompleto;
document.getElementById("codigo_serie").disabled = true;
};

}


function borrar3(e)
{
var codigocompleto = "N/Def.";
var codigo_1 = document.getElementById("codigo_serie").value;
var codigo_2 = document.getElementById("mproceso").value;
if (codigo_1 != 0 || codigo_2 != 0) {
document.getElementById("codigo_serie").value = "";  
document.getElementById("codigo_serie").placeholder = codigocompleto;
document.getElementById("mproceso").value = "" ;
document.getElementById("numerodoc").value = "";
document.getElementById("numerodoc").disabled = true;

};
document.getElementById("codigo_serie").placeholder = codigocompleto;
document.getElementById("mproceso").disabled = false;
}

function borrar4(e)
{
var codigocompleto = "N/Def."
document.getElementById("codigo_serie").placeholder = codigocompleto;
document.getElementById("numerodoc").disabled = false;
var numdoc = document.getElementById("codigo_serie").value;
if( numdoc != 0){
return hacerevento1();
};
}

function activar(e) {
 
document.getElementById("codigo_serie").disabled = false;
document.getElementById("responsable1").disabled = false;
document.getElementById("responsable2").disabled = false;
document.getElementById("responsable3").disabled = false;
document.getElementById("responsable4").disabled = false;

}


 function Desactivar(e) {
 
document.getElementById("responsable1").disabled = false;


}

function Desactivar2(e) {
 
var res = document.getElementById('responsable').value;
var res1 = document.getElementById('responsable1').value;
var res2 = document.getElementById("responsable2").value;
var res3 = document.getElementById("responsable3").value;
var res4 = document.getElementById("responsable4").value;


if (res == res1 || res2 == res1 || res3 == res1 || res4 == res1 ) {
swal("Hay una Coincidencia","","error");
document.getElementById('responsable1').value = 0;

};

if (res != res1 && res2 != res1 && res3 != res1 && res4 != res1 ) {
document.getElementById('responsable2').disabled = false ;
};


}

function Desactivar3(e) {
 
var res = document.getElementById('responsable').value;
var res1 = document.getElementById('responsable1').value;
var res2 = document.getElementById("responsable2").value;
var res3 = document.getElementById("responsable3").value;
var res4 = document.getElementById("responsable4").value;


if (res == res2 || res1 == res2 || res3 == res2 || res4 == res2  ) {
swal("Hay una Coincidencia","","error");
document.getElementById('responsable2').value = 0;

};


if (res != res2 && res1 != res2 && res3 != res2 && res4 != res2) {
document.getElementById('responsable3').disabled = false;
};


}

function Desactivar4(e) {
 
var res = document.getElementById('responsable').value;
var res1 = document.getElementById('responsable1').value;
var res2 = document.getElementById("responsable2").value;
var res3 = document.getElementById("responsable3").value;
var res4 = document.getElementById("responsable4").value;


if (res == res3 || res1 == res3 || res2 == res3 || res4 == res3  ) {
swal("Hay una Coincidencia","","error");
document.getElementById('responsable3').value = 0;


};


if (res != res2 || res1 != res2 || res3 != res2 || res4 != res2) {
document.getElementById('responsable4').disabled = false;
};


}

function Desactivar5(e) {
 
var res = document.getElementById('responsable').value;
var res1 = document.getElementById('responsable1').value;
var res2 = document.getElementById("responsable2").value;
var res3 = document.getElementById("responsable3").value;
var res4 = document.getElementById("responsable4").value;


if (res == res4 || res1 == res4 || res2 == res4 || res3 == res4  ) {
swal("Hay una Coincidencia","","error");
document.getElementById('responsable4').value = 0;


};


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

  function validarLetraSig(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'.\-,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para Este Campo son validos: letras, números y los caracteres especiales: ,.-()/");
    };
    return patron.test(te); 

  }


  function validarNumero(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Solo Puede Ingresar Numeros");
    };
    return patron.test(te); 

  }

   function validarNumeroVersion(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9\.]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Solo Puede Ingresar Numeros y como Caracter Especial: .");
    };
    return patron.test(te); 

  }

  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");

</script>
</body>
</html>