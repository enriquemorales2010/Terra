<?php


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');


?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Perfil del Usuario</title>
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
        <?php 
        include_once('modulos/barratop.php')
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
          Perfil de Usuario
          <small>Perfil donde se muestran todos los datos del usuario <i class="fa fa-info-circle"></i></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Gestion de datos </a></li>
          <li class="active">Perfil de Usuario</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                
                <h3 class="profile-username text-center"><?php echo $_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario']; ?></h3>
                <p class="text-muted text-center"><?php echo $_SESSION['perfil']; ?></p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Nombre(s)</b> <a class="pull-right"><?php echo $_SESSION['nombre_usuario']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Apellido(s)</b> <a class="pull-right"><?php echo $_SESSION['apellido_usuario']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>R.U.T</b> <a class="pull-right"><?php echo $_SESSION['rut']; ?></a>

                  </li>

                  <li class="list-group-item">
                   <a href='editar_usuario.php?rut_usu=<?php echo $_SESSION['rut']; ?>' class="btn btn-danger btn-block"><b>Editar Datos</b></a>
                  </li>


                </ul>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          <div class="col-md-8">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <div class="form-group col-md-7">
                  <label for="correousuario"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                  <h4><?php echo $_SESSION['usuario']; ?></h4>
                </div>
                <div class="form-group col-md-3">
                  <label for="contrasenausuario"><i class="fa fa-lock"></i> Contraseña</label>
                   <input type="text" class='form-control' id='pass_usuario' name='pass_usuario' value='<?php echo $_SESSION['pass']; ?>' disabled>
                </div>
                <div class="form-group col-md-12">
                  <label for="direccionusuario"><i class="fa fa-map-marker"></i> Dirección de Residencia</label>
                  <h4><?php echo $_SESSION['direccion_usuario']; ?></h4>
                </div>
                <div class="form-group col-md-4">
                  <label> <i class="fa fa-group"></i> Perfil</label>
                  <h4><?php echo $_SESSION['perfil']; ?></h4>
                </div><!-- /.form group -->
                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div>

      </section>

    </div><!-- /.content-wrapper -->

    <?php echo insertar_footer(); ?>

</div><!-- ./wrapper -->

<?php echo insertarScripts(); ?>
</body>
</html>
