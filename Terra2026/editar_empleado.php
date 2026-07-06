<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/empleado.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$rut = $_GET['rut_emp'];

$con = new empleado();
$sql = "SELECT * FROM empleado WHERE empleado.rut_emp = '$rut';";
$consulta = $con->conn->query($sql);

if ($consulta) {

  if ($consulta->num_rows > 0) {
    
    while ($fila = mysqli_fetch_assoc($consulta)) {

      if($fila['estado'] == 1) {
        $estado = "Activo";
      }else {
        $estado = "Inactivo";
      }
      
      $rut = $fila['rut_emp'];
      $nombre = $fila['nom_emp'];
      $direccion = $fila['dir_emp'];
      $nacimiento = $fila['fecha_nac'];
      $edad = $fila['edad_emp'];
      $cargo = $fila['cargo_emp'];
      

    }

  }

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Terra Constructora - Editar Datos de Empleados.</title>
	<?php echo head(); ?>
  <script type="text/javascript">
  $( document ).ready(function() {
            $('#fecha').datepicker();
        });</script>
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
        			<i class="fa fa-building-o"></i> Empleados
        			<small>Página para editar datos de un empleadp.<i class="fa fa-info"></i></small>
        		</h1>

        		<ol class="breadcrumb">
          		<li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
          		<li class="active">Empleado.</li>
        		</ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">

         <div class="box box-info">
          
          <div class="box-header with-border">
            <h3 class="box-title"><b>Editar Datos del Empleado</b></h3>
          </div><!-- /.box-header -->

          <div class="box-body">
              <div class="col-md-12">
            <form role="form" method="post" id="editar_prov">
            <br>

            <div class="form-group col-md-4">
              <label for="rif"><i class="fa fa-credit-card"></i> RUT</label>
              <input type="text" class="form-control" id="rif" name="rif" placeholder="J-12345678-3" value='<?php echo $rut; ?>' pattern="^([VEJG]{1})-([0-9]{8})-([0-9]{1})$" title="Formato: (VEJG)-(12345678)-(9)" required onkeypress="return validarRif(event)" maxlength="12">
            </div>
            
            <div class="form-group col-md-4">
              <label for="nombre_prov"><i class="fa fa-user"></i> Nombre del Empleado</label>
              <input type="text" class="form-control" id="nombre_prov" name="nombre_prov" placeholder="Retrimoca" value='<?php echo $nombre; ?>' maxlength="25" onkeypress="return validarLetras(event)" required>
            </div>
             
            
            <div class="form-group col-md-12">
              <label for="dir"><i class="fa fa-map-marker"></i> Dirección de Domicilio</label>
              <textarea name="dir" id="dir" class="form-control" placeholder="Sector Nueva Rosa Carretera J" onkeypress="return validarDir(event)" maxlength="120" required><?php echo $direccion ?></textarea>
            </div>
           
            <div class="form-group col-md-3">
              <label for="tel_prov"><i class="fa fa-phone"></i> Cargo</label>
              <input type="text" class="form-control" id="" name="car_emp" value='<?php echo $cargo; ?>' required >
            </div>


          <div class='form-group col-md-2'>
                          <label for='estado'> <i class='fa fa-eye'></i> Estado</label>
                          <select name='estado' id='estado' class='form-control' required>
                            <?php if($estado == "Activo")  { ?>
                             <option selected='selected' value='1'><?php echo $estado; ?></option>
                             <option value='0'>Inactivo</option>
                             <?php }else { ?>
                             <option selected='selected' value='0'><?php echo $estado; ?></option>
                             <option value='1'>Activo</option>
                             <?php } ?>
                          </select>
                       </div>
          

            
                
              <div class="form-group col-md-3">
                 <label for="fechaNac_transp"><i class="fa fa-calendar"></i> Fecha de Nacimiento</label>
                 <input type="date" id="fechaNac_transp" name="fechaNac_transp" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'"  required>
              </div>




            <div class="form-group col-md-4">
              <input type="hidden" id="ID" name="ID" value='<?php echo $rut; ?>'>
            </div>
            <div class="form-group col-md-12">
              <p class="help-block" style="color:red;"><i class="fa fa-info-circle"></i> Recuerde llenar todos los campos.</p>
            </div>
            <div class="col-md-12">
             <hr>
              <div class="form-group col-md-3">
               <label for="fechanac"><i class="fa fa-user" aria-hidden="true"></i> Fecha de nacimiento</label>
               <input type="text" class="form-control datepicker" id="fecha" name="fecha" value='<?php echo $nacimiento; ?>' required  disabled>
              </div>
              <div class="form-group col-md-3">
              <label for="email"><i class="fa fa-envelope"></i> Edad del Empleado</label>
              <input type="text" class="form-control" id="edad_emp" name="edad_emp" placeholder="" value='<?php echo $edad; ?>' disabled required>
            </div>

            <div class='col-md-12'>
              <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
              <a type='button' class='btn btn-danger pull-left' href='lista_empleado.php'>Cancelar Proceso</a>
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


  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });



  //$('#ci_usuario').inputmask("99999999");
  $('#cel_prov').inputmask("(9999)-9999999");
  $('#tel_prov').inputmask("(9999)-9999999");
  $('#fax_prov').inputmask("(9999)-9999999");
  //$('#rif').inputmask("A-99999999-9");
   
</script> 
</body>
</html>