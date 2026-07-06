<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/matrizro.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Matriz de Riesgos y Oportunidades</title>
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
              <h3 class="box-title"><b>Registro de Matriz de Riesos y Oportunidades</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='POST' id='registrar_matriz_ro' >
                    <!--id='registrar_matriz_ro'-->
                   <!--action="modulos/reg_matriz_ro.php"-->

           



          <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-sitemap'></i> Proceso : </label>
             <select name='proceso' id='proceso' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
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
               <option value='000011'>Ejecución de Obra</option>
               <option value='000012'>Información Documentada</option>
             </select>        
          </div>
              
            
               <!--
                Sistema De Gestión = 000001
                Prevención De Riesgos = 000002
                Recursos Humanos = 000003
                Contabilidad = 000004
                Adquisiciones= 000005
                Comunicaciones = 000006
                Revisión Por La Dirección = 000007
                Información Documentada = 000008
                Auditoria = 000009
                No Conformidad Y Acc. Correctiva = 000010
                Ejecución de Obra = 000011
                Información Documentada = 000012
                Diseño y Desarrollo (Inmobiliaria) = 000013
             -->

            
            <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Contexto : </label>
             <select name='contexto' name="contexto" id='contexto' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Cuestión Interna</option>
               <option value='000002'>Cuestión Externa</option>
             </select>
            </div>
            
            <!--
                Sistema De Gestión = 000001
                Prevención De Riesgos = 000002  
            -->


              <div class='form-group col-md-3'>
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
                
                <!--
                Cliente (Inmobiliaria)
                Cliente Final
                Proveedor De Productos
                Proveedor De Servicio
                Colaboradores
                Competidores
                Sociedad
                -->

             <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Riesgo/Oportunidad : </label>
             <select name='rie_opo' id='rie_opo' class='form-control' required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>Riesgo</option>
               <option value='000002'>Oportunidad</option>
             </select>
            </div>

              
             <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Descripción de Suceso: </label>
                    <textarea class='form-control' id='suceso' name='suceso' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
             </div>

             <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Consecuencias Prevista: </label>
                    <textarea class='form-control' id='consecuencia' name='consecuencia' placeholder='Consecuencias' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
             </div>
            
             <div class="form-group col-md-12 well well-sm text-center"><strong>EVALUACIÓN.</strong></div>

           
            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Probabilidad : </label>
             <select name='probabilidad' id='probabilidad' class='form-control' onchange="return hacerevento2(event)"  required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003'>3</option>
              </select>
            </div>



            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Severidad : </label>
             <select name='severidad' id='severidad' class='form-control' onchange="return hacerevento(event)" required>
               <option value='' selected>Seleccionar Una Opción</option>
               <option value='000001'>1</option>
               <option value='000002'>2</option>
               <option value='000003'>3</option>
              </select>
            </div>


            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Magnitud : </label>
              <input type='text' class='form-control' name="magnitud" id="magnitud"  placeholder='' >
              <input type="hidden" >
            </div>
              <!--style="background-color: #F4C0C0;"-->
            <div class='form-group col-md-3'>
             <label for='area'><i class='fa fa-list'></i> Clasificación: </label>
              <input type='text' class='form-control' name="clasificacion" id="clasificacion" placehoclasificacion  >
              <input type="hidden" >
            </div>

                <div class="form-group col-md-12 well well-sm text-center"><strong>Accion.</strong></div> 
                   
                      <div class="form-group col-md-12">
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio1" value="1" onclick = "return radio(event)" ><strong>Eliminar</strong>
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio2" value="2" onclick = "return radio(event)" ><strong>Evitar</strong>
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio3" value="3" onclick = "return radio(event)" ><strong>Cambiar Probabilidad/Consecuencia</strong>
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio4" value="4" onclick = "return radio(event)" ><strong>Compartir</strong>
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio5" value="5" onclick = "return radio(event)" ><strong>Mantener</strong>
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="opcion" id="myRadio6" value="6" onclick = "return radio(event)" ><strong>Asumir</strong>
                      </label>
                       <input type="hidden" name="optradio" id="optradio" >

                </div>


                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Descripcion de Medidas: </label>
                    <textarea class='form-control' id='descripcion_2' name='descripcion_2' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
                </div>

                <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i> Frecuencia: </label>
                    <textarea class='form-control' id='frecuencia' name='frecuencia' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
                </div>
            
                <div class='form-group col-md-3'>
              <label for='area'><i class='fa fa-circle-o-notch'></i> Responsable: </label>
               <select name='funcion_1' id='funcion_1' class='form-control' required>
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
              </select>
            </div>
            
               <div class='form-group col-md-12'>
                <hr>
                </div>

                     <div class='form-group col-md-3'>
                     <label for='area'><i class='fa fa-list'></i> Plazo : </label>
                     <input type='text' class='form-control' name="plazo" id="plazo"  placeholder='' >
                     </div>

                     <div class='form-group col-md-3'>
                      <label for='area'><i class='fa fa-list'></i> Eficacia de las Medidas: </label>
                     <select name='eficacia' id='eficacia' class='form-control' required>
                        <option value ='' selected>Seleccionar Una Opción</option>
                        <option value ='000001'>1</option>
                        <option value ='000002'>2</option>
                        <option value ='000003'>3</option>
                      </select>
                     </div>


                   <div class='form-group col-md-12'>
                    <label for='dir_usuario'><i class='fa fa-circle-o-notch'></i>Evidencia Objetiva: </label>
                    <textarea class='form-control' id='evidencia1' name='evidencia1' placeholder='Descripción' onkeypress="return validarDir(event)" required maxlength="2500"></textarea>
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

  function myFunction() {
    document.getElementById("optradio").required = true;
}

function hacerevento2(e)
{
document.getElementById("magnitud").value = "-";
document.getElementById("severidad").value = "Escoger Opción";
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

  function validarNumero(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
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