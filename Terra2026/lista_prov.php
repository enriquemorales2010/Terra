<?php  


session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/proveedores.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
	<title>Constructora Terra - Gestión de Proveedores de Material</title>
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
        			<i class="fa fa-building-o"></i> Proveedores de Material
        			<small>Página para la gestión de los Proveedores de Material. <i class="fa fa-info"></i></small>
        		</h1>

        		<ol class="breadcrumb">
          		<li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
          		<li class="active">Proveedores de Material</li>
        		</ol>
        </section>
        
 <?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Encargado") { ?>     
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">


          <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                  <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_prove"><i class="fa fa-plus"></i> Agregar Nuevo Proveedor</button>
                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
               </div><!-- /.box-header -->

              <div class='box-body'>
                <div class='col-sm-12'>
                  <div class="table-responsive">
                  <?php 
                    $con = new proveedores();
                    $con->listaProveedores();
                  ?>
                  </div>
               </div>
            </div>




<div class="modal fade bs-modal-lg" id="agregar_prove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content"> 

      <div class="modal-header">
        <h4 class="box-title"><b>Registro de Nuevo Proveedor</b></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form role="form" method="post" id="agregar_prov">
            
           <div class="form-group col-md-4">
              <label for="rif"><i class="fa fa-credit-card"></i> RUT</label>
              <input type="text" class="form-control" id="rut" name="rut" placeholder="20085339-9" onkeypress="return validarRut(event)" pattern=".{8,}" title="Ingrese 12 dígitos" maxlength="12" required>
            </div>
            <div class="form-group col-md-4">
              <label for="nombre_prov"><i class="fa fa-building"></i> Nombre del Proveedor</label>
              <input type="text" class="form-control" id="nombre_prov" name="nombre_prov" placeholder="Retrimoca" maxlength="50" onkeypress="return validarDir(event)" required>
            </div>
            <div class="form-group col-md-12">
              <label for="dir"><i class="fa fa-map-marker"></i> Dirección</label>
              <textarea name="dir" id="dir" class="form-control" placeholder="Sector Nueva Rosa Carretera J" onkeypress="return validarDir(event)" maxlength="120" required></textarea>
            </div>
            <div class="form-group col-md-4">
              <label for="email"><i class="fa fa-envelope"></i> Correo de Contacto</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="retrimoca@ejemplo.com" maxlength="38" onkeypress="return validarCorreo(event)" required>
            </div>
            <div class="form-group col-md-4">
              <label for="tel_prov"><i class="fa fa-phone"></i> Teléfono Empresa</label>
              <input type="text" class="form-control" id="tel_prov" name="tel_prov" placeholder="(22)-12341235" required  maxlength="13" pattern=".{12,}" onkeypress="return validarNumero(event)" >
            </div>
            <div class="form-group col-md-4">
              <label for="cel_prov"><i class="fa fa-phone"></i> Celular Empresa</label>
              <input type="text" class="form-control" id="cel_prov" name="cel_prov" placeholder="(9)-12341234" required maxlength="12" pattern=".{11,}"  onkeypress="return validarNumero(event)">
            </div>
            
            
            <div class="form-group col-md-12">
              <p class="help-block" style="color:red;"><i class="fa fa-info-circle"></i> Recuerde llenar todos los campos.</p>
            </div>
           </div>
      </div>
          <div class="modal-footer">
            <div class="col-md-12">
              <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Proveedor">
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
          </form>
           
    </div>
  </div>
</div>



              </div>
            </div>
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

     function validarRut(e) 
  { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /[0-9\Kk\-]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo números,el guion(-) antes del digito verificador.(SOLO PUEDE INGRESAR LA LETRA K)");
      document.getElementById("rut").value = '';
    };
    return patron.test(te); 
  }

  //$('#ci_usuario').inputmask("99999999");
  $('#cel_prov').inputmask("(9999)-9999999");
  $('#tel_prov').inputmask("(9999)-9999999");
  $('#rut').inputmask("99.999.999-*");

  
  //$('#rif').inputmask("A-99999999-9");
   
</script>  
</body>
</html>