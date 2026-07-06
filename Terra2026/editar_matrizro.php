<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/matrizro.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');



$caso = $_GET['caso'];

$con = new matrizro();

  $sql = "SELECT  matriz_r_o.caso , matriz_r_o.proceso  ,matriz_r_o.contexto, matriz_r_o.part_int, matriz_r_o.descrip_1, matriz_r_o.dec_o_r, matriz_r_o.con_pre, matriz_r_o.probabilidad, matriz_r_o.severidad,  matriz_r_o.magnitud, matriz_r_o.clasificacion, matriz_r_o.dec_acc, matriz_r_o.desc_acc, matriz_r_o.frecuencia, matriz_r_o.plazo, matriz_r_o.fecha, matriz_r_o.responsable, matriz_r_o.eficacia, matriz_r_o.objetivo, matriz_r_o.estado  FROM  matriz_r_o WHERE matriz_r_o.caso = '$caso';";
$consulta = $con->conn->query($sql);


  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

     /* if($fila['estado'] == 1) {
        $estado = "Activo";
      }else {
        $estado = "Inactivo";
      }*/
  
  $caso = $fila['caso'];
  $proceso = $fila['proceso'];
  $contexto = $fila['contexto'];
  $part_int = $fila['part_int'];
  $descrip_1 = $fila['descrip_1'];
  $dec_1 = $fila['dec_o_r'];
  $con_pre = $fila['con_pre'];
  $probabilidad = $fila['probabilidad'];
  $severidad = $fila['severidad'];
  $smagnitud = $fila['magnitud'];
  $clasificacion = $fila['clasificacion'];
  $dec_acc = $fila['dec_acc'];
  $desc_acc = $fila['desc_acc'];
  $frecuencia = $fila['frecuencia'];
  $funcion_1= $fila['responsable'];
  $plazo = $fila['plazo'];
  $eficacia = $fila['plazo'];
  $eficacia = $fila['eficacia'];
  $objetivo = $fila['objetivo'];
  $estado = $fila['estado'];
  $fecha = $fila['fecha'];

 



    }

  }




?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Matriz de Riesgos y Oportunidades</title>
  <?php echo head(); ?>
  <script>
function miFuncion(){
   var numero1 = Number(document.getElementById("probabilidad").value);
var numero2 = Number(document.getElementById("severidad").value);
var resultado = numero1 * numero2;
document.getElementById("magnitud").value = resultado;

if ( resultado == 1 || resultado == 2)
{
document.getElementById("clasificacion").value = "RIESGO BAJO";
document.getElementById("clasificacion").style.background = "#9CFFA1"
}if (resultado == 3 || resultado == 4 )
{
document.getElementById("clasificacion").value = "RIESGO MEDIO";
document.getElementById("clasificacion").style.background = "#FFF79F"
}if (resultado == 6 || resultado == 9 )
{
document.getElementById("clasificacion").value = "RIESGO ALTO";
document.getElementById("clasificacion").style.background = "#FFA4A4"
};

document.getElementById("optradio").value = document.getElementById("optradiov").value; 

}

</script>
</head>
<body class="hold-transition skin-red sidebar-mini" onload="miFuncion();" onload="radio();">
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
            <h1>M. de Riesgo y Oportunidades
              <small>Pagina para Ingreso de una Ma. de Riesgos y Oportunidades. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Ma. Riesgos y Oportunidades</li>
            </ol>
        </section>
      
      <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Coordinador de Calidad") { ?>
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Edic. de Matriz de Riesos y Oportunidades <strong>N.<?php echo "$caso";?></strong></b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='POST' id='editar_matriz_ro' >
                    <!--id='editar_matriz_ro'-->
                   <!--action="modulos/edit_matriz_ro.php"-->

           

          <?php  if ($proceso == 1 ) { ?>
                     
          
          <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
             <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001' selected >Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentad</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Información Documentada</option>
               <option value='000013'>Diseño y Desarrollo (Inmobiliaria)</option>
             </select>        
          </div>
              
          <?php }elseif ($proceso == 2) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002' selected >Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentad</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

           <?php }elseif ($proceso == 3) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003' selected >Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }elseif ($proceso == 4) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001' >Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004' selected >Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

           <?php }elseif ($proceso == 5) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005' selected >Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }elseif ($proceso == 6) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006' selected >Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
                <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }elseif ($proceso == 7) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001' >Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007' selected >Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
                <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }elseif ($proceso == 8) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001' >Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008' selected >Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }elseif ($proceso == 9) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009' selected >Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

           <?php }elseif ($proceso == 10) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010' selected >No Conformidad Y Acc. Correctiva</option>
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>
              
            <?php }elseif ($proceso == 11) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011' selected> Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>  

            <?php }elseif ($proceso == 12) {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'> Ejecución de Obra</option>
               <option value='000012' selected>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>


            <?php }else {?>
               
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Proceso : </label>
               <select name='proceso' id='proceso' class='form-control' required>
               <option value='' selected>Escoger Opción</option>
               <option value='000001'>Sistema De Gestión</option>
               <option value='000002'>Prevención de Riesgo</option>
               <option value='000003'>Recursos Humanos</option>
               <option value='000004'>Contabilidad</option>
               <option value='000005'>Adquisiciones</option>
               <option value='000006'>Comunicaciones</option>
               <option value='000007'>Revisión Por La Dirección</option>
               <option value='000008'>Información Documentada</option>
               <option value='000009'>Auditoria</option>
               <option value='000010'>No Conformidad Y Acc. Correctiva</option>
               <option value='000011'> Ejecución de Obra</option>
               <option value='000012'>Diseño y Desarrollo (Inmobiliaria)</option>
               </select>        
               </div>

            <?php }?>
          

            <?php if ($contexto == 1) {?>
                <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Contexto : </label>
             <select name='contexto' name="contexto" id='contexto' class='form-control' required>
               <option value='000001' selected >Cuestión Interna</option>
               <option value='000002' >Cuestión Externa</option>
             </select>
            </div>
            <?php }elseif ($contexto == 2) {?>
                <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Contexto : </label>
             <select name='contexto' name="contexto" id='contexto' class='form-control' required>
               <option value='000001'>Cuestión Interna</option>
               <option value='000002' selected >Cuestión Externa</option>
             </select>
            </div>
            <?php }else {?>
                <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Contexto : </label>
             <select name='contexto' name="contexto" id='contexto' class='form-control' required>
               <option value='' selected >Seleccionar Una Opción</option>
               <option value='000001'>Cuestión Interna</option>
               <option value='000002'>Cuestión Externa</option>
             </select>
            </div>
            <?php }?>


            
            
            <!--
                Sistema De Gestión = 000001
                Prevención De Riesgos = 000002  
            -->


                <?php  if ($part_int == 1 ) { ?>
                 <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001' selected>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>
                <?php }elseif ($part_int == 2) {?>
                 <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002' selected >Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>
                <?php }elseif ($part_int == 3) {?>
                 <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003' selected >Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>
                <?php }elseif ($part_int == 4) {?>
                  <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004' selected >Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>              
                <?php }elseif ($part_int == 5) {?>
                  <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005' selected >Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>             
                <?php }elseif ($part_int == 6) {?>
                <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006' selected >Competidores</option>
                 <option value='000007'>Sociedad</option>
                 </select>        
                 </div>
                <?php }elseif ($part_int == 7) {?>
                 <div class ='form-group col-md-3'>
                 <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                 <select name='part_int' id='part_int' class='form-control' required>
                 <option value='000001'>Cliente (Inmobiliaria)</option>
                 <option value='000002'>Cliente Final</option>
                 <option value='000003'>Proveedor De Productos</option>
                 <option value='000004'>Proveedor De Servicio</option>
                 <option value='000005'>Colaboradores</option>
                 <option value='000006'>Competidores</option>
                 <option value='000007' selected >Sociedad</option>
                 </select>        
                 </div>
                <?php }else {?>
                    
                    <div class ='form-group col-md-3'>
                    <label for='area'><i class='fa fa-sitemap'></i> Parte Interesada : </label>
                    <select name='part_int' id='part_int' class='form-control' required>
                    <option value='' selected>Seleccionar Una Opción</option>
                    <option value='000001'>Cliente (Inmobiliaria)</option>
                    <option value='000002'>Cliente Final</option>
                    <option value='000003'>Proveedor De Productos</option>
                    <option value='000004'>Proveedor De Servicio</option>
                    <option value='000005'>Colaboradores</option>
                    <option value='000006'>Competidores</option>
                    <option value='000007'>Sociedad</option>
                    </select>        
                    </div>
                            
                <?php }?>




              <?php if ($dec_1 == 1) {?>
              <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Riesgo/Oportunidad : </label>
               <select name='rie_opo' id='rie_opo' class='form-control' required>
               <option value='000001' selected >Riesgo</option>
               <option value='000002'>Oportunidad</option>
               </select>
               </div>
              <?php }elseif ($dec_1 == 2) {?>
               <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Riesgo/Oportunidad : </label>
               <select name='rie_opo' id='rie_opo' class='form-control' required>
               <option value='000001'>Riesgo</option>
               <option value='000002' selected >Oportunidad</option>
               </select>
               </div>
              <?php }else {?>
                <div class='form-group col-md-3'>
               <label for='area'><i class='fa fa-circle-o-notch'></i> Riesgo/Oportunidad : </label>
               <select name='rie_opo' id='rie_opo' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Riesgo</option>
               <option value='000002'>Oportunidad</option>
               </select>
               </div>
              <?php }?>



               
              

              
             <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Descripción de Suceso: </label>
                    <textarea class='form-control' id='suceso' name='suceso' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$descrip_1"; ?></textarea>
             </div>

             <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Consecuencias Prevista: </label>
                    <textarea class='form-control' id='consecuencia' name='consecuencia' placeholder='Consecuencias' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$con_pre"; ?></textarea>
             </div>
            
             <div class="form-group col-md-12 well well-sm text-center"><strong>EVALUACIÓN.</strong></div>
            
            <?php if ($probabilidad == 1) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Probabilidad : </label>
             <select name='probabilidad' id='probabilidad' class='form-control' onchange="return hacerevento2(event)" required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001' selected >1</option>
               <option value='000002' >2</option>
               <option value='000003' >3</option>
              </select>
            </div>
            <?php }elseif ($probabilidad == 2) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Probabilidad : </label>
             <select name='probabilidad' id='probabilidad' class='form-control' onchange="return hacerevento2(event)" required>
               <option value='000001'>1</option>
               <option value='000002' selected >2</option>
               <option value='000003'>3</option>
              </select>
            </div>
            <?php }elseif ($probabilidad == 3) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Probabilidad : </label>
             <select name='probabilidad' id='probabilidad' class='form-control' onchange="return hacerevento2(event)" required>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003' selected >3</option>
              </select>
            </div>
            <?php }else {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Probabilidad : </label>
             <select name='probabilidad' id='probabilidad' class='form-control' onchange="return hacerevento2(event)" required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003'>3</option>
              </select>
            </div>
            <?php }?>

            <?php if ($severidad == 1) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Severidad : </label>
             <select name='severidad' id='severidad' class='form-control' onchange="return hacerevento(event)" required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001' selected >1</option>
               <option value='000002' >2</option>
               <option value='000003' >3</option>
              </select>
            </div>
            <?php }elseif ($severidad == 2) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Severidad : </label>
             <select name='severidad' id='severidad' class='form-control' onchange="return hacerevento(event)" required>
               <option value='000001'>1</option>
               <option value='000002' selected >2</option>
               <option value='000003'>3</option>
              </select>
            </div>
            <?php }elseif ($severidad == 3) {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Severidad : </label>
             <select name='severidad' id='severidad' class='form-control' onchange="return hacerevento(event)" required>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003' selected >3</option>
              </select>
            </div>
            <?php }else {?>
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Severidad : </label>
             <select name='severidad' id='severidad' class='form-control' onchange="return hacerevento(event)" required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003'>3</option>
              </select>
            </div>
            <?php }?>
      
            


            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Magnitud : </label>
              <input type='text' class='form-control' name="magnitud" id="magnitud"  placeholder='' >

            </div>
              <!--style="background-color: #F4C0C0;"-->
            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Clasificación: </label>
              <input type='text' class='form-control' name="clasificacion" id="clasificacion" >
            </div>

                <div class="form-group col-md-12 well well-sm text-center"><strong>Accion.</strong></div> 
                   
                
                   
                        <div class="form-group col-md-12">
                        <input type="hidden" name="optradiov" id="optradiov" value="<?php echo "$dec_acc"; ?>">
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio1" value="1" onclick = "return radio(event)" <?php if($dec_acc == 1){ echo"checked"; };  ?>><strong>Eliminar</strong>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio2" value="2" onclick = "return radio(event)"<?php if($dec_acc == 2){ echo"checked"; };  ?> ><strong>Evitar</strong>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio3" value="3" onclick = "return radio(event)" <?php if($dec_acc == 3){ echo"checked"; };  ?> ><strong>Cambiar Probabilidad/Consecuencia</strong>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio4" value="4" onclick = "return radio(event)" <?php if($dec_acc == 4){ echo"checked"; };  ?> ><strong>Compartir</strong>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio5" value="5" onclick = "return radio(event)" <?php if($dec_acc == 5){ echo"checked"; };  ?> ><strong>Mantener</strong>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="opcion" id="myRadio6" value="6" onclick = "return radio(event)"  <?php if($dec_acc == 6){ echo"checked"; };  ?> ><strong>Asumir</strong>
                        </label>
                        <input type="hidden" name="optradio" id="optradio" >
                        
                        </div>


                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Descripcion de Medidas: </label>
                    <textarea class='form-control' id='descripcion_2' name='descripcion_2' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$desc_acc";?></textarea>
                </div>

                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Frecuencia: </label>
                    <textarea class='form-control' id='frecuencia' name='frecuencia' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$frecuencia";?></textarea>
                </div>
            
               <?php if ($funcion_1 == "000001") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
               <?php }elseif ($funcion_1 == "000002") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                  <?php }elseif ($funcion_1 == "000003") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000004") { ?>
                              <div class='form-group col-md-3'>   
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000005") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>   
                   <?php }elseif ($funcion_1 == "000006") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000007") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000008") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000009") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                   <?php }elseif ($funcion_1 == "000010") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div>
                      <?php }elseif ($funcion_1 == "000011") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
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
                              </select>
                              </div> 

                <?php }else{ ?>
                              <div class='form-group col-md-3'>
                                <label for='area'><i class='fa fa-sitemap'></i> Responsable : </label>
                              <select name='funcion_1' id='funcion_1' class='form-control' required>
                              <option value ='' selected>LLAMAR ENCARGADO PIVOTDATA </option>
                              
                              </select>
                              </div>
                 <?php }?>
  
              
            
               <div class='form-group col-md-12'>
                <hr>
                </div>

                     <div class='form-group col-md-3'>
                    <label for='area'><i class='fa fa-list'></i> Plazo : </label>
                    <input type='text' class='form-control' name="plazo" id="plazo"  placeholder='' value='<?php echo "$plazo"; ?>' >
                    
                    </div>


                    <?php if ($eficacia == "1") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-list'></i> Eficacia de las Medidas: </label>
                              <select name='eficacia' id='eficacia' class='form-control' required>
                              <option value ='000001' selected >1</option>
                              <option value ='000002'>2</option>
                              <option value ='000003'>3</option>
                              </select>
                              </div>
                      <?php }elseif ($eficacia == "2") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-list'></i> Eficacia de las Medidas: </label>
                              <select name='eficacia' id='eficacia' class='form-control' required>
                              <option value ='000001'>1</option>
                              <option value ='000002' selected >2</option>
                              <option value ='000003'>3</option>
                              </select>
                              </div>

                       <?php }elseif ($eficacia == "3") { ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-list'></i> Eficacia de las Medidas: </label>
                              <select name='eficacia' id='eficacia' class='form-control' required>
                              <option value ='000001'>1</option>
                              <option value ='000002'>2</option>
                              <option value ='000003' selected >3</option>
                              </select>
                              </div>
                <?php }else{ ?>
                              <div class='form-group col-md-3'>
                              <label for='area'><i class='fa fa-list'></i> Eficacia de las Medidas: </label>
                              <select name='eficacia' id='eficacia' class='form-control' required>
                              <option value ='' selected>Seleccionar Una Opción</option>
                              <option value ='000001'>1</option>
                              <option value ='000002'>2</option>
                              <option value ='000003'>3</option>
                              </select>
                              </div>
                 <?php }?>

                   <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i>Evidencia Objetiva: </label>
                    <textarea class='form-control' id='evidencia1' name='evidencia1' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"><?php echo "$objetivo";?></textarea>
                    </div>


  
                <?php if ($estado == "0") { ?>
                              <div class='form-group col-md-3 col-md-offset-9'>
                              <label for='area'><i class='fa fa-sitemap'></i> Estado: </label>
                              <select name='estado' id='estado' class='form-control' required>
                              <option value ='000000' selected >Pendiente</option>
                              <option value ='000001'> Finalizado</option>
                              </select>
                              </div>
                      <?php }elseif ($estado == "1") { ?>
                              <div class='form-group col-md-3 col-md-offset-9'>
                              <label for='area'><i class='fa fa-sitemap'></i> Estado: </label>
                              <select name='estado' id='estado' class='form-control' required>
                              <option value ='000000'>Pendiente</option>
                              <option value ='000001' selected >Finalizado</option>
                              </select>
                              </div> 

                <?php }else{ ?>
                              <div class='form-group col-md-3 col-md-offset-9'>
                                <label for='area'><i class='fa fa-sitemap'></i> Estado: </label>
                              <select name='estado' id='estado' class='form-control' required>
                              <option value ='' selected>Escoger Opcion</option>
                              <option value ='000000'>Pendiente</option>
                              <option value ='000001'>Finalizado</option>
                              </select>
                              </div>
                 <?php }?>



                <div class='form-group col-md-12'>
                 <input type="hidden" name="fecha" id="fecha" value="<?php echo "$fecha"; ?>">
                 <input type="hidden" name="caso" id="caso" value="<?php echo "$caso"; ?>">
                </div>
                    


                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Editar Salida" onclick="myFunction()">
                     <a type='button' class='btn btn-danger pull-left' href='lista_matriz_ro.php'>Cancelar Proceso</a>
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

   function myFunction() {
    document.getElementById("optradio").required = false;
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

  function hacerevento2(e)
{
document.getElementById("magnitud").value = "-";
document.getElementById("severidad").value = "-";
document.getElementById("clasificacion").value = "";
document.getElementById("clasificacion").style.background = "#FFFFFF"
}


function hacerevento(e)
{
 
var numero1 = Number(document.getElementById("probabilidad").value);
var numero2 = Number(document.getElementById("severidad").value);
var resultado = numero1 * numero2;
document.getElementById("magnitud").value = resultado;

if ( resultado == 1 || resultado == 2)
{
document.getElementById("clasificacion").value = "RIESGO BAJO";
document.getElementById("clasificacion").style.background = "#9CFFA1"
}if (resultado == 3 || resultado == 4 )
{
document.getElementById("clasificacion").value = "RIESGO MEDIO";
document.getElementById("clasificacion").style.background = "#FFF79F"
}if (resultado == 6 || resultado == 9 )
{
document.getElementById("clasificacion").value = "RIESGO ALTO";
document.getElementById("clasificacion").style.background = "#FFA4A4"
};

}

function radio(e) {
 document.getElementById("optradio").value = "";
 
if(document.getElementById("myRadio1").checked){
    var x = document.getElementById("myRadio1").value;
        document.getElementById("optradio").value = x;
}if(document.getElementById("myRadio2").checked){
    var x = document.getElementById("myRadio2").value;
    document.getElementById("optradio").value = x;
}if(document.getElementById("myRadio3").checked){
    var x = document.getElementById("myRadio3").value;
    document.getElementById("optradio").value = x;
}if(document.getElementById("myRadio4").checked){
    var x = document.getElementById("myRadio4").value;
    document.getElementById("optradio").value = x;
}if(document.getElementById("myRadio5").checked){
    var x = document.getElementById("myRadio5").value;
    document.getElementById("optradio").value = x;
}if(document.getElementById("myRadio6").checked){
    var x = document.getElementById("myRadio6").value;
    document.getElementById("optradio").value = x;
}


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