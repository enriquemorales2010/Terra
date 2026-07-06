<?php

session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
}

include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');
include_once("clases/conexion.php");



error_reporting(E_ERROR | E_PARSE);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Inicio</title>
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
          <i class="fa fa-home"></i> Inicio
          <small>Página de Inicio. <i class="fa fa-info"></i></small>
        </h1>

        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
          <li class="active">Inicio</li>
        </ol>
      </section>

      <!-- CONTENIDO PRINCIPAL -->
      <section class="content">
       <div class="row">


        <?php if ($_SESSION['perfil'] == "Super Administrador" or $_SESSION['perfil'] == "Coordinador de Calidad" or $_SESSION['perfil'] == "Administrador" ) { ?>
        <!-- Usuarios -->
        <div class="col-md-3 col-sm-6 col-xs-6 ">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4>Estudio de <br>Propuesta</h4>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            <a href="#" class="small-box-footer">Entrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      


        <?php } ?>
      

      <div class="row">
        <div class="col-md-6 hidden">
          <div class="box box-default">

            <div class="box-body">



            </div>
          </div>
        </div>
      </div>

    </div>


  </section><!-- cierre content -->




</div><!-- /.content-wrapper - Contenedor Principal de la Página -->

<?php echo insertar_footer(); ?>

</div><!-- ./wrapper -->

<?php echo insertarScripts(); ?>
<script>

</script>
</body>
</html>
