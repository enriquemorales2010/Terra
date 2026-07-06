<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/proveedores.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$ID = $_GET['ID'];

$con = new proveedores();
//$sql = "SELECT proveedores.ID, proveedores.rut, proveedores.nom_pro,proveedores.direccion, proveedores.correo, telef_prov.principal, telef_prov.celular FROM proveedores INNER JOIN telef_prov ON proveedores.ID = telef_prov.ID WHERE proveedores.ID = '$ID';";
$sql = "SELECT * FROM proveedores INNER JOIN telef_prov ON proveedores.ID = telef_prov.prov_servicio_ID WHERE proveedores.ID = '$ID';";
$consulta = $con->conn->query($sql);



if ($consulta) {

  if ($consulta->num_rows > 0) {
    
    while ($fila = mysqli_fetch_assoc($consulta)) {
      
      $identificacion = $fila['ID'];
      $rut = $fila['rut'];
      $nombre = $fila['nombre'];
      $direccion = $fila['direccion'];
      $correo = $fila['correo'];
      $principal = $fila['principal'];
      $celular = $fila['celular'];
      
      
    }

  }

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Terra Constructora- Editar Datos de Proveedores de Materiales</title>
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
        			<i class="fa fa-building-o"></i> Proveedor de Material
        			<small>Página para editar datos de un proveedor.<i class="fa fa-info"></i></small>
        		</h1>

        		<ol class="breadcrumb">
          		<li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
          		<li class="active">Proveedor de Materiales</li>
        		</ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">

         <div class="box box-info">
          
          <div class="box-header with-border">
            <h3 class="box-title"><b>Editar Datos de Proveedor de Material</b></h3>
          </div><!-- /.box-header -->

          <div class="box-body">
              <div class="col-md-12">

            <form role="form" method="post" id="editar_prov">
            <div class="form-group col-md-4">
              <label for="rif"><i class="fa fa-credit-card"></i> RUT</label>
              <input type="text" class="form-control" id="rut" name="rut" placeholder="12345678-3" value='<?php echo $rut; ?>' 
              pattern="^(([0-9]{8})-([0-9][K][k]{1})$" title="Formato:(12345678)-(9)" required onkeypress="return validarRut(event)" maxlength="10">
            </div>
            <div class="form-group col-md-4">
              <label for="nombre_prov"><i class="fa fa-building"></i> Nombre del Proveedor</label>
              <input type="text" class="form-control" id="nombre_prov" name="nombre_prov" placeholder="Retrimoca" value='<?php echo $nombre; ?>' maxlength="50" onkeypress="return validarLetras(event)" required>
            </div>
            
            <div class="form-group col-md-12">
              <label for="dir"><i class="fa fa-map-marker"></i> Dirección</label>
              <textarea name="dir" id="dir" class="form-control" placeholder="Sector Nueva Rosa Carretera J"onkeypress="return validarDir(event)" maxlength="120" required onkeypress="return validarDir(event)"><?php echo $direccion; ?></textarea>
            </div>
            <div class="form-group col-md-3">
              <label for="email"><i class="fa fa-envelope"></i> Correo de Contacto</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="retrimoca@ejemplo.com" value='<?php echo $correo; ?>' maxlength="38" onkeypress="return validarCorreo(event)" required>
            </div>
            <div class="form-group col-md-3">
              <label for="tel_prov"><i class="fa fa-phone"></i> Teléfono Empresa</label>
              <input type="text" class="form-control" id="tel_prov" name="tel_prov" placeholder="(22)-7894561" value='<?php echo $principal; ?>' required maxlength="14" onkeypress="return validarCedula(event)">
            </div>
            <div class="form-group col-md-3">
              <label for="cel_prov"><i class="fa fa-phone"></i> Celular Empresa</label>
              <input type="text" class="form-control" id="cel_prov" name="cel_prov" placeholder="(9)-78994561" value='<?php echo $celular; ?>' required maxlength="15"  onkeypress="return validarCedula(event)">
            </div>
          
          
            
            <div class="form-group col-md-4">
              <input type="hidden" id="ID" name="ID" value='<?php echo $ID; ?>'>
            </div>
            <div class="form-group col-md-12">
              <p class="help-block" style="color:red;"><i class="fa fa-info-circle"></i> Recuerde llenar todos los campos.</p>
            </div>
            <div class="col-md-12">
             <hr>
             

            <div class='col-md-12'>
              <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
              <a type='button' class='btn btn-danger pull-left' href='lista_prov.php'>Cancelar Proceso</a>
            </div>

          </form>

              </div>
          </div><!-- /.box-body -->
        
        </div>

         </section><!-- cierre content -->




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

    function validarRut(e) 
  { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /[0-9\Kk\-]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debes ingresar solo números,el guion(-) antes del digito verificador.(SOLO PUEDE INGRESAR LA LETRA K)");
    };
    return patron.test(te); 
  }

  function validarRif(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron = /[VEJG0-9-]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal("Debe ingresar letras, números y el caracter especial - con el siguiente patrón: VEJG-12345678-9");
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

  //$('#ci_usuario').inputmask("99999999");
  //$('#ci_usuario').inputmask("99999999");
  $('#cel_prov').inputmask("(9)-99999999");
  $('#tel_prov').inputmask("(99)-9999999");
  //$('#rif').inputmask("A-99999999-9");
   
</script> 
</body>
</html>