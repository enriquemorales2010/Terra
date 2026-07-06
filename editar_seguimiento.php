<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/postventas.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$ID_seg = $_GET['id_seg'];

$con = new postventas();

$sql = "SELECT * FROM seguimiento WHERE seguimiento.id_seg ='$ID_seg';";
$consulta = $con->conn->query($sql);



if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

      $descripcion = $fila['desc_seg'];
      $caso = $fila['num_caso'];
  
      


    }

  }

}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Editar Seguimiento de Caso</title>
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
              <i class="fa fa-user"></i> Seguimiento
              <small>Pagina para editar Seguimiento de un Caso. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Datos</a></li>
              <li class="active">Falla</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Seguimiento en un Caso</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

                     <form role='form' method='post' id="editar_seg">
      
                       <div class='form-group col-md-12'>
                          <label for='dir_usuario'><i class='fa fa-map-marker'></i>Descripcion de Seguimiento</label>
                          <textarea class='form-control' id='desc' name='desc' placeholder='Ingresar Descripción' onkeypress="return validarDir(event)" required maxlength="250"><?php echo $descripcion; ?></textarea>
                       </div>
                      
                      

                       <div class='form-group col-md-8'>
                          <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                       </div>
                       <div class="col-md-12">
                       
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='seg' id='seg' value='<?php echo $ID_seg; ?>'>
                          <input type='hidden' name='caso' id='caso' value='<?php echo $caso; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <?php 
                         echo " <a type='button' class='btn btn-danger pull-left' href='postventa_detalles.php?num_caso=".$caso."'> Cancelar </a></td>";
                        ?>
                        <?php 
                         echo " <button type='submit' class='btn btn-success pull-right' href='postventa_detalles.php?num_caso=".$caso."'> Editar Seguimiento </button>";
                        ?>
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