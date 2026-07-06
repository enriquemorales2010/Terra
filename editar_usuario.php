<?php  


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/usuarios.php');
include_once('modulos/maquetado.php');
include_once('modulos/footer.php');
include_once('modulos/scripts_js.php');

$rut = $_GET['rut_usu'];

$con = new Usuarios();

  $sql = "SELECT usuario.rut_usu, usuario.nom_usu, usuario.ape_usu, usuario.dir_usu, usuario.cor_usu, usuario.clave_usu, usuario.estado, perfil.id_per ,perfil.eti_per FROM usuario INNER JOIN  perfil 	ON usuario.id_per = perfil.id_per WHERE usuario.rut_usu = '$rut';";
$consulta = $con->conn->query($sql);

if ($consulta) {
  
  if ($consulta->num_rows > 0) {

    while ($fila = mysqli_fetch_assoc($consulta)) {

      if($fila['estado'] == 1) {
        $estado = "Activo";
      }else {
        $estado = "Inactivo";
      }
  
      $rut = $fila['rut_usu'];
      $correo = $fila['cor_usu'];
      $clave = $fila['clave_usu'];
      $nombre = $fila['nom_usu'];
      $apellido = $fila['ape_usu'];
      $direccion = $fila['dir_usu'];
      $perfil = $fila['eti_per'];


    }

  }

}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Terra - Editar Datos de Usuario</title>
  <?php echo head(); ?>
  <script>
function comprobarClave1(){ 
    clave1 = document.getElementById("pass_usuario").value; 
    clave2 = document.getElementById("pass2").value;

    if (clave1 == clave2){ 
        document.getElementById("pass2").style.background = "#A3F4A3"
        return true; 
        x
    }else {
        swal("No Coinciden Los Campos", "", "error");
        document.getElementById("pass_usuario").value = ''; 
        document.getElementById("pass2").value = ''; }
} 

</script>


</head>
<body class="hold-transition skin-red sidebar-mini" onload="comprobarClave1();">
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
              <small>Pagina para editar información de un Usuario. <i class="fa fa-info"></i></small>
            </h1>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de Gestión de Mantenimiento Vehicular</a></li>
              <li class="active">Usuarios</li>
            </ol>
        </section>
      
        <!-- CONTENIDO PRINCIPAL -->
         <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Editar Datos de Usuario</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">


        <form role='form' method='post' id='editar_usr'>
                       <div class='form-group col-md-3'>
                          <label for='email_usuario'><i class='fa fa-envelope'></i> Correo Electrónico</label>
                          <input type='email' class='form-control' id='email_usuario' name='email_usuario' placeholder='jdaniel@ejemplo.com' value='<?php echo $correo; ?>' maxlength="50" onkeypress="return validarCorreo(event)" required>
                       </div>
                       <div class='form-group col-md-3'>
                          <label for='pass_usuario'><i class='fa fa-unlock'></i> Contraseña</label>
                          <input type='password' class='form-control' id='pass_usuario' name='pass_usuario' value='<?php echo $clave; ?>' placeholder='*******' maxlength="16" onkeypress="return validarPass(event)" onkeydown="return cambio(event)" pattern=".{6,}" title="Mínimo 6 caracteres" required>
                       </div>
                       <div class="form-group col-md-3">
                          <label for="pass">Confirmar Contraseña:</label>
                          <input type="password" class = "form-control" name="pass2" id="pass2" value="<?php echo $clave;?>" onblur="return comprobarClave(event)" placeholder='***********' required>
                       </div>
                       <div class='form-group col-md-3'>
                          <label for='nombre_usuario'><i class='fa fa-male'></i> Primer y Segundo Nombre</label>
                          <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' placeholder='Juan Daniel' value='<?php echo $nombre; ?>' maxlength="25" onkeypress="return validarLetras(event)" required>
                       </div>
                       <div class='form-group col-md-3'>
                          <label for='apellido_usuario'><i class='fa fa-pencil'></i> Primer y Segundo Apellido</label>
                          <input type='text' class='form-control' id='apellido_usuario' name='apellido_usuario' placeholder='Paz Gonzalez' value='<?php echo $apellido; ?>'maxlength="35" onkeypress="return validarLetras(event)" required>
                       </div>
                       <div class='form-group col-md-12'>
                          <label for='dir_usuario'><i class='fa fa-map-marker'></i> Dirección de Residencia</label>
                          <textarea class='form-control' id='dir_usuario' name='dir_usuario' placeholder='Paz Gonzalez' onkeypress="return validarDir(event)" required maxlength="60"><?php echo $direccion; ?></textarea>
                       </div>
                      
                       <div class='form-group col-md-3'>
                          <label for='perfil_usuario'> <i class='fa fa-group'></i> Perfil</label>
                          <?php if ($perfil == "Super Administrador") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000001'><?php echo $perfil; ?></option>
                             <option value='000002'>Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                      		 <option value='000004'>Ejecutivos de Post-Ventas</option>
                      		 <option value='000005'>Encargado de Calidad</option>
                           <option value="000006">Oficina Tecnica</option>
                           <option value="000007">Prevencion de Riesgo</option>
                           <option value="000008">Usuario Basico</option>
                          </select>
                          <?php }elseif ($perfil == "Administrador") { ?>
                           <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000002'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                             <option value='000004'>Ejecutivos de Post-Ventas</option>
                      		   <option value='000005'>Encargado de Calidad</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000007">Prevencion de Riesgo</option>
                             <option value="000008">Usuario Basico</option>
                            </select>
                          <?php }elseif ($perfil == "Coordinador de Calidad") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000003'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                      		 <option value='000004'>Ejecutivos de Post-Ventas</option>
                      		 <option value='000005'>Encargado de Calidad</option>
                          </select>
                          <?php }elseif ($perfil == "Ejecutivo de Post-Ventas") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000004'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                      		   <option value='000003'>Coordinador de Calidad</option>
                      		   <option value='000005'>Encargado de Calidad</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000007">Prevencion de Riesgo</option>
                             <option value="000008">Usuario Basico</option>
                          </select>
                         <?php }elseif ($perfil == "Encargado de Calidad") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000005'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                      		   <option value='000003'>Coordinador de Calidad</option>
                      		   <option value='000004'>Ejecutivos de Post-Ventas</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000007">Prevencion de Riesgo</option>
                             <option value="000008">Usuario Basico</option>
                          </select>
                          <?php }elseif ($perfil == "Oficina Tecnica") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000006'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                             <option value='000004'>Ejecutivos de Post-Ventas</option>
                             <option value='000005'>Encargado de Calidad</option>
                             <option value="000007">Prevencion de Riesgo</option>
                             <option value="000008">Usuario Basico</option>
                          </select>
                         <?php }elseif ($perfil == "Prevencion de Riesgo") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000007'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                             <option value='000004'>Ejecutivos de Post-Ventas</option>
                             <option value='000005'>Encargado de Calidad</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000008">Usuario Basico</option>
                          </select>
                         <?php }elseif ($perfil == "Usuario Basico") { ?>
                          <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000008'><?php echo $perfil; ?></option>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                             <option value='000004'>Ejecutivos de Post-Ventas</option>
                             <option value='000005'>Encargado de Calidad</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000007">Prevencion de Riesgo</option>
                          </select>
                         <?php } else { ?>
                            <select name='perfil_usuario' id='perfil_usuario' class='form-control' required>
                             <option value='000001'>Super Administrador</option>
                             <option value='000002'>Administrador</option>
                             <option value='000003'>Coordinador de Calidad</option>
                             <option value='000004'>Ejecutivos de Post-Ventas</option>
                             <option value='000005'>Encargado de Calidad</option>
                             <option value="000006">Oficina Tecnica</option>
                             <option value="000007">Prevencion de Riesgo</option>
                             <option value="000008">Usuario Basico</option>
                            </select>
                          <?php } ?>
                       </div>
                       <div class='form-group col-md-2'>
                          <label for='estado'> <i class='fa fa-eye'></i> Estado</label>
                          <select name='estado' id='estado' class='form-control' required>
                            <?php if($estado == "Activo") { ?>
                             <option selected='selected' value='1'><?php echo $estado; ?></option>
                             <option value='0'>Inactivo</option>
                             <?php }else { ?>
                             <option selected='selected' value='0'><?php echo $estado; ?></option>
                             <option value='1'>Activo</option>
                             <?php } ?>
                          </select>
                       </div>
                       <div class='form-group col-md-8'>
                          <p class='help-block' style='color:red;'><i class='fa fa-info'></i> Recuerde llenar todos los campos</p>
                       </div>
                       <div class="col-md-12">
                        <hr>
                        <div class="form-group col-md-3">
                        <label for='perfil_usuario'> <i class='fa fa-group'></i> Perfil Actual</label>
                          <input type="text" class='form-control' value="<?php echo $perfil; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group col-md-4">
                        <label for='estado'> <i class='fa fa-eye'></i> Estado Actual</label>
                          <input type="text" class='form-control' value="<?php echo $estado; ?>" disabled>
                        </div>
                        </div>
                       </div>
                       <div class='form-group col-md-8'>
                          <input type='hidden' name='rut_usuario' id='rut_usuario' value='<?php echo $rut; ?>'>
                       </div>
                      <div class='col-md-12'>
                        <a type='button' class='btn btn-danger pull-left' href='lista_usuarios.php'>Cancelar Proceso</a>
                        <button type='submit' name='submit' class='btn btn-success pull-right'>Editar Datos</button>
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

 function cambio(e){
    document.getElementById("pass2").value = '';
     document.getElementById("pass2").style.background = "#FFFFFF"
    
  }


  function comprobarClave(){ 
    clave1 = document.getElementById("pass_usuario").value; 
    clave2 = document.getElementById("pass2").value;

    if (clave1 == clave2){ 
        document.getElementById("pass2").style.background = "#A3F4A3"
        return true; 
        x
    }else {
        swal("No Coinciden Los Campos", "", "error");
        document.getElementById("pass_usuario").value = ''; 
        document.getElementById("pass2").value = '';
        document.getElementById("pass2").style.background = "#FFFFFF" }
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