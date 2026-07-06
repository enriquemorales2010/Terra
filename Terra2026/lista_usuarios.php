<?php


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/usuarios.php');
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
  <title>TERRA - Gestión de Usuarios</title>
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
          <i class="fa fa-user"></i> Usuarios
          <small>Página para la gestión de los usuarios. <i class="fa fa-info"></i></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-info"></i></a></li>
          <li class="active">Usuarios</li>
        </ol>
      </section>
<?php if ($_SESSION['perfil'] == "Super Administrador") { ?>
      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_usuario"><i class="fa fa-plus"></i> Agregar Nuevo Usuario</button>
                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
               </div><!-- /.box-header -->
				
              <div class='box-body'>
                <div class='col-md-12'>
                	<br>
                  <div class="table-responsive">
                  <?php  

                  $con = new Usuarios();
                  $con->listaUsuarios();

                  ?>
                  </div>
               </div>
            </div>

        <!-- MODAL #1 -->
        <div class="modal fade bs-modal-lg" id="agregar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  
              
               <div class="modal-header">
                  <h4 class="box-title"><b>Registro de Nuevo Usuario</b></h4>
                </div>
            <div class="modal-body">
                <div class="row">
              <form role="form" method="post" id="agregar_usr">
                <!--id="agregar_usr"-->
                  <div class="form-group col-md-6 alerta">
                    <label for="email_usuario"><i class="fa fa-envelope"></i> Correo Electrónico </label>
                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="jdaniel@ejemplo.com" maxlength="38" onkeypress="return validarCorreo(event)" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="pass_usuario"><i class="fa fa-unlock"></i> Contraseña (mínimo 8 caracteres)</label>
                    <input type="password" class="form-control" id="pass_usuario" name="pass_usuario" placeholder="xxxxxxx" pattern=".{8,}" title="Mínimo 8 caracteres" maxlength="16" onkeypress="return validarPass(event)" onkeydown="return cambio(event)" required>
                  </div>
                  
                   <div class="form-group col-md-6">
                   <label for="pass2">Confirmar Contraseña:</label>
                   <input type="password" class = "form-control" name="pass2" id="pass2" onblur="return comprobarClave(event)" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="ci_usuario"><i class="fa fa-credit-card"></i> R.U.T.</label>
                    <input type="text" class="form-control" id="rut_usuario" name="rut_usuario" placeholder="20085339-9" onkeypress="return validarRut(event)" pattern=".{8,}" title="Ingrese 12 dígitos" maxlength="12" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre_usuario"><i class="fa fa-male"></i> Primer y Segundo Nombre </label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Juan Daniel" maxlength="25" onkeypress="return validarLetras(event)" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido_usuario"><i class="fa fa-pencil"></i> Primer y Segundo Apellido </label>
                    <input type="text" class="form-control" id="apellido_usuario" name="apellido_usuario" placeholder="Paz Gonzalez" maxlength="25" onkeypress="return validarLetras(event)"  required>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="dir_usuario"><i class="fa fa-map-marker"></i> Dirección de Residencia</label>
                    <textarea class="form-control" id="dir_usuario" name="dir_usuario" placeholder="Antonio Varas 1635" onkeypress="return validarDir(event)" maxlength="120"></textarea>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="perfil_usuario"> <i class="fa fa-group"></i> Perfil</label>
                    <select name="perfil_usuario" id="perfil_usuario" class="form-control" required>
                      <option selected="selected" value="000001">Super Administrador</option>
                      <option value="000002">Administrador</option>
                      <option value="000003">Coordinador de Calidad</option>
                      <option value="000004">Ejecutivos de Post-Ventas</option>
                      <option value="000005">Encargado de Calidad</option>
                      <option value="000006">Oficina Tecnica</option>
                      <option value="000007">Prevencion de Riesgo</option>
                      <option value="000008">Usuario Basico</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nuevo Usuario">
                  </div>
                </div>
              </form>
            
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
      document.getElementById("rut_usuario").value = '';
    };
    return patron.test(te); 
  }

  function cambio(e){
    document.getElementById("pass2").value = '';
  }


  function comprobarClave(){ 
    clave1 = document.getElementById("pass_usuario").value; 
    clave2 = document.getElementById("pass2").value;

    if (clave1 == clave2){ 
        return true; 
    }else {
        swal("No Coinciden Los Campos", "", "error");
        document.getElementById("pass_usuario").value = ''; 
        document.getElementById("pass2").value = ''; }
} 
 

 

  //$('#ci_usuario').inputmask("99999999");
  $('#cel_usuario').inputmask("(9999)-9999999");
  $('#tel_usuario').inputmask("(9999)-9999999");
  $('#rut_usuario').inputmask("99.999.999-*");

   
</script>

</body>
</html>