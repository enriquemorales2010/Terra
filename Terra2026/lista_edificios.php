<?php


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/edificios.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <?php echo head(); ?>
  <title>TERRA Constructora - Gestión de Edificios</title>
</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-info"></i> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> <i class="fa fa-info"></i> <b>Inicio</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <?php
        include_once('modulos/barratop.php');
        ?>
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
          <i class="fa fa-user"></i> Edificio.
          <small>Página para la gestión de los edificios. <i class="fa fa-info"></i></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-info"></i></a></li>
          <li class="active">Edificio</li>
        </ol>
      </section>
<?php if ($_SESSION['perfil'] == "Super Administrador") { ?>
      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                  <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_edificio"><i class="fa fa-plus"></i> Agregar Nuevo Edificio</button>
                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
               </div><!-- /.box-header -->
				
              <div class='box-body'>
                <div class='col-md-12'>
                	<br>
                  <div class="table-responsive">
                  <?php  

                  $con = new edificios();
                  $con->listaedificio();

                  ?>
                  </div>
               </div>
            </div>

        <!-- MODAL #1 -->
        <div class="modal fade bs-modal-lg" id="agregar_edificio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  
              
               <div class="modal-header">
                  <h4 class="box-title"><b>Registro de Nuevo Edificio</b></h4>
                </div>
            <div class="modal-body">
                <div class="row">
              <form role="form" method="post" action="modulos/reg_edificio.php" >
                <!--id="agregar_edificio"-->
                <!--action="modulos/reg_edificio.php"-->
                  
                  
                  <div class="form-group col-md-4">
                    <label for="nombre_edificio"><i class="fa fa-pencil"></i>Nombre del Edificio.</label>
                    <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" placeholder="Nueva Alameda" maxlength="25" onkeypress="return validarDir(event)"  required>
                  </div>
                  <div class="form-group col-md-10">
                    <label for="dir_edi"><i class="fa fa-map-marker"></i> Dirección de Edificio.</label>
                    <textarea class="form-control" id="dir_edificio" name="dir_edificio" placeholder="Antonio Varas 1635" onkeypress="return validarDir(event)" maxlength="120"></textarea>
                  </div>
                  
                    
                    <div class="form-group col-md-4">
                    <label for="fecha"><i class="fa fa-calendar"></i> Fecha de Recepción Municipal:</label>
                    <input type="date" class="form-control" name="fecha_rec" id="fecha_rec" onchange ="return restarFechas2(event)">
                    </div>         
                                


        
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Edificio">
                  </div>
                </div>
              </from>
            
            </div>
          </div>
        </div>
        <!-- MODAL #1 -->

            </div>
         </div>
      </div>
      
   </section>

<?php }else { echo "<div class='box-body'>
              <div class='alert alert-danger alert-dismissible'>
              <h4><i class='icon fa fa-ban'></i> Alerta!</h4>
              Disculpe estimado usuario, no tiene permisos para gestionar este módulo.
              </div></div>"; } ?>
    </div><!-- /.content-wrapper -->

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
      swal("Para la contraseña debe ingresar sólo letras y números y debe tener mínimo 8 dígitos.");
    };
    return patron.test(te); 

  }

    function restarFechas(fecha_ini, fecha_cul) {
     inicio=document.getElementById('fecha_ini').value;
        final=document.getElementById('fecha_cul').value;
        inicio=new Date(inicio);
        final=new Date(final);
        if(inicio >= final){
        swal("Fechas de Culminación Incorrecta");
        $("#fecha_cul").empty();
        document.getElementById("fecha_cul").value = '';
        }
      }

      function restarFechas2(fecha_cul, fecha_rec) {
        inicio=document.getElementById('fecha_cul').value;
        final=document.getElementById('fecha_rec').value;
        inicio=new Date(inicio);
        final=new Date(final);
        if(inicio >= final){
        swal("Fechas de Recepción Incorrecta");
        document.getElementById("fecha_rec").value = '';        }
      }

   function validarDir(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-#,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/#()");
    };
    return patron.test(te); 

  }

  function validarCedula(e) 
  { 
    
  }

  //$('#ci_usuario').inputmask("99999999");
  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");

   $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 
   $(".date").inputmask({
   yearrange: { minyear: 1930 }
   });

    $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 
    $(".date").inputmask({
    yearrange: { minyear: 1997 }
    });

     $('#venc_licencia').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" });
     $("#venc_licencia").inputmask({
      yearrange: { minyear: 2017, maxyear: 2199 }
     });


    
    
    
    
   
</script>

</body>
</html>