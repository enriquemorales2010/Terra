<?php


session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: error_login.php?error=true');
}

include_once('clases/estadistica.php');
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
  <title>TERRA - Gestión de Prevención de Riesgo</title>
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
          <i class="fa fa-user"></i> Estadisticas de Prev. de Riesgo.
          <small>Página para la gestión de Estadisticas Prev. de Riesgo. <i class="fa fa-info"></i></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-info"></i></a></li>
          <li class="active">Estadistica</li>
        </ol>
      </section>
<?php if ($_SESSION['perfil'] == "Super Administrador" || $_SESSION['perfil'] == "Prevencion de Riesgo") { ?>
      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border col-md-12">
                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#agregar_estadisticas"><i class="fa fa-plus"></i> Agregar Nuevo Estadistica</button>
                  <!--<a href="editar_usuario.php"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar Usuario</button></a>-->
               </div><!-- /.box-header -->
				
              <div class='box-body'>
                <div class='col-md-12'>
                	<br>
                  <div class="table-responsive">
                  <?php  

                  $con = new estadisticas();
                  $con->listaestadistica();

                  ?>
                  </div>
               </div>
            </div>

        <!-- MODAL #1 -->
        <div class="modal fade bs-modal-lg" id="agregar_estadisticas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">  
              
               <div class="modal-header">
                  <h4 class="box-title"><b>Registro de Nuevas Estadisticas de Prev.</b></h4>
                </div>
            <div class="modal-body">
                <div class="row">
              <form role="form" method="post" id="reg_estad">
                <!--id="reg_estad"-->
                <!--action="modulos/reg_estadistica.php"-->
                 

                     <div class="form-group col-md-12 well well-sm text-center"><strong>Fecha y Obra.</strong></div>

                    <div class='form-group col-md-4'>
                       <label for='area'><i class='fa fa-building'></i> Obra : </label>
                              <select name='proyecto' id='proyecto' class='form-control' required>
                              <option value='' selected>Seleccionar Una Opción</option>
                              <?php
                              
                              $con = new estadisticas();
                              $sql = "SELECT edificio.id_ed, edificio.nom_ed FROM edificio;";
                              $consulta = $con->conn->query($sql);
                              
                              if ($consulta) {
                              if ($consulta->num_rows > 0) {
                              while ($fila = mysqli_fetch_assoc($consulta)) {
                              $ID = $fila['id_ed'];
                              $nombre = $fila['nom_ed'];
                              
                              echo "<option value='".$ID."'>".$nombre."</option>";
                              }
                              }else {
                              echo "<option selected='selected' value=''>NO HAY EDIfICIO (LLAMAR A ENCARGADO)</option>";
                              }
                              }
                              
                              
                              ?>
                              </select>
                              </div>




                     <div class="form-group col-md-3 alerta">
                     <label for="email_usuario"><i class="fa fa-calendar"></i> Mes/Año: </label>
                     <input type="month" class="form-control" id="fecha" name="fecha" placeholder="Solo Numeros"  onkeypress="return validarNum(event)"  maxlength="3" >
                     </div>
                    

  
                  <div class="form-group col-md-12 well well-sm text-center"><strong>Datos.</strong></div>

                  <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-heartbeat"></i> Accidentes </label>
                    <input type="text" class="form-control" id="accidentados" name="accidentados" placeholder="Solo Numeros" onkeypress="return validarNum(event)"  maxlength="3" >
                  </div>

                   <div class="form-group col-md-3 alerta">
                    <label for="email_usuario"><i class="fa fa-calendar"></i> Dias Perdidos </label>
                    <input type="text" class="form-control" id="perdidos" name="perdidos" placeholder="Solo Numeros" maxlength="3" onkeypress="return validarNum(event)"  title="Maximo 3 Digitos">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="pass_usuario"><i class="fa fa-calendar"></i> Dias Arrastrados</label>
                    <input type="text" class="form-control" id="arrastrados" name="arrastrados" placeholder="Solo Numeros" title="Maximo 3 Digitos" onkeypress="return validarNum(event)"  maxlength="3" >
                  </div>

                  <div class="form-group col-md-3">
                    <label for="pass_usuario"><i class="fa fa-heartbeat"></i> Enfermedades Prof.</label>
                    <input type="text" class="form-control" id="profesionales" name="profesionales" placeholder="Solo Numeros" title="Maximo 3 Digitos" onkeypress="return validarNum(event)"  maxlength="3">
                  </div>


                  <div class="form-group col-md-12">
                    <p class="help-block" style="color:red;"><i class="fa fa-info"></i> Recuerde llenar todos los campos</p>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Agregar Nueva Estadistica">
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

  function validarNum(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 

    patron =/[0-9]/;
    te = String.fromCharCode(tecla);
    if (patron.test(te)==false)
    {
      swal({
    title: "Error",
    text: "Solo Puede Ingresar Numeros.",
    type: 'error'
    });
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