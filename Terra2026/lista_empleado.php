<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/empleado.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
	<title>Terra Constructora - Gestión de Mecánicos</title>
	<?php echo head(); ?>
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
                }elseif ($_SESSION['perfil'] == "Encargado") {
                  echo menuEncargado();
                }elseif ($_SESSION['perfil'] == "Ejecutivo Post-Ventas") {
                  echo menuEjecutivo();
                }else {
                  echo menuAdministrador();
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
        			<i class="fa fa-wrench"></i> Empleados.
        			<small>Página para la gestión de los Empleados. <i class="fa fa-info"></i></small>
        		</h1>

        		<ol class="breadcrumb">
          		<li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
          		<li class="active">Empleados</li>
        		</ol>
        </section>
        
<?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Encargado") { ?>      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">


          <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_emp"><i class="fa fa-plus"></i> Agregar Nuevo Empleado</button>
               </div><!-- /.box-header -->

              <div class='box-body'>
                <div class='col-sm-12'>
                  <div class="table-responsive">
                  <?php 
                    
                    $con = new empleado();
                    $con->listaempleado();

                  ?>
                  </div>
               </div>
            </div>






              </div>
            </div>
          </div>

         <!-- MODAL REGISTRO DE empleado -->

              <div class="modal fade slide left" id="agregar_emp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> 

                <div class="modal-header">
                  <h4 class="box-title"><b>Registro de Nuevo Empleado</b></h4>
                </div>

                <form role="form" method="post" id="agregar_emp">
                <div class="modal-body">
                  <div class="row">
                  
                  <div class="form-group col-md-4">
                    <label for="ci_mec"><i class="fa fa-credit-card"></i> RUT</label>
                    <input type="text" class="form-control" id="rut" name="rut" placeholder="78945612"  maxlength="9" title="Formato:(12345678)-(9)"   onkeypress="return validarDir(event)" pattern=".{9,}" title="Ingrese 8 dígitos" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombre_mec"><i class="fa fa-male"></i> Primer y Segundo Nombre</label>
                    <input type="text" class="form-control" id="nombre_emp" name="nombre_emp" placeholder="Juan Daniel" maxlength="25" onkeypress="return validarLetras(event)" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="apellido_mec"><i class="fa fa-pencil"></i> Primer y Segundo Apellido</label>
                    <input type="text" class="form-control" id="apellido_emp" name="apellido_emp" placeholder="Paz Gonzalez" maxlength="25" onkeypress="return validarLetras(event)" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="fechaNac_mec"><i class="fa fa-calendar"></i> Fecha de Nacimiento</label>
                    <input type="text" id="fechaNac_emp" name="fechaNac_emp" class="form-control date" placeholder="Año/Mes/Día" required>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="dir_mec"><i class="fa fa-map-marker"></i> Dirección de Residencia</label>
                    <textarea class="form-control" id="dir_emp" name="dir_emp" placeholder="Paz Gonzalez" onkeypress="return validarDir(event)" maxlength="120" required></textarea>
                  </div>
                   <div class="form-group col-md-4">
                    <label for="perfil_usuario"> <i class="fa fa-group"></i> Cargo</label>
                    <select name="cargo_emp" id="cargo_emp" class="form-control" required>
                      <option selected="selected" value="000000">Ej1</option>
                      <option selected="selected" value="000001">Ej2</option>
                      <option selected="selected" value="000002">Ej3</option>
                      <option selected="selected" value="000003">Ej4</option>
                      <option selected="selected" value="000004">Ej5</option>
                      <option selected="selected" value="000005">Ej6</option>
                      
                    </select>
                  </div>
                  
                  <!-- /.form group -->
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                </div>
                </div>
               
                <div class="modal-footer">
                  <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Empleado">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              
              </form>
           
           </div>
          </div>
        </div>

        <!-- CIERRE MODAL REGISTRO DE MECANICO -->

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

    patron =/[A-Za-z0-9\sáéíóúñÁÉÍÓÚÑ'_.\-@!*#,/()]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Para la dirección son validos: letras, números y los caracteres especiales: ,.-/@*#!()");
    };
    return patron.test(te); 

  }

  function validarCedula(e) 
  { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /\d/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo números.");
    };
    return patron.test(te); 
  }
  
    $('.date').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" }); 
    $(".date").inputmask({
    yearrange: { minyear: 1930, maxyear: 1997 }
    });

     $('#venc_licencia').inputmask("yyyy/mm/dd",{ "placeholder": "aaaa/mm/dd" });
     $("#venc_licencia").inputmask({
      yearrange: { minyear: 2017, maxyear: 2199 }
     });

    $('#cel_transp').inputmask("(9999)-9999999");
    $('#tel_transp').inputmask("(9999)-9999999");
    //$('#ci_transp').inputmask("99999999");
 </script>
</body>
</html>