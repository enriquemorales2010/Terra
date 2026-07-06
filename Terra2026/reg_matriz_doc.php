<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/matrizdoc.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$con = new matrizdoc();

  $sql = "SELECT MAX(id_matriz_doc) AS id FROM matriz_doc";
  $consulta = $con->conn->query($sql);


  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {
      $id = $fila['id'];
      $id = $id + 1;
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
              <h3 class="box-title"><b>Registro de Documentación</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='POST' id='registro_matriz_doc'>
                    <!--id='registro_matriz_doc'-->
                   <!--action="modulos/reg_mat_doc.php"-->

          <div class="form-group col-md-12 well well-sm text-center"><strong> CLASIFICACIÓN DE DOCUMENTO.</strong></div>
          <div class='form-group col-md-3 col-md-offset-1'>
             <label for='area'><i class='fa fa-list'></i> Codigo: </label>
              <input type='text' class='form-control' name='codigo_serie' id='codigo_serie'  placeholder='' disabled>
              <input type="hidden" name="id_calculado" id="id_calculado" value="<?php echo "$id" ?>">
            </div>   


            <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Origen : </label>
             <select name='origen' id='origen' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Interno</option>
               <option value='000002'>Externo</option>
             </select>
            </div>



             <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Tipo de Documento : </label>
             <select name='tip_doc' id='tip_doc' class='form-control' onchange="return borrar3(event)" required>
               <option value='' selected   >Seleccionar Una Opción</option>
               <option value='000001'>Manual</option>
               <option value='000002'>Procedimiento</option>
               <option value='000003'>Instructivo</option>
               <option value='000004'>Registro</option>
               <option value='000005'>Documento Especial</option>
             </select>
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
             <select name='mproceso' id='mproceso' class='form-control' onchange="return borrar4(event)" disabled required>
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
           </div>
          
              <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Numero de Documentación :</label>
              <input type='text' class='form-control' name = 'numerodoc' id = 'numerodoc' disabled placeholder='01' maxlength="5" onkeypress="return validarNumeroVersion(event)" onchange =" return hacerevento1(event) ">
            </div> 

           <div class='form-group col-md-3 '>
             <label for='area'><i class='fa fa-list'></i> Detalle o Nombre del Documento: </label>
              <input type='text' class='form-control' name="nombre" id="nombre"  placeholder='' >
            </div> 
            
            <div class="form-group col-md-12 well well-sm text-center"><strong>CONTROL DE VERSIONES.</strong></div> 

           <div class='form-group col-md-2'>
             <label for='area'><i class='fa fa-list'></i> Numero de Version :</label>
              <input type='text' class='form-control' name="n_version" id="n_version"  placeholder='01' maxlength="5" onkeypress="return validarNumeroVersion(event)">
            </div> 

            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Estado: </label>
             <select name='estado_ver' id='estado_ver' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Aprobado</option>
               <option value='000002'>En Elaboración</option>
               <option value='000003'>En Revisión</option>
               <option value='000004'>Obsoleto</option>
              </select>
            </div> 

            <div class="form-group col-md-3">
              <label for='area'><i class='fa fa-calendar'></i> Fecha de Elaboracion / <br> Fecha de Modificación : </label>
              <input type="date" class="form-control" name="fecha_elab" id="fecha_elab" required>
            </div>

            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Ubicacion: </label>
             <select name='ubicacion' id='ubicacion' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Intranet</option>
               <option value='000002'>Aplicación</option>
               <option value='000003'>En Carpetas</option>
              </select>
            </div> 

            <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Observación: </label>
                    <textarea class='form-control' id='observacion' name='observacion' placeholder='Observación' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
             </div> 
            

            <div class="form-group col-md-12 well well-sm text-center"><strong>CONTROL DE RESPONSABLES.</strong></div> 

             <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='responsable' id='responsable' class='form-control' onchange = "return Desactivar(event)" >
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

            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='responsable1' id='responsable1' class='form-control' disabled onchange = "return Desactivar2(event)">
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


            <div class='form-group col-md-4'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='responsable2' id='responsable2' class='form-control' disabled onchange = "return Desactivar3(event)" >
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


            <div class='form-group col-md-4 col-md-offset-1'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='responsable3' id='responsable3' class='form-control' disabled onchange = "return Desactivar4(event)" >
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

            <div class='form-group col-md-4 col-md-offset-1'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='responsable4' id='responsable4' class='form-control' disabled onchange = "return Desactivar5(event)" >
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


             <div class='form-group col-md-3 '>
             <label for='area'><i class='fa fa-list'></i> Almacenamiento: </label>
             <input type='text' class='form-control' name="almacenamiento" id="almacenamiento"  maxlength="250" onkeypress="return validarLetraSig(event)"  placeholder='ARCHIVADOR DE PREVENCIONISTA DE OBRA' >
             </div> 
              
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Proteccion: </label>
              <input type='text' class='form-control' name="proteccion" id="proteccion" onkeypress="return validarLetraSig(event)"  maxlength="250" placeholder='PROGRAMA DE PREVENCION DE RIESGOS' >
              </div>  
              
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Recuperación: </label>
              <input type='text' class='form-control' name="recuperacion" id="recuperacion" onkeypress="return validarLetraSig(event)"  maxlength="250" 
               placeholder='ARCHIVADOR MAQUINARIA (PREV)' >
              </div>

              <div class='form-group col-md-3 '>
              <label for='retencion_Etiqueta'><i class='fa fa-list'></i> Tiempo de Retención: </label>
              <input type='text' class='form-control' name = 'retencion' id = 'retencion'  onkeypress="return validarLetraSig(event)"  maxlength="250" 
              placeholder='PERMANENTE'>
              </div>
            
              <div class='form-group col-md-3 '>
              <label for='area'><i class='fa fa-list'></i> Disposición: </label>
              <input type='text' class='form-control' name="disposicion" id="disposicion"  onkeypress="return validarLetraSig(event)"  maxlength="250" 
              placeholder='OFICINA ENC. DE PREVENCION DE RIESGOS'>
              </div>
          


                  <div class="col-md-12">
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